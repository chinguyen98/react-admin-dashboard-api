<?php

namespace App\Http\Controllers;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use function response;

class ResourceController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllUser()
    {
        $users = User::all([
            'name',
        ]);

        return response()->json([
            'users' => $users,
        ], Response::HTTP_OK);
    }
}
