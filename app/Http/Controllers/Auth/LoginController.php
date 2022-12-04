<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\System\Identity;
use App\Models\User;
use App\Services\Auth\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __construct(protected RegisterService $service){}

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if (!auth()->attempt($data, $request->get('remember_me'))) {
            return response()->json(['errors' => ['password' => [0 => 'Hasło jest niepoprawne']]], 422);
        }

        $this->service->setIdentity(auth()->user()->id)->addTypesToSession();
        return $this->service->getRoute();
    }

    public function logout(Request $request)
    {
        $user = User::find(auth()->user())->first();
        $user->setRememberToken();

        return redirect('/');
    }
}
