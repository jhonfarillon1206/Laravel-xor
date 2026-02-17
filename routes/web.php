<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\XorController;

Route::get('/', function () {
    return view('welcome');
});


Route::get("/xor", [XorController::class, "index"]);

Route::post("/xor/encrypt", [XorController::class, "encrypt"]);
Route::post("/xor/decrypt", [XorController::class, "decrypt"]);
