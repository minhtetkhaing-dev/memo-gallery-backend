<?php

use App\Http\Controllers\App\AlbumnController;
use App\Http\Controllers\App\AuthController;
use App\Http\Controllers\App\UserController;
use App\Http\Middleware\VerifyWebUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
 
// Route::middleware(['auth:sanctum', VerifyWebUser::class])->group(function () {
//     // Route::apiResource('/users', UserController::class)->except(['index', 'store']);

//     Route::get('/users/{user}', [UserController::class, 'show']);
//     Route::get('/users', [UserController::class, 'index']);

//     // Route::get('/user', function (Request $request) {
//     //     return $request->user();
//     // });

//     // Route::post('/user/upload-photo', function (Request $request) {
//     //     $user = $request->user();
//     //     if ($user->image) {
//     //         Storage::delete($user->image);
//     //     }
//     //     $data = $request->all();
//     //     $document = $data['image'];
//     //     $name = $data['name'] . strval(now()->timestamp) . '.' . $document->getClientOriginalExtension();
//     //     $path = $document->storeAs($name);
//     //     $user->update([
//     //         'image' => $path
//     //     ]);
//     //     return response()->json(['message' => 'Successfully Uploaded']);
//     // });

//     // Route::delete('/user/remove-photo', function (Request $request) {
//     //     $user = $request->user();
//     //     Storage::delete($user->image);
//     //     $user->update([
//     //         'image' => ''
//     //     ]);
//     //     return response()->json(['message' => 'Successfully Removed']);
//     // });
// });

Route::middleware(['auth:sanctum', 'user'])->group(function () {

    // User
    Route::get('/user', [UserController::class, 'index']);
    Route::put('/user', [UserController::class, 'update']);

    // Alubmns
    Route::apiResource('/albumns', AlbumnController::class);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);