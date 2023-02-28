<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        
        $name = $request->input("name");
        $email = $request->input("email");
        $password = $request->input("password");
        
        if(!empty($name) && !empty($email) && !empty($password)) {
            
            $user = new User();
            $user->name=$name;
            $user->email = $email;    
            $valiEmail = User::where('email', $email)->first();
            if(!empty($valiEmail['email'])) {
                return view('register', [
                    "information"=> "email exist"
                ]);  
            }
      
            $user->password = bcrypt($password);
       
            $response = $user->save();
            
            return $this->sendResponse($response, "User added");
        }

        return $this->sendError("Missing parameters", [], 401);
    
    }
}