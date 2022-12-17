<?php

namespace App\Services\Workshop;

use App\Enums\Workshop\MediableTypeEnum;
use App\Models\Workshop\Mediable;
use Illuminate\Support\Facades\Storage;

class MediableService
{
    protected Mediable $mediable;
    protected string $disk;
    protected string $path;
    protected string $ext = '.pdf';
    protected string $filename;
    protected string $type;
    protected ?string $delete_at = null;

    protected string $size;

    /** Ustawia dysk na którym będą wykonywane operacje
     * @param string $disk nazwa dysku
     * @return $this
     */
    public function setDisk(string $disk): static
    {
        $this->disk = $disk;

        return $this;
    }

    /** Ustawia scieżkę pliku
     * @param string $path scieżka
     * @return $this
     */
    public function setPath(string $path): static
    {
        $this->path = $path;

        return $this;
    }

    /** Ustawia rozszerzenie pliku
     * @param string $ext rozszerzenie
     * @return $this
     */
    public function setExtension(string $ext): static
    {
        $this->ext = $ext;

        return $this;
    }

    /** Ustawia nazwę mediable bez rozszerzenia
     * @param string $name
     * @return $this
     */
    public function setFilename(string $name): static
    {
        $this->filename = explode('.', $name)[0];

        return $this;
    }

    /** Ustawia typ mediable
     * @param string $type
     * @return $this
     */
    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /** Ustawia date usunięcia pliku
     * @param $datatime
     * @return $this
     */
    public function deleteAt($datatime): static
    {
        $this->delete_at = $datatime;

        return $this;
    }

    /** Ustawia obiekt mediable
     * @param Mediable|int $mediable
     * @return $this
     */
    public function setMediable(Mediable|int $mediable): static
    {
        if (gettype($mediable) === 'int') {
            $mediable = Mediable::find($mediable);
        }

        $this->mediable = $mediable;

        return $this;
    }

    /** Dodaje rekord do bazy mediable
     *
     * @param bool $new Tworzy nowy obiekt jeśli true
     * @return Mediable
     */
    public function store($new = true): Mediable
    {
        if ($new) {
            $this->mediable = new Mediable();
        }
        $this->mediable->disk = $this->disk;
        $this->mediable->extension = $this->ext;
        $this->mediable->name = $this->filename;
        $this->mediable->type = $this->type;
        $this->mediable->delete_at = $this->delete_at;
        $this->mediable->size = $this->size;
        $this->mediable->save();

        return $this->mediable;
    }

    /** Aktualizuje rekord w tabeli
     * @return Mediable
     */
    public function update(): Mediable
    {
        return $this->store(false);
    }

    /** Usuwa rekord z tabeli
     * @return bool
     */
    public function delete(): bool
    {
       if ($this->mediable->delete()) {
           return true;
       }

        return false;
    }

    /** Usuwa rekord z tabeli wraz z plikiem
     * @return bool
     */
    public function deleteWithFile(): bool
    {
        Storage::disk($this->disk)->delete(MediableTypeEnum::getPath($this->mediable->type) . $this->filename . $this->ext);

        return false;
    }

    /** Ustawia wielkość pliku
     * @param string $size
     * @return $this
     */
    public function setSize(string $size): static
    {
        $this->size = $size;

        return $this;
    }
}
