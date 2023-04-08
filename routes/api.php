<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
    Article Routes
*/
Route::post('text/process', [\App\Http\Controllers\Api\OpenAIController::class, 'process']);
Route::post('text/download', [\App\Http\Controllers\Api\OpenAIController::class, 'downloadArticle']);

/* 
    Image Routes
*/
Route::post('image/process', [\App\Http\Controllers\Api\OpenAIImageController::class, 'process']);