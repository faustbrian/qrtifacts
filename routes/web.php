<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $config = [
        'ffmpeg.binaries'  => base_path('bin/ffmpeg'),
        'ffprobe.binaries' => base_path('bin/ffprobe'),
    ];

    $videoName = '3';
    $video     = FFMpeg\FFMpeg::create($config)->open(resource_path("videos/{$videoName}.mp4"));
    $seconds   = (float) FFMpeg\FFProbe::create($config)->format(resource_path("videos/{$videoName}.mp4"))->get('duration');

    foreach (range(0, $seconds) as $second) {
        $video
            ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($second))
            ->save(resource_path("backgrounds/frame-{$second}.png"));
    }
});
