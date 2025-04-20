<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController

{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'email'      => 'required|email',
            'password'   => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);

        $success['id']    =  $user->id;
        $success['name']  =  $user->name;
        $success['email'] =  $user->email;
        $success['fidelityPts'] = $user->fidelity_pts;

        $success['token'] =  $user->createToken('pass_api')->plainTextToken;

        return $this->sendResponse($success, 'User register successfully.');
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            $user = Auth::user();

            $success['id']    = $user->id;
            $success['name']  =  $user->name;
            $success['email'] =  $user->email;
            $success['fidelityPts'] = $user->fidelity_pts;

            $success['token'] =  $user->createToken('pass_api')->plainTextToken;

            $user->setRememberToken($success['token']);

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{

            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised'],401);
        }
    }

}
