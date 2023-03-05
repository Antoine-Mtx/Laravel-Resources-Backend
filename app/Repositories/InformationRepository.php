<?php

namespace App\Repositories;

use App\Models\Resource;
use Illuminate\Database\Eloquent\Collection;

class InformationRepository
{
    public static function get_visible_informations(): Collection
    {
        $informations = Resource::with('category')
            ->with('user')
            ->with('information')
            ->where('type', 'information')
            ->where('visibility', 1)
            ->where('archived', 0)
            ->get();

        return $informations;
    }
}
