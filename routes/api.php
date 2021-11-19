<?php

// use App\Models\Product;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// WITHOUT CONTROLLLER
// Route::get("/products", function(){
//     // return "products";
//     return Product::all();
// });
// Route::post("/products", function(){
    // return Product::create([
    //     'name' => 'Product One',
    //     'slug' => 'product-ne',
    //     'description' => 'This is Product One',
    //     'price' => '99.99',
    // ]);
// });

// WITH CONTROLLLER
// Route::get("/products", [ProductController::class, 'index']);
// Route::post("/products", [ProductController::class, 'store']);

// WITH CONTROLLLER and WITHOUT User-Defined Routes
// Route::resource('products', ProductController::class);
// Route::get("/products/search/{name}", [ProductController::class, 'search']);

Route::post("/register", [AuthController::class, 'register']);
Route::post("/login", [AuthController::class, 'login']);
Route::get("/products", [ProductController::class, 'index']);
Route::get("/products/{id}", [ProductController::class, 'show']);
Route::get("/products/search/{name}", [ProductController::class, 'search']);
// Above Contain ------> PUBLIC ROUTES

// Below Contain ------> PRIVATE ROUTES
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post("/logout", [AuthController::class, 'logout']);
    Route::post("/products", [ProductController::class, 'store']);
    Route::put("/products/{id}", [ProductController::class, 'update']);
    Route::delete("/products/{id}", [ProductController::class, 'destroy']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
