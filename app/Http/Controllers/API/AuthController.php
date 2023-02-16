<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
    public function register(Request $request){
        //validator
        $validator = Validator::make($request->all(),[
             'name' => 'required',
             'email' => 'required|email',
             'username' => 'required',
             'password' => 'required',
             'c_password' => 'required|same:password',
        ]);
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response,400);
        }

        $input = $request->all();

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        $response = [
            'success' => true,
            'data' => $success,
            'message' => "Register User Successfuly "
        ];
        return response()->json($response,200);
    }
    public function login(Request $request){
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required'
            ]);

            $credentials = request(['username', 'password']);

            $user = User::where('username', $request->username)->first();

            if (!\Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Đăng nhập thất bại');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([

                'status_code' => 200,
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Đăng nhập thất bại',
                'error' => $error,
            ]);
        }
    }
}
