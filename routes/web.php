<?php

declare(strict_types=1);

use App\Actions\CreateProductWithEtsy;
use App\Actions\CreateProductWithPrintify;
use App\Actions\UploadImageWithEtsy;
use App\Actions\UploadImageWithPrintify;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use PreemStudio\CharacterBuilder\Character;

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
    // Arr::random(json_decode(File::get(resource_path('assets/gradients.json')), true))['colors']

    $avatar = new Character('identifier');
    $avatar->withColors(Arr::random(json_decode(File::get(resource_path('parts/gradients.json')), true))['colors']);
    $avatar->withGradientBackground();
    $avatar->withQrCode();

    return $avatar->create()->response();
    // return (string) $avatar->create()->encode('data-url', 100);

    // return UploadImageWithEtsy::execute(resource_path('parts/armor/armor_1.png'));

    return CreateProductWithEtsy::execute([
        'quantity'    => '5',
        'title'       => 'Vintage Duncan Toys Butterfly Yo-Yo, Red',
        'description' => 'Vintage Duncan Yo-Yo from 1976 with string, steel axle, and plastic body.',
        'price'       => '1000',
        'who_made'    => 'someone_else',
        'when_made'   => '1970s',
        'taxonomy_id' => '1',
        'image_ids'   => '378848,238298,030076',
    ]);

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
                                'id'    => UploadImageWithPrintify::execute(resource_path('parts/armor/armor_1.png')),
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

Route::get('/auth/redirect', function () {
    return Socialite::driver('etsy')->scopes(['listings_w'])->redirect();
});

Route::get('/auth/callback', function () {
    return Socialite::driver('etsy')->user();
});
