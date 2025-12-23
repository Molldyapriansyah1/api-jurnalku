<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CustomSanctumAuth
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        
        if (!$token) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Split token ID from the actual token
        $parts = explode('|', $token, 2);
        
        if (count($parts) !== 2) {
            return response()->json(['message' => 'Invalid token format.'], 401);
        }

        [$id, $tokenString] = $parts;
        $hashedToken = hash('sha256', $tokenString);

        // Find the token in database
        $accessToken = DB::table('personal_access_tokens')
            ->where('id', $id)
            ->where('token', $hashedToken)
            ->first();

        if (!$accessToken) {
            return response()->json(['message' => 'Invalid token.'], 401);
        }

        // Find the user
        $user = User::where('id_user', $accessToken->tokenable_id)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 401);
        }

        // Set the user in the request
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $next($request);
    }
}