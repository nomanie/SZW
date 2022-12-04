<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\System\Identity;
use App\Services\Auth\RegisterService;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function __construct(
        protected RegisterService $service
    ){}

    public function verify(Request $request, int $id)
    {
        $this->service->setIdentity($id)->verifyMail();

        return view('auth.login')->with(['verified' => true]);
    }
}
