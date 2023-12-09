<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Roles;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator= Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            // 'password' => ['required', 'confirmed', Roles\Password::defaults()],
        ], [], [
            'name' => 'Name',
            'email' =>'Email',
            'password' => 'Password',
        ]);
        
        if($validator->fails()) {
            return ApiResponse::sendResponse(422, 'Register Validation Error', $validator->messages()->all());
        }

        $user= User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $data['token'] = $user->createToken('ApiTest')->plainTextToken;
        $data['name'] = $user->name;
        $data['email'] = $user->email;

        return ApiResponse::sendResponse(201, 'User Account Created Successfully', $data);
    }
    
    public function login(Request $request){

        $validator= Validator::make($request->all(), [
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required'],
        ], [], [
            'email'=> 'Email',
            'password' => 'Password',
        ]);

        if($validator->fails()){
            return ApiResponse::sendResponse(422, 'Login Validation Error',  $validator->errors());
        }

        if(Auth::attempt(['email'=> $request->email, 'password' => $request->password])){
            $user = Auth::user();

            $data['token'] = $user->createToken('ApiTest')->plainTextToken;
            $data['email'] = $user->email;
            $data['password'] = $user->password;

            return ApiResponse::sendResponse(200, 'Login Successfuly', $data); // لما البانات تتبعت

        } else {

            return ApiResponse::sendResponse(401, 'User credentials doesn\'t exist', null); // لو البانات غلط

        }

    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return ApiResponse::sendResponse(200, 'Logged Out Successfully', null);
    }
    
}
