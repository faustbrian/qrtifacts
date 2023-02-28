<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Facades\Http;

/**
 * @see https://developer.etsy.com/documentation/tutorials/listings/
 * @see https://developer.etsy.com/documentation/tutorials/listings/#listing-a-digital-product-for-sale
 * @see https://developers.etsy.com/documentation/reference/#operation/createDraftListing
 */
final class CreateProductWithEtsy
{
    public static function execute(array $data): array
    {
        return Http::asForm()
            ->withHeaders(['x-api-key' => config('services.etsy.key')])
            ->withToken(config('services.etsy.token'))
            ->post('https://api.etsy.com/v3/application/shops/'.config('services.etsy.store').'/listings', $data)
            ->json();
    }
}
