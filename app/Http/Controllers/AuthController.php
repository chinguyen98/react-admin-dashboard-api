<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

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
}
