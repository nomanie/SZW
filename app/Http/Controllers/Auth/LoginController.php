<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __construct(protected AuthService $service){}

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt($data, $request->get('remember_me'))) {
            $this->service->setIdentity(auth()->user()->id)->addTypesToSession()->addIdToSession();

            return response()->json([
                'route' => $this->service->getRoute(),
                'id' => auth()->user()->uuid,
            ]);
        }
        return response()->json(['errors' => ['password' => [0 => 'Hasło jest niepoprawne']]], 422);

    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/login');
    }
}
