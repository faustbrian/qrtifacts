<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Facades\Http;

/**
 * @see https://developers.printify.com/#upload-an-image
 */
final class UploadImageWithPrintify
{
    public static function execute(string $path): string
    {
        return Http::withToken(config('services.printify.token'))
            ->post('https://api.printify.com/v1/uploads/images.json', [
                'file_name' => basename($path),
                'contents'  => base64_encode(file_get_contents($path)),
            ])
            ->json('id');
    }
}
