<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{

    public function register(Request $request): JsonResponse
    {
        try {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            return response()
                ->json($user)
                ->setStatusCode(Response::HTTP_CREATED);
        } catch (Exception $e) {
            if($e->getCode() == 23000) {
                $error = match (true) {
                    str_contains($e->getMessage(), 'users.email') => 'Veuillez utiliser une autre adresse mail.',
                    str_contains($e->getMessage(), 'users.username') => 'Veuillez utiliser un autre nom d\'utilisateur.',
                    default => 'Impossible de créer un compte avec ces informations, veuillez contacter un administrateur.',
                };
            } else {
                $error = 'Une erreur est survenue lors de la création du compte. Veuillez réessayer plus tard.';
            }
            return response()
                ->json(['error' => $error])
                ->setStatusCode(Response::HTTP_UNAUTHORIZED);
        }
    }


    public function login(Request $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $token =  $user->createToken('RR', ['*'], now()->addMinutes(60))->plainTextToken;

            return response()
                ->json(['token' => $token, 'user' => $user])
                ->setStatusCode(Response::HTTP_ACCEPTED);
        }
        else{
            return response()
                ->json(['error' => 'Identifiants incorrects'])
                ->setStatusCode(Response::HTTP_UNAUTHORIZED);
        }
    }
}
