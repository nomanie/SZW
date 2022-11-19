<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validated();

        if (!auth()->attempt($data, $request->get('remember_me'))) {
            return response()->json(['errors' => ['password' => [0 => 'Hasło jest niepoprawne']]], 422);
        }

    }

    public function logout(Request $request)
    {
        $user = User::find(auth()->user())->first();
        $user->setRememberToken();

        return redirect('/');
    }
}
