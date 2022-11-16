<?php

namespace App\Services\Auth;

use App\Models\User;

class RegisterService
{
    public function __construct(User $user = new User())
    {}

    public function save(array $data): User
    {

    }

    public function sendVerificationEmail(array $data): void
    {

    }

    public function verifyMail(array $data): void
    {

    }

    public function sendLinkToRegisterNewClient(array $data): void
    {

    }
}
