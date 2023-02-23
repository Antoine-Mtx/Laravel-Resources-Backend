<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{

    public function login(Request $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $token =  $user->createToken('RR', ['*'], now()->addMinutes(60))->plainTextToken;
//            $user->api_token = $token;
//            $user->save();

            return response()
                ->json([
                    'token' => $token, 'user' => $user
                ])
                ->setStatusCode(Response::HTTP_ACCEPTED);
        }
        else{
            return response()->json($request)->setStatusCode(Response::HTTP_UNAUTHORIZED);
        }
    }
}
