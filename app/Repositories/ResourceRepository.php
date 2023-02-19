<?php

namespace App\Repositories;

use App\Models\Resource;

class ResourceRepository
{

    public static function getOne($request){
        $resource = Resource::where('id', $request->id)->get();
        return $resource;
    }
}
