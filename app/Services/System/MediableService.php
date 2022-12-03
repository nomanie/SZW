<?php

namespace App\Services\System;

use App\Models\System\Mediable;
use Maatwebsite\Excel\Files\Disk;

class MediableService
{
    public function __construct(protected Mediable $mediable = new Mediable())
    {

    }

    /**Zapisuje nowy plik w bazie danych i na serwerze
     * @param array $data
     * @param string $mediable_type
     * @param int $mediable_id
     * @return Mediable
     */
    public function store(array $data, string $mediable_type, int $mediable_id): Mediable
    {
        $this->mediable->name = $data['name'] ?? 'plik';
        $this->mediable->path = $data['path'];
        $this->mediable->mediable_type = $mediable_type;
        $this->mediable->id = $mediable_id;
        $this->mediable->save();

        return $this->mediable;
    }

    /**Zwraca instancje pliku
     * @return Mediable
     */
    public function get(): Mediable
    {
        return $this->mediable;
    }


    /**Aktualizuje plik w bazie danych
     * @param array $data
     * @return Mediable
     */
    public function update(array $data): Mediable
    {
        $this->mediable->name = $data['name'];
        $this->mediable->path = $data['path'];
        $this->mediable->save();

        return $this->mediable;
    }

    /**Usuwa plik z bazy danych oraz serwera
     * @return bool
     */
    public function destroy(): bool
    {
        Disk::storage();
        if ($this->mediable->delete()) {
            return true;
        }

        return false;
    }
}
