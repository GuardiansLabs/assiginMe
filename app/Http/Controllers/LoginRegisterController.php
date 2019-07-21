<?php
namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\UserServices;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginRegisterController extends Controller
{
    /** @var UserServices */
    public $userServices;

    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function register(RegisterRequest $request)
    {
        $data = $this->userServices->create($request->toArray());

        return response(['data' => $data], 200);
    }

    public function login(loginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            /** @var User $user */
            $user          = Auth::user();
            $user['token'] = $user->createToken('App')->accessToken;

            return $user;
        }

        return response('', Response::HTTP_UNAUTHORIZED);
    }
}
