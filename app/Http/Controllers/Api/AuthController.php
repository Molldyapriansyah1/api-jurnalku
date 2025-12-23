<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Delete old tokens for this user
        DB::table('personal_access_tokens')
            ->where('tokenable_type', 'App\\Models\\User')
            ->where('tokenable_id', $user->id_user)
            ->delete();

        // Manually create token in database
        $tokenString = bin2hex(random_bytes(40));
        $hashedToken = hash('sha256', $tokenString);
        
        DB::table('personal_access_tokens')->insert([
            'tokenable_type' => 'App\\Models\\User',
            'tokenable_id' => $user->id_user,
            'name' => 'auth_token',
            'token' => $hashedToken,
            'abilities' => '["*"]',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $tokenId = DB::getPdo()->lastInsertId();
        $token = $tokenId . '|' . $tokenString;

        Log::info('Token created for user: ' . $user->id_user);
        Log::info('Token: ' . $token);

        return response()->json([
            'token' => $token,
            'user' => [
                'id_user' => $user->id_user,
                'username' => $user->username,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ],
        ], 200);
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            // Delete all tokens for this user
            DB::table('personal_access_tokens')
                ->where('tokenable_type', 'App\\Models\\User')
                ->where('tokenable_id', $request->user()->id_user)
                ->delete();
        }
        
        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }
}