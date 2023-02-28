<?php

declare(strict_types=1);

use App\Actions\CreateProductWithPrintify;
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
    return CreateProductWithPrintify::execute([
        'title'             => 'Product',
        'description'       => 'Good product',
        'blueprint_id'      => 384,
        'print_provider_id' => 1,
        'variants'          => [
            [
                'id'         => 45740,
                'price'      => 400,
                'is_enabled' => true,
            ],
            [
                'id'         => 45742,
                'price'      => 400,
                'is_enabled' => true,
            ],
            [
                'id'         => 45744,
                'price'      => 400,
                'is_enabled' => false,
            ],
            [
                'id'         => 45746,
                'price'      => 400,
                'is_enabled' => false,
            ],
        ],
        'print_areas'=> [
            [
                'variant_ids'  => [45740, 45742, 45744, 45746],
                'placeholders' => [
                    [
                        'position' => 'front',
                        'images'   => [
                            [
                                'id'    => '5d15ca551163cde90d7b2203',
                                'x'     => 0.5,
                                'y'     => 0.5,
                                'scale' => 1,
                                'angle' => 0,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]);

    // $config = [
    //     'ffmpeg.binaries'  => base_path('bin/ffmpeg'),
    //     'ffprobe.binaries' => base_path('bin/ffprobe'),
    // ];

    // $videoName = '3';
    // $video     = FFMpeg\FFMpeg::create($config)->open(resource_path("videos/{$videoName}.mp4"));
    // $seconds   = (float) FFMpeg\FFProbe::create($config)->format(resource_path("videos/{$videoName}.mp4"))->get('duration');

    // foreach (range(0, $seconds) as $second) {
    //     $video
    //         ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($second))
    //         ->save(resource_path("backgrounds/frame-{$second}.png"));
    // }
});
