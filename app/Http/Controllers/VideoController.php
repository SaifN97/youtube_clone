<?php

namespace Laratube\Http\Controllers;

use Illuminate\Http\Request;
use Laratube\Video;

class VideoController extends Controller
{
    public function show(Video $video)
    {
        if (request()->wantsJson()) {

            return $video;
        }

        return view('video', compact('video'));
    }

    public function updateViews(Video $video)
    {
        $video->increment('views');

        return response()->json([]);
    }
}
