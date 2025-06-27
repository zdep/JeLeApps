<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsersAuth;
use Illuminate\Http\Request;
use App\Http\Requests\UsersRegistrationRequest;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function registration(UsersRegistrationRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = User::create(request()->only([ 'email', 'password', 'gender' ]));
        $token = $this->createToken();

        UsersAuth::create([
            'token' => $token,
            'users_id' => $user->id,
        ]);

        return response()->json([ 'token' => $token ], 202);
    }

    public function profile(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$user_auth = UsersAuth::whereToken($request->bearerToken())->first()) {
            return response()->json(
                [
                    'error' => 11,
                    'error_text' => 'Not found',
                ],
                404
            );
        }

        return response()->json($user_auth->user()->first(), 200);
    }

    // разместил метод временно здесь, но как только появятся хэлперы, перенес бы туда
    private function createToken(): string
    {
        return sha1(Str::random(40)).sha1(Str::random(40));
    }
}
