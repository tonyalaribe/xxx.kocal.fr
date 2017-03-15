<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showIndex(Request $request)
    {
        if ($request->ajax()) {
            $videos = Video::with('site')
                ->orderBy('id', 'desc');

            if ($request->has('search')) {
                $videos = $videos->where('title', 'like', '%' . $request->get('search') . '%');
            }

            $videos = $videos->paginate($request->get('paginate'));

            return $videos->toJson();
        }

        return view('admin.index');
    }

    public function deleteVideo($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();
    }
}
