<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;




class LoginController extends Controller
{
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentifizierung erfolgreich, erzeuge Token für den Nutzer
            $user = Auth::user();
            // Generate a new token for the user...
            $tokenResult = $user->createToken('auth_token');
            
            return ['token' => $tokenResult->plainTextToken];
        }

        // Authentifizierung fehlgeschlagen, gebe Fehler zurück
        return response()->json(['errors' => ['general' => 'E-Mail oder Passwort falsch.']], 422);
    }

    public function checkAuth(Request $request)
    {
        return new UserResource($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out'], 200);
    }



}
