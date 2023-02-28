<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Facades\Http;

/**
 * @see https://developers.printify.com/#upload-an-image
 */
final class UploadImageWithPrintify
{
    public static function execute(array $data): array
    {
        return Http::withToken(config('services.printify.token'))
            ->post('https://api.printify.com/v1/uploads/images.json', $data)
            ->json();
    }
}
