<?php

namespace App\Traits;

use App\Models\System\Identity;
use App\Models\System\Token;
use App\Models\System\Workshop;
use Illuminate\Support\Facades\Session;
use PHPUnit\Util\Exception;
use Illuminate\Http\Request;
trait UseTenantConnection
{
    /** Ustawia bazę danych na kliencką
     *
     */
    public function __construct(Request $request = null)
    {
        if (auth()->user() === null){
            if ($token = $this->getAuthorizationToken($request)) {
                $this->setTableByToken($token, $request->header('type'));
            } else {
                throw new Exception('Użytkownik nie jest zalogowany');
            }
        } else if (auth()->user()?->worker !== null) {
            $this->setTableForWorker(auth()->user()->worker->workshop_id);
        } else {
            $this->setTableForWorkshopAdmin(auth()->user()->id);
        }
    }

    /** Zwraca bazę danych danego użytkownika (do użytku przy n:m relacjach)
     *
     * @return string
     */
    public function getDatabase(): string
    {
        return explode('.', $this->table)[0];
    }

    /** Ustawia tabelę dla pracownika
     *
     * @return bool
     */
    public function setTableForWorker(int $id): void
    {
        $this->table = Workshop::where('id', $id)
                ->first()->tenancy_db_name . '.' . $this->getTable();
    }

    /** Ustawia tabelę dla administratora warsztatu
     * @return bool
     */
    public function setTableForWorkshopAdmin(int $id): void
    {
        $this->table = Workshop::where('identity_id', $id)
                ->first()->tenancy_db_name . '.' . $this->getTable();
    }

    protected function getAuthorizationToken(Request $request): string
    {
        $authorization = explode(' ', $request->header('authorization'));
        if ($authorization[0] !== 'Bearer') {
            return false;
        }

        return $authorization[1];
    }

    protected function setTableByToken(string $token, string $type): void
    {
        $identity = Identity::find(Token::where('token', $token)->first()->tokenable_id);
        if ($type === 'workshop') {
            $this->setTableForWorkshopAdmin($identity->id);
        } else if($type === 'worker') {
            $this->setTableForWorker($identity->id);
        } else {
            throw new Exception('Błędny typ użytkownika');
        }
    }
}
