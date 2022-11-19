<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Auth\RegisterService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify(Request $request, int $id)
    {
        (new RegisterService(User::find($id)))->verifyMail();

        return view('auth.login')->with(['verified' => true]);
    }
}
