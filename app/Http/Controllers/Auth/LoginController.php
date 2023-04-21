<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(protected LoginService $service){
        $this->middleware('guest')->except('logout');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $response = $this->service->login($data, $request->get('remember_me'), $request->getClientIp());

        if (gettype($response) === 'object') {
            return $response;
        } else if ($response === 2) {
            return response()->json([
                'route' => 'change-password',

            ]);
        } else if ($response === 3) {
            return response()->json([
                'route' => '2fa',
            ]);
        }
        else {
            return response()->json(['errors' => ['password' => [0 => 'Hasło jest niepoprawne']]], 422);
        }

    }

    public function logout(Request $request)
    {
        $this->service->setIdentity(auth()->user()->id)->logout(exec('getmac'), $request->getClientIp());

        return ['route' => 'login'];
    }
}
