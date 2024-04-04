<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// STATIC
Route::fallback(function(){
    return view("pages.404");
})->name("fallback");

Route::get("/404", function(){
    return view("pages.404");
})->name("404");

Route::get('/', function () {
    return view('pages.index');
})->name("home");

Route::get('/about', function () {
    return view("pages.about");
})->name("about");

Route::get('/contact', function () {
    return view("pages.contact");
})->name("contact");
// END STATIC

// AUTH
Route::get('/register', [AuthController::class, "register"])->name("register");

Route::post('/register-user', [AuthController::class, "store"])->name("register-user");

Route::get('/login', [AuthController::class, "login"])->name("login");

Route::post('/login-user', [AuthController::class, "loginUser"])->name("login-user");
// END AUTH

// PROPERTIES
Route::get('/get-properties/{keywords?}/{category?}/{type?}', [PropertyController::class, 'getProperties']);

Route::get('/properties', [PropertyController::class, "index"])->name("properties.index");

Route::get('/properties/{id}', [PropertyController::class, "show"])->name("properties.show");
// END PROPERTIES


Route::middleware(["auth"])->group(function() {
    Route::get('/logout', [AuthController::class, "logout"])->name("logout");

    Route::post('/contact', [AuthController::class, "sendEmail"])->name("contact.send");
//     ne-admin rute

    Route::middleware(["admin"])->prefix('admin')->group(function () {
        // ADMIN
        Route::get('/', [AdminController::class, "index"])->name("admin.index");
        // END ADMIN

        // ADMIN PROPERTIES
        Route::get('/properties', [AdminController::class, "getAllProperties"])->name("admin.properties.index");
        Route::get('/properties/edit/{id}', [AdminController::class, "editProperty"])->name("admin.properties.edit");
        Route::post('/properties/update/{id}', [AdminController::class, "updateProperty"])->name("admin.properties.update");
        Route::get('/properties/create', [AdminController::class, "createProperty"])->name("admin.properties.create");
        Route::post('/properties/store', [AdminController::class, "storeProperty"])->name("admin.properties.store");
        Route::post('/properties/delete/{id}', [AdminController::class, "destroyProperty"])->name("admin.properties.delete");
        // END ADMIN PROPERTIES

        // ADMIN USERS
        Route::get('/users', [AdminController::class, "getAllUsers"])->name("admin.users.index");
        Route::get('/users/edit/{id}', [AdminController::class, "editUser"])->name("admin.users.edit");
        Route::post('/users/update/{id}', [AdminController::class, "updateUser"])->name("admin.users.update");
        Route::get('/users/create', [AdminController::class, "createUser"])->name("admin.users.create");
        Route::post('/users/store', [AdminController::class, "storeUser"])->name("admin.users.store");
        Route::post('/users/delete/{id}', [AdminController::class, "destroyUser"])->name("admin.users.delete");
        // END ADMIN USERS
    });
});


