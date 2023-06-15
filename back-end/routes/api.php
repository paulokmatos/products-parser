<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'apiDetails']);
Route::apiResource('products', ProductController::class)->except('store');