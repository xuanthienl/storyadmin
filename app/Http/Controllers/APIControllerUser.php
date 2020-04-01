<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class APIControllerUser extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            // 'c_password' => 'required|same:password',

        ]);

        if($validator->fails()){
            return response()->json(['message' => 'unsuccessful!']);      
        }

        $user = App\User::create($request->all());
        // $success['token'] =  $user->createToken('MyApp')->accessToken;
        // $success['name'] =  $user->name;

        return response()->json($user);
        // return response()->json([
        //     'message' => 'success.',
        //     'story' => $user
        // ]);
    }
}
