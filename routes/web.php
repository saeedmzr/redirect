<?php

use Illuminate\Support\Facades\Route;


Route::get('/{generated_link}', [\App\Http\Controllers\LinkController::class, 'redirect']);
