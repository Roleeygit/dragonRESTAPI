<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DragonController;
use App\Http\Controllers\ColorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/register", [AuthController::class, "signUp"]);
Route::post("/login", [AuthController::class, "signIn"]);
Route::post("/logout", [AuthController::class, "logOut"]);

Route::post("/store", [DragonController::class, "store"]);
Route::get("/dragonlist", [DragonController::class, "index"]);
Route::get("/showdragon/{id}", [DragonController::class, "show"]);

Route::put("/color/{id}", [ColorController::class, "update"]);
Route::post("/new-color", [ColorController::class, "store"]);
Route::get("/colorlist", [ColorController::class, "index"]);
Route::delete("/color/{id}", [ColorController::class, "destroy"]);



