<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use App\Http\Resources\TutorialResource;
use App\Repositories\TutorialRepository;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
    /**
     * @desc Ajoute un tutorial avec l'id_resource associé
     * @param string $id
     * @param array $data
     * @return TutorialResource
     */
    public static function store(string $id, array $data): TutorialResource
    {
        $params = ['id_resource' => $id];
        foreach ($data as $key => $value){
            $params[$key] = $value;
        }
        $tutorial = Tutorial::create($params);

        return new TutorialResource($tutorial);
    }


    /**
     * @desc Liste ressources type tuto visibles + non archivées , avec auteur (user) & category & tuto
     * @return JsonResponse
     */
    public static function get_visible_tutorials()
    {
        $tutorials = TutorialRepository::get_visible_tutorials();
        return response()->json($tutorials);
    }
}
