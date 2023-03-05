<?php

namespace App\Repositories;

use App\Models\Resource;
use Illuminate\Database\Eloquent\Collection;

class TutorialRepository
{
    public static function get_visible_tutorials(): Collection
    {
        $tutorials = Resource::with('category')
            ->with('user')
            ->with('tutorial')
            ->where('type', 'tutorial')
            ->where('visibility', 1)
            ->where('archived', 0)
            ->get();

        return $tutorials;
    }
}
