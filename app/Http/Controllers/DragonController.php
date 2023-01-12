<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use Illuminate\Support\Facades\DB;

class DragonController extends Controller
{
    public function store(Request $request)
    {
        $colorRequest = $request->color;
        $color = DB::table("colors")->where("color", $colorRequest)->get();
        print_r ($color);
    }
}
