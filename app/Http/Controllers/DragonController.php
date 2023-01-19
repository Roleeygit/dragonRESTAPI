<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Dragon;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Dragon as DragonResources;
use Validator;

class DragonController extends BaseController
{

    public function index()
    {
        $dragons = Dragon::with("color")->get();
        // print_r($dragons);

        return $this->sendResponse(DragonResources::collection($dragons), "Sárkányok kiírva");
    }   

    public function store(Request $request)
    {
        $input = $request->all();   
        $input["color_id"] = Color::where("color",$input["color_id"])->first()->id;
        // print_r($input);

        $validator = Validator::make($input,
        [
            "name" => "required",
            "age" => "required",
            "color_id" => "required"
        ]);

        if ($validator->fails())
        {
            return $this->sendError($validator->errors());
        }

        $dragon = Dragon::create($input);

        return $this->sendResponse(new DragonResources($dragon), "Sárkány létrehozva");
    }

    public function show ($id)
    {
        $dragon = Dragon::find($id);

        if(is_null($dragon))
        {
            return $this->sendError("Sárkány nem létezik!");
        }

        return $this->sendResponse(new DragonResources($dragon), "Sárkány betöltve");
        
    }
}
