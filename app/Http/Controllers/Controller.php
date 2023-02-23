<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function testDB()
    {
        // $r = variable que l'on veut tester
        $r = User::all();

        return view('welcome')->with('test', $r);
    }

}
