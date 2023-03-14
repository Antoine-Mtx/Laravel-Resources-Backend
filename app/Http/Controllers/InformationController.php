<?php

namespace App\Http\Controllers;

use App\Http\Resources\InformationResource;
use App\Models\Information;
use App\Repositories\InformationRepository;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    /**
     * @desc Ajoute une information avec l'id_resource associé
     * @param string $id
     * @param array $data
     * @return InformationResource
     */
    public static function store(string $id, array $data): InformationResource
    {
        $params = ['id_resource' => $id];
        foreach ($data as $key => $value){
            $params[$key] = $value;
        }
        $information = Information::create($params);

        return new InformationResource($information);
    }


    /**
     * @desc Liste ressources type info visibles + non archivées , avec auteur (user) & category & info
     * @return JsonResponse
     */
    public static function get_visible_informations(): JsonResponse
    {
        $informations = InformationRepository::get_visible_informations();
        return response()->json($informations);
    }
}
