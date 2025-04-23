<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// don't forget to delete routeserviceprovider.php and add the routes to the app in boatstrap/app.php
