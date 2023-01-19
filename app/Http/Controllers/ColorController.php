<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use Validator;
use App\Http\Resources\Color as ColorResources;


class ColorController extends BaseController
{
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input,
        [
            "color" => "required"
        ]);

        if ($validator->fails())
        {
            // return $this->sendError($validator->errors());
        }

        $color = Color::find($id);
        $color->update($request->all());

        return $this->sendResponse(new ColorResources($color), "Szín frissítve!");
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input,
        [
            "color" => "required"
        ]);

        if ($validator->fails())
        {
            // return $this->sendError($validator->errors());
        }

        $color = Color::create($input);

        return $this->sendResponse(new ColorResources($color), "Szín létrehozva!");
    }

    public function index()
    {
        $colors = Color::all();

        return $this->sendResponse(ColorResources::collection($colors), "Színek kiírva");
    }

    public function destroy($id)
    {
        Color::destroy($id);
        
        return $this->sendResponse([], "Szín törölve");
    }
}

