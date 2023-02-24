<?php

namespace App\Http\Controllers;

use App\Http\Resources\TutorialResource;
use App\Models\Tutorial;
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
}
