<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','create']]);
    }

    public function login(Request $request)
    {  
        $credentials = $request->only('email', 'password');
        if ($token = Auth::attempt($credentials)) {
            
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function test(Request $request)
    {  
        $response = 'hola mundo';

        return response()->json(['msg' => $response, 200]);
    }

    protected function respondWithToken($token)
    {        
 
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
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
       
            $user->save();
            return response()->json(['msg' => 'user added']);
        }
    
    }
}