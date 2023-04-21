<?php

namespace App\Services\System;

use App\Enums\TokenTypeEnum;
use App\Models\System\Identity;
use App\Models\System\Token;

class TokenService
{
    protected Identity $identity;
    protected ?Token $token = null;
    protected string $ip;
    protected mixed $abilities = ['*'];
    protected string $name;

    /** Ustawia identity dla której wykonywane będą operacje na tokenach
     *
     * @param Identity|int $identity
     *
     * @return $this
     */
    public function setIdentity(Identity|int $identity): static
    {
        if (gettype($identity) === 'integer') {
            $this->identity = Identity::find($identity);
        } else {
            $this->identity = $identity;
        }

        return $this;
    }

    /** Ustawia abilities dla tokena
     *
     * @param mixed $abilities
     *
     * @return $this
     */
    public function setAbilities(mixed $abilities): static
    {
        $this->abilities = $abilities;

        return $this;
    }

    /** Ustawia typ tokena // nazwa tokena jest typem, dla którego token zostaje utworzony
     *
     * @param mixed $abilities
     *
     * @return $this
     */
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /** Ustawia adres ip użytkownika dla tokena
     *
     * @param mixed $abilities
     *
     * @return $this
     */
    public function setIp(string $ip): static
    {
        $this->ip = $ip;

        return $this;
    }

    /** Ustawia token
     *
     * @return $this
     */
    public function setToken(): static
    {
        $this->token = $this->identity->tokens
            ->where('name', $this->name)
            ->where('ip_address', $this->ip)
            ->first();

        return $this;
    }

    /** Ustawia token
     *
     * @return Token|null
     */
    public function getToken(): ?Token
    {
        if ($this->token === null) {
            $this->setToken();
        }
        return $this->token;
    }

    /** Sprawdza czy istnieje inny token tego samego typu
     *
     * @param bool $deleteIfExists - jeśli true, usuwa istniejące tokeny danego typu
     *
     * @return bool
     *
     * @throws \Exception
     */
    protected function checkIfOtherTokenExists(bool $deleteIfExists = false): bool
    {
        if ($this->identity === null) {
            throw new \Exception(__('Użytkownik nie jest ustawiony'));
        }
        if ($this->ip === null) {
            throw new \Exception(__('Adres IP nie jest ustawiony'));
        }
        if ($this->name === null) {
            throw new \Exception(__('Typ nie jest ustawiony'));
        }

        if ($deleteIfExists && $this->getToken() !== null) {
            $this->token->delete();
        }

        return $this->getToken() !== null;
    }

    /** Tworzy token z ustawionymi wcześniej danymi
     *
     * @return Token
     *
     * @throws \Exception
     */
    public function createToken(): Token
    {
        if ($this->name === null || $this->ip === null) {
            throw new \Exception(__('Wymagane dane nie zostały ustawione, sprawdź czy ustawiłeś wszystkie dane.'));
        }

        $this->checkIfOtherTokenExists(true);

        $this->token = $this->identity->createToken($this->name, $this->ip, $this->abilities);

        if ($this->token === null) {
            throw new \Exception(__('Nie udało się stworzyć tokena'));
        }

        return $this->token;
    }

    /** Tworzy token logowania dla wcześniej ustawionych danych
     *
     * @return Token|null
     *
     * @throws \Exception
     */
    public function createLoginToken(): ?Token
    {
        $this->name = TokenTypeEnum::Login->value;

        return $this->createToken();
    }


    /** Usuwa token
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function revokeToken(): bool
    {
        if ($this->name === null || $this->ip === null) {
            throw new \Exception(__('Wymagane dane nie zostały ustawione, sprawdź czy ustawiłeś wszystkie dane.'));
        }

        if ($this->token === null) {
            $this->setToken();
        }

        return $this->token->delete();
    }

    /** Usuwa token logowania
     * @return bool
     */
    public function revokeLoginToken(): bool
    {
        $this->name = TokenTypeEnum::Login->value;
        $this->setToken();

        return $this->revokeToken();
    }

    /** Zwraca token logowania
     *
     * @return Token
     */
    public function getLoginToken(): Token
    {
        $this->setName(TokenTypeEnum::Login->value);

        return $this->getToken();
    }

    public function transferToken()
    {

    }

    public function changeToken()
    {

    }

    /**
     * @return Token
     * @throws \Exception
     */
    public function createDownloadToken(string $ip): Token
    {
        $this->ip = $ip;
        $this->name = TokenTypeEnum::Download->value;

        return $this->createToken();
    }

}
