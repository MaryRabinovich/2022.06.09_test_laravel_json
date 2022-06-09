<?php

use App\Http\Requests\DeployJsonRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', function (DeployJsonRequest $request) {
    return view('welcome', compact('request'));
});

Route::post('/', function (DeployJsonRequest $request) {
    return view('welcome', compact('request'));
});
