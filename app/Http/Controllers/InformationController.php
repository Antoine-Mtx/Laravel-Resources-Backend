<?php

namespace App\Http\Controllers;

use App\Http\Resources\InformationResource;
use App\Models\Information;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
}
