<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use FFMpeg\Format\Video\X264;
use FFMpeg\Media\Frame;
use FFMpeg\FFMpeg;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Filters\TileFactory;

class VideoController extends Controller
{
    public function store(Request $request){
        
        $validator = Validator::make($request->all(), [
            'video' => 'required|file|max:100000', // Example: Maximum file size of 100MB
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $video = $request->file('video');
        $compressedFileName = time() . '_compressed.mp4';
    
        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => 'C:/ffmpeg/bin/ffmpeg.exe',
            'ffprobe.binaries' => 'C:/ffmpeg/bin/ffprobe.exe',
        ]);

        $videoFile = $ffmpeg->open($video->getRealPath());

        $videoFile->save(new X264('libmp3lame'), Storage::disk('videos')->path($compressedFileName));

        return response()->download(Storage::disk('videos')->path($compressedFileName));

    }
}
