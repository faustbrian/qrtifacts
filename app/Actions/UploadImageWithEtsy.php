<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Facades\Http;

/**
 * @see https://developers.printify.com/#upload-an-image
 */
final class UploadImageWithEtsy
{
    public static function execute(string $listingId, string $path): string
    {
        return Http::asForm()
            ->withHeaders(['x-api-key' => config('services.etsy.key')])
            ->withToken(config('services.etsy.token'))
            ->post('https://api.etsy.com/v3/application/shops/'.config('services.etsy.store')."/listings/$listingId/files", [
                'file' => base64_encode(file_get_contents($path)),
            ])
            ->json();
    }
}
