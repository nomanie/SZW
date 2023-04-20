<?php

namespace App\Services\Auth;

use App\Models\System\Identity;
use App\Models\System\Workshop;
use App\Services\System\TokenService;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthService
{
    private bool $dontSendEmail = false;

    public function __construct(
        protected TokenService $tokenService,
        protected Identity|Authenticatable $identity = new Identity()
    )
    {
        //@todo dodać logi
    }

    /** Dodaje typ konta do sesji
     *
     * @return $this
     */
    public function addTypesToSession(): static
    {
        Session::forget('account_type');
        if ($this->identity->workshop) {
            Session::push('account_type', 'workshop');
        }
        if ($this->identity->user) {
            Session::push('account_type', 'client');
        }
        if($this->identity->worker) {
            Session::push('account_type', 'worker');
        }
        if ($this->identity->is_admin) {
            // jeśli admin to loguje na /admin, a tam może przelogować się na inny typ konta
            //@todo zrobić jedno konto warsztat i klient dla wszystkich adminów
            Session::forget('account_type');
            Session::push('account_type', 'admin');
            //@todo dodać do sesji random string i zrobić w db tabele admin_access, tam kolumny id:uuid:ip:datetime
        }

        return $this;
    }

    public function getType(): string
    {
        return Session::get('account_type')[0];
    }

    /** Ustawia identity dla serwisu
     *
     * @param int $id
     *
     * @return $this
     */
    public function setIdentity(int $id): static
    {
        $this->identity = Identity::find($id);

        return $this;
    }

    /** Zwraca widok dashboardu dla danego typu konta
     *
     * @return string
     */
    public function getView(): string
    {
        if (Session::get('account_type')[0] === 'admin') {
            return view('admin.pages.dashboard');
        }
        if (count(Session::get('account_type')) > 1) {
            return view('changeType');
        }
        return Session::get('account_type')[0] . '.pages.dashboard';
    }

    /** Zwraca url do widoku dashboard dla danego typu konta
     *
     * @return string
     */
    public function getRoute(): string
    {
        if (Session::get('account_type') === null) {
            Auth::logout();
        }

        if (Session::get('account_type')[0] === 'admin') {
            return route('admin.dashboard');
        }
        if (count(Session::get('account_type')) > 1) {
            return route('changeType');
        }
        if (Session::get('account_type')[0] === 'worker') {
            return route('workshop.dashboard', $this->getWorkshopUuid());
        }
        return route(Session::get('account_type')[0] . '.dashboard', $this->identity->uuid);
    }

    /** Zwraca url widoku dashboard
     *
     * @return string
     */
    public function getHomeRoute(): string
    {
        $this->identity = auth()->user();
        return $this->getRoute();
    }

    /** Zwraca token dla danego Identity
     *
     * @return mixed
     */
    public function getToken(string $device, string $ip)
    {
        return $this->tokenService->setDevice($device)->setIdentity($this->identity)->setIp($ip)->getLoginToken()->token;
    }

    /** Ustawia id Identity do sesji
     *
     * @return void
     */
    public function addIdToSession(): static
    {
        Session::put('id', $this->identity->id);

        return $this;
    }

    /** Zwraca UUID warsztatu
     *
     * @return void
     */
    private function getWorkshopUuid()
    {
        if ($this->identity->worker->workshop_id !== null) {
            return Workshop::where('id', $this->identity->worker->workshop_id)->first()->uuid;
        }
    }

    /** Zwraca UUID użytkownika
     *
     * @return string
     */
    public function getUuid(): string
    {
        if (Session::get('account_type')[0] == 'worker') {
            return $this->getWorkshopUuid();
        }
        return auth()->user()->uuid;
    }

    /** Zwraca informację, czy użytkownik musi zmienić hasło przy logowaniu
     *
     * @return bool
     */
    public function checkIfMustChangePassword(): bool
    {
        return $this->identity->reset_password;
    }
}
