<?php

namespace App\Repositories;

use App\Models\Resource;
use Illuminate\Database\Eloquent\Collection;

class ResourceRepository
{
    public static function get_visible_resources(): Collection
    {
        $resources = Resource::with('category')
            ->with('user')
            ->where('visibility', 1)
            ->where('archived', 0)
            ->get();

        return $resources;
    }

    public static function get_one_tutorial($id): Collection
    {
        $resource = Resource::where('id', $id)
            ->with('category')
            ->with('user')
            ->with('tutorial')
            ->with('comments.user')
            ->get();

        return $resource;
    }

    public static function get_one_information($id): Collection
    {
        $resource = Resource::where('id', $id)
            ->with('category')
            ->with('user')
            ->with('information')
            ->with('comments.user')
            ->get();

        return $resource;
    }
}
