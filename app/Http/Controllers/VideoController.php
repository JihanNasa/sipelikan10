<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Helpers\Helper;
use App\Http\Requests\VideoRequest;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return view('stisla.settings.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('stisla.settings.videos.create');
    }

    public function store(VideoRequest $request)
    {
        $youtubeId = Helper::getYoutubeId($request->youtube_url);

        Video::create([
            'title'       => $request->title,
            'youtube_url' => $request->youtube_url,
            'youtube_id'  => $youtubeId,
        ]);

        return Helper::redirectSuccess(route('videos.index'), 'Video berhasil ditambahkan.');
    }

    public function edit(Video $video)
    {
        return view('stisla.settings.videos.edit', compact('video'));
    }

    public function update(VideoRequest $request, Video $video)
    {
        $youtubeId = Helper::getYoutubeId($request->youtube_url);

        $video->update([
            'title'       => $request->title,
            'youtube_url' => $request->youtube_url,
            'youtube_id'  => $youtubeId,
        ]);

        return Helper::redirectSuccess(route('videos.index'), 'Video berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return Helper::redirectSuccess(route('videos.index'), 'Video berhasil dihapus.');
    }
}
