<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationController extends Controller
{
    //
    public function createAccount(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

         if ($validator->fails()) {
            return response()->json(['status' => false, 'response' => new \stdClass(), 'message' => $validator->errors()->first(), 'code' => Response::HTTP_UNPROCESSABLE_ENTITY], Response::HTTP_OK);
        }



        $user = User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'email' => $request->email
        ]);

         return response()->json(['status' => true, 'response' => ['token' => $user->createToken('tokens')->plainTextToken], 'message' => $validator->errors()->first(), 'code' => Response::HTTP_UNPROCESSABLE_ENTITY], Response::HTTP_OK);

       
    }
    public function signin(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);

        if (!Auth::attempt($attr)) {
            return $this->error('Credentials not match', 401);
        }

        return $this->response([
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ]);
    }

    // this method signs out users by removing tokens
    public function signout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }

}
