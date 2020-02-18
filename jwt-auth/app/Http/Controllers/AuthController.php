<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::all();
        return response()->json([$users]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request){

        $v = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:18'
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }

        $user = User::query()->create($request->all());

        //login after sign up
        $token = auth()->login($user);

        return $this->respondWithToken($token);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

     public function login(Request $request)
     {
         $credentials = $request->only(['email', 'password']);
         $token = auth()->attempt($credentials);
         if(!$token){
             return response()->json(['error' => 'Unauthorized'], 401);
         }
         return $this->respondWithToken($token);
     }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
     public function logout()
     {
        auth()->logout();
        return response()->json(['message' => 'successfully logged out'], 200);
     }

    /**
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
      protected function respondWithToken($token)
      {
          return response()->json([
              'access_token' => $token,
              'token_type' => 'bearer',
              'expires_in' => auth()->factory()->getTTL() * 60
          ]);
      }


}
