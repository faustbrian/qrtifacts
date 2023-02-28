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
        return Http::withToken(config('services.printify.token'))
            ->post('https://api.etsy.com/v3/application/shops/'.config('services.etsy.store')."/listings/$listingId/files", [
                'file_name' => $path,
                'contents'  => base64_encode(file_get_contents($path)),
            ])
            ->json('id');
    }
}
