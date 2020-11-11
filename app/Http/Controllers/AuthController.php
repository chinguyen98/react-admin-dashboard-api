<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * @param SignUpRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(SignUpRequest $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->password = Hash::make($request->input('password'));
        $user->email = $request->input('email');

        try {
            $user->save();

            return response()->json([
                'message' => 'Sign up successfully!',
                'status' => Response::HTTP_OK,
            ], Response::HTTP_OK);
        } catch (\Exception $err) {
            return response()->json([
                'message' => 'This email is used!',
                'status' => Response::HTTP_CONFLICT,
            ], Response::HTTP_CONFLICT);
        }
    }

    public function signin(SignInRequest $request)
    {
        $credential = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($credential)) {
            return response()->json([
                'message' => 'Invalid email or password!',
                'status' => Response::HTTP_UNAUTHORIZED,
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'status' => Response::HTTP_OK,
            'token' => $token,
        ], Response::HTTP_OK);
    }
}
