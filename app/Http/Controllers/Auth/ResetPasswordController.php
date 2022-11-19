<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('quest.pages.start')->with(
            ['token' => $token, 'email' => $request->email, 'resetPassword' => true]
        );
    }
}
