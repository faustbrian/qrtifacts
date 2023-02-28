<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Facades\Http;

/**
 * @see https://developers.printify.com/#create-a-new-product
 */
final class CreateProductWithPrintify
{
    public static function execute(array $data): void
    {
        Http::withToken(config('services.printify.token'))
            ->post('https://api.printify.com/v1/shops/'.config('services.printify.store').'/products.json', $data);
    }
}
