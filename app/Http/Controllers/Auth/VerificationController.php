<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\RegisterService;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    use JsonResponseTrait;

    public function __construct(
        protected RegisterService $service
    ){}

    public function verify(Request $request, int $id)
    {
        $this->service->setIdentity($id)->verifyMail();

        return $this->successJsonResponse(__('Adres e-mail został potwierdzony! Teraz możesz się zalogować'));
    }
}
