<?php

namespace App\Services\Auth;

use App\Models\System\Identity;
use App\Models\System\Workshop;
use App\Services\System\TokenService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

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
     * @return array|string
     */
    public function getType(int $identity = null): array|string
    {
        if ($identity) {
            $this->setIdentity($identity);
        }

        $types = [];

        if ($this->identity->workshop) {
            $types[] = 'workshop';
        }
        if ($this->identity->user) {
            $types[] = 'client';
        }
        if($this->identity->worker) {
            $types[] = 'worker';
        }
        if ($this->identity->is_admin) {
            $types = 'admin';
        }

        return $types;
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
    public function getView(array $types): string
    {
        if (in_array('admin', $types)) {
            return view('admin.pages.dashboard');
        }
        if (count($types) > 1) {
            return view('changeType');
        }
        return $types[0] . '.pages.dashboard';
    }

    /** Zwraca token dla danego Identity
     *
     * @return mixed
     */
    public function getToken(string $ip)
    {
        return $this->tokenService->setIdentity($this->identity)->setIp($ip)->getLoginToken()->token;
    }

    /** Zwraca UUID warsztatu
     *
     * @return void
     */
    private function getWorkshopUuid(): ?string
    {
        if ($this->identity->worker->workshop_id !== null) {
            return Workshop::where('id', $this->identity->worker->workshop_id)->first()->uuid;
        }
    }

    /** Zwraca UUID użytkownika
     *
     * @return string
     */
    public function getUuid(array $types): string
    {
        if (in_array('worker', $types)) {
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
