<?php
namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class LoginRegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        return response(['data' => $request], 200);
    }

    public function login(loginRequest $request)
    {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return Auth::user();
        }
    }
}
