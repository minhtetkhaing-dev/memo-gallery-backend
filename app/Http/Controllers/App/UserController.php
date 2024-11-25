<?php

namespace App\Http\Controllers\App;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function register(Request $request) {
        $data = $request->all();
        User::insert([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return ResponseHelper::success(
            'Successfully Registered.',
            null,
            Response::HTTP_CREATED
        );
    }

    public function update(Request $request, User $user) {
        $data = $request->all();
        $path = null;
        if(isset($data['image'])) {
            if ($user->image) {
                Storage::delete($user->image);
            }
            $image = $data['image'];
            $name = "U{$user->id}_" . strval(now()->timestamp) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs($name);
        }
        $data = Arr::except($data, ['image']);
        $data['image_path'] = $path;
        $user->update($data);
        return ResponseHelper::success(
            'Successfully Updated.',
            null
        );
    }

    public function show(Request $request, User $user) {
        if (!$user->exists) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return ResponseHelper::success(
            'Success',
            $user
        );
    }
}