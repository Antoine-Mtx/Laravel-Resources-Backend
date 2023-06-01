<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{

    public function register(Request $request): JsonResponse
    {
        $user = false;
        try {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);

            // Envoi mail de vérification : obtient token à vérifier
            $response = $this::verifyMail($input['email']);

            return response()
                ->json($response)
                ->setStatusCode(Response::HTTP_CREATED);
        } catch (Exception $e) {
            if($user)
                $user->delete();

            if($e->getCode() == 23000) { // contraintes BDD
                $error = match (true) {
                    str_contains($e->getMessage(), 'users.email') => 'Veuillez utiliser une autre adresse mail.',
                    str_contains($e->getMessage(), 'users.username') => 'Veuillez utiliser un autre nom d\'utilisateur.',
                    default => 'Impossible de créer un compte avec ces informations, veuillez contacter un administrateur.',
                };
            } else if(str_contains($e->getMessage(), 'RFC 2822')) { // problème format email
                $error = "Veuillez fournir une addresse mail valide.";
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

    /**
     * @desc Créer un token de vérification + envoi d'un mail avec url + token pour vérifier le compte
     * @param $email string l'uutilisateur
     * @return boolean
     */
    private static function verifyMail($email = 'roulier.lucie@outlook.fr')
    {
        $user = User::where('email', $email)->first();
        $token = $user->saveToken();

        // TODO : appeler mail avec $token + $user->username
        Mail::to($email)->send(new VerifyEmail($user->username, $token));
        return true;
    }
}
