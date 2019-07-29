<?php
namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserServices;
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

        return response($data, 200);
    }

    public function login(loginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            /** @var User $user */
            $user          = Auth::user();
            $user['token'] = $user->createToken('App')->accessToken;
            return response(['data' => $user], 200);

        }

        return response('', Response::HTTP_UNAUTHORIZED);
    }

    public function getMyBoard()
    {
        return response($this->userServices->getMyBoard(),200);
    }
}
