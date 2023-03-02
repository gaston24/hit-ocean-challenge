<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserLife;

class AuthController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','create']]);
    }

    public function login(Request $request)
    {  
        $credentials = $request->only('email', 'password');
        if ($token = Auth::attempt($credentials)) {
            
            $response = $this->respondWithToken($token);

            return $this->sendResponse($response, "User logged in");
        }

        return $this->sendError("Unauthorized", [], 401);
    }

    protected function respondWithToken($token)
    {        
 
        $response = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];

        return $this->sendResponse($response, "Access token");
    }

    public function create(Request $request) {
        
        $user = $request;
        
        if(!empty($user->name) && !empty($user->email) && !empty($user->password) && !empty($user->user_type)) {
            
            $newUser = User::create([

                'name' => $user->name,
                'email' => $user->email,
                'player_type' => $user->player_type,
                'user_type' => $user->user_type,
                'password' => bcrypt($user->password)

            ]);

            if($user->user_type == "p") {
                $newUserLife = UserLife::create([
                    'user_id' => $newUser->id, 
                    'life_points' => 100
                ]);
            }
            
            return $this->sendResponse([$newUser, $newUserLife], "User added");
        }

        return $this->sendError("Missing parameters", [], 401);
    
    }

}