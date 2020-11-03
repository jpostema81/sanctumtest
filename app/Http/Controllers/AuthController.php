<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Login;
use App\User;


class AuthController extends Controller
{
    public function login(Login $request)
    {
        $validatedInput = $request->validated();
        
        try 
        {
            if($this->guard()->attempt($validatedInput)) 
            {
                $user = $this->guard()->user();

                return $user;
            } 
            else 
            {
                return response()->json(['message' => ['Ongeldige gebruikersnaam / wachtwoord combinatie']], 401);
            }
        } 
        catch (\Exception $e) 
        {
            return response()->json(['message' => 'Fout bij het genereren van token: ' . $e->getMessage()], 500);
        }
        
    }

    public function me(Request $request) {
        return Auth::user();
    }

    /**
     * See: https://github.com/laravel/airlock#authenticating-mobile-applications.
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    public function loginTokenBased(Login $request)
    {
        $validatedInput = $request->validated();

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;
        $data = ['token' => $token];

        return response()->json($data, 200);
    }

    public function logout()
    {
        $this->guard()->logout();
        return response()->json(['message' => 'U bent nu uitgelogd']);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('web');
    }
}
