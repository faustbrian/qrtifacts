<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Facades\Http;

/**
 * @see https://developer.etsy.com/documentation/tutorials/listings/
 * @see https://developers.etsy.com/documentation/reference/#operation/createDraftListing
 */
final class CreateProductWithEtsy
{
    public function execute(array $data): void
    {
        Http::withToken(config('services.printify.token'))
            ->post('https://api.printify.com//v1/shops/{shop_id}/products.json');
    }
}
