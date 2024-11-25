<?php

namespace App\Http\Controllers\App;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Albumn;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class AlbumnController extends Controller
{
    public function index(Request $request) {
        $user = $request->user();
        $data = Albumn::with([
                'childAlbumns.photos',
                'photos'
            ])->where('user_id', $user->id)
            ->whereNull('parent_id')->get();
        return ResponseHelper::success(
            'Successfully fetched albumns.',
            $data
        );
    }

    public function show(Request $request, Albumn $albumn) {
        $albumn->load([
                'childAlbumns.photos',
                'photos'
        ]);
        return ResponseHelper::success(
            'Successfully fetched albumns.',
            $albumn
        );
    }
}