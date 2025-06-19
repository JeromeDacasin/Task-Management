<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService 
{
    public function __construct(protected User $user)
    {
        
    }

    public function register($request) 
    {
        $hashedPassword = Hash::make($request->password);

        $createUser = $this->user->create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $hashedPassword,
            'is_admin'  => $request->is_admin ?? 0
        ]);

        if (!$createUser) {
            return response()->json([
                'message' => 'Cannot Register Right now',
                'status'  => 400,
            ], 400);
        }  

        return response()->json([
            'message' => 'Successfully registered',
            'status'  => 200
        ], 200);
    }

    public function login($request)
    {
        $user = $this->user::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages(['message' => 'Invalid Credentials']);
        }
        
        $oneDay = 60 * 24;

        $token = $user->createToken('token', ['*'], now()->addWeek())->plainTextToken;
        $cookie = cookie('jwt', $token, $oneDay);
        
        return response()->json([
            'token'    => $token,
            'name'     => ucwords($user->name),
            'is_admin' => $user->is_admin,
        ])->withCookie($cookie);
        
    }
}