<?php

namespace App\Services\Auth;

use App\Models\AuthorizedDevice;
use App\Models\System\Identity;
use App\Models\System\Token;
use App\Models\UserCode;
use App\Notifications\PinEmail;
use App\Traits\JsonResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginService extends AuthService
{
    use JsonResponseTrait;

    private bool $dontSendEmail = false;

    /** Tworzy token logowania dla użytkownika oraz zapisuje go w sesji
     *
     * @param string $ip
     *
     * @return ?Token
     *
     * @throws Exception
     */
    public function setToken(string $ip): ?Token
    {
        return $this->tokenService->setIdentity($this->identity)->setIp($ip)->createLoginToken();
    }

    /** Usuwa token logowania użytkownika oraz czyści jego sesje
     *
     * @param string $ip
     *
     * @return bool
     */
    public function logout(string $ip): bool
    {
//        $this->tokenService->setIdentity($this->identity)->setIp($ip)->revokeLoginToken();
        Auth::logout();

        return true;
    }

    /** Sprawdza stan logowania użytkownika
     *
     * @param array $data
     * @param $remember_me
     * @param $ip
     *
     * @return JsonResponse|int
     *
     * @throws Exception
     */
    public function login(array $data, $remember_me, $ip): JsonResponse|int
    {
        $mac = exec('getmac');
        $identity = Identity::where('email', $data['email'])->first();

        if (Auth::attempt($data, $remember_me)) {
            // sprawdzenie czy użytkownik ma zapamiętane urządzenie
            $hasAuthorized = DB::table('authorized_devices')
                    ->where('identity_id', auth()->user()->id)
                    ->where('ip_address', $ip)
                    ->where('mac_address', $mac)
                    ->count() > 0;
            if ($hasAuthorized) {
                // jeśli tak to loguje
                return $this->loginSuccess($identity, $ip);
            } else {
                // jeśli nie to generuje kod, wysyła go mailem i usuwa sesje usera
                $this->generateCode($identity->id);
                return 3;
            }
        }
        Auth::logout();
        return 0;
    }

    /** Uruchamia procedurę po udanym logowaniu
     * @param Identity $identity
     * @param string $ip
     * @return JsonResponse
     * @throws Exception
     */
    public function loginSuccess(Identity $identity, string $ip): JsonResponse
    {
        $token = $this->setIdentity($identity->id)->setToken(exec('getmac'), $ip);
        $type = $this->getType($identity->id);

        AuthorizedDevice::insert(['identity_id' => $identity->id, 'ip_address' => $ip, 'mac_address' => exec('getmac')]);

        return $this->successJsonResponse(__('Zalogowano pomyślnie, za chwilę nastąpi przekierowanie'), 200, [
            'user' => [
                'uuid' => $identity->uuid,
                'is_admin' => $identity->is_admin,
                'type' => $type[0],
                'token' => $token->token,
                'email' => $identity->email
            ],
            'route' => $type[0] . '.dashboard'
        ]);
    }

    /** Generuje kod autoryzacyjny oraz wysyła go na maila
     *
     * @param $id
     *
     * @return void
     *
     * @throws Exception
     */
    public function generateCode($id): void
    {
        $code = (string)random_int(100000, 999999);
        UserCode::insert(['identity_id' => $id, 'code' => bcrypt($code), 'created_at' => now()]);

        Identity::find($id)->notify(new PinEmail($code));
    }

    /** Sprawdza czy podany kod istnieje w bazie danych, jest przypisany do tego użytkownika oraz czy nie wygasł
     *
     * @param int $identity_id
     * @param string $code
     *
     * @return bool
     */
    public function checkCode(int $identity_id, string $code): bool
    {
        $codes = UserCode::where('identity_id', $identity_id)
            ->where('created_at', '>=', now()->subMinutes(5))
            ->select('code')
            ->get();

        foreach ($codes as $encryptedCode) {
            if (Hash::check($code, $encryptedCode->code)) {
                return true;
            }
        }

        return false;
    }
}
