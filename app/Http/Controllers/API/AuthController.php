<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class AuthController extends Controller
{
    public function register(Request $request)
    {


        try {

            // $validation = Validator::make($request->all(), [
            //     'name' => 'required|max:55',
            //     'email' => 'email|required|unique:users',
            //     'password' => 'required|confirmed'
            // ]);

            $validation = $request->validate([
                'name' => 'required|max:55',
                'email' => 'email|required|unique:users',
                'password' => 'required|confirmed'
            ]);

            // if ($validation->fails()) {

            //     $result['code'] = 400;
            //     $result['error'] = true;
            //     $result['message'] = $validation->messages()->first();
            //     return response()->json($result);

            // }


            $validation['password'] = Hash::make($request->password);

            $user = User::create($validation);

            $accessToken = $user->createToken('authToken')->accessToken;

            return response(['user' => $user, 'access_token' => $accessToken], 201);

        } catch (Exception $e) {

            return response()->json($e->getMessage());
        }
    }

    public function login(Request $request)
    {

        try {

            $loginData = $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);


            if (!auth()->attempt($loginData)) {
                return response(['message' => 'This User does not exist, check your details'], 400);
            }

            $accessToken = auth()->user()->createToken('authToken')->accessToken;

            return response(['user' => auth()->user(), 'access_token' => $accessToken]);

        } catch (Exception $e) {

            return response()->json($e->getMessage());
        }
    }
}