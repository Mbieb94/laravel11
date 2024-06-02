<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Response\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $loginField;
    protected $loginValue;
    
    public function __construct(Request $request)
    {
        $this->loginField = filter_var(
            $request->get('login'),
            FILTER_VALIDATE_EMAIL
        ) ? 'email' : 'username';
        $this->loginValue = $request->get('login');
    }

    public function login(Request $request, ApiResponse $response)
    {
        $request->validate([
            'login' => 'required', 
            'password' => 'required'
        ]);
        
        $credentials = [
            $this->loginField => $this->loginValue,
            'password' => $request->get('password')
        ];
        
        if (!Auth::attempt($credentials, true)) {
            return $response->status(401)
                ->message('Failed to login')
                ->statusText('Authentication failed')
                ->send();
        }

        
        $user = $request->user();
        // $tokenResult = $user->createToken('Personal Access Token', ['*'], now()->addMinute());
        $tokenResult = $user->createToken('Personal Access Token');

        $dataResponse = ['token' => $tokenResult->plainTextToken, 'user' => $user];
        
        return $response->data($dataResponse)->message('Login Success')->send();
    }

    public function logout(ApiResponse $response)
    {
        request()->user()->currentAccessToken()->delete();
        
        return $response->message('You have been successfully logged out!')->send();
    }
}
