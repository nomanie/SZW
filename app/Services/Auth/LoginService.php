<?php

namespace App\Services\Auth;

use App\Enums\AccountTypeEnum;
use App\Enums\TokenTypeEnum;
use App\Models\System\Identity;
use App\Models\System\User;
use App\Models\System\Workshop;
use App\Notifications\PinEmail;
use App\Notifications\VerifyEmail;
use App\Services\System\TokenService;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use TheSeer\Tokenizer\Token;

class LoginService extends AuthService
{
    private bool $dontSendEmail = false;

    /** Tworzy token logowania dla użytkownika oraz zapisuje go w sesji
     *
     * @param string $device
     * @param string $ip
     *
     * @return $this
     *
     * @throws Exception
     */
    public function setToken(string $device, string $ip): static
    {
        $token = $this->tokenService->setDevice($device)->setIdentity($this->identity)->setIp($ip)->createLoginToken();
        Session::put('token', $token);

        return $this;
    }

    /** Usuwa token logowania użytkownika oraz czyści jego sesje
     *
     * @param string $device
     * @param string $ip
     *
     * @return bool
     */
    public function logout(string $device, string $ip): bool
    {
        $this->tokenService->setDevice($device)->setIdentity($this->identity)->setIp($ip)->revokeLoginToken();
        Auth::logout();

        return true;
    }

    public function login(array $data, $remember_me, $ip)
    {
        $mac = exec('getmac');

        if (Auth::attempt($data, $remember_me)) {
            // sprawdzenie czy użytkownik ma zapamiętane urządzenie
            $hasAuthorized = DB::table('authorized_devices')
                ->where('identity_id', auth()->user()->id)
                ->where('ip_address', $ip)
                ->where('mac_address', $mac)
                ->count() > 0;
            if ($hasAuthorized) {
                // jeśli tak to loguje
                $this->saveDataToSession($mac, $ip);
            } else {
                // jeśli nie to generuje kod, wysyła go mailem i usuwa sesje usera
                $this->generatePin(auth()->user()->id);
                return 3;
            }
        }
        return 0;
    }

    public function saveDataToSession($mac, $ip)
    {
        $service = $this->setIdentity(auth()->user()->id);
        // sprawdzenie czy musi zmienić hasło
        if ($service->checkIfMustChangePassword()) {
            return 2;
        }

        try {
            $service->addTypesToSession()->addIdToSession()->setToken($mac, $ip);
        } catch (\PHPUnit\Util\Exception $e) {
            Auth::logout();
            return 0;
        }
        return 1;
    }

    public function generatePin($id)
    {
        $pin = (string)random_int(100000, 999999);
        DB::table('pin')->insert(['identity_id' => $id, 'pin' => bcrypt($pin)]);

        Identity::find($id)->notify(new PinEmail($pin));
    }
}
