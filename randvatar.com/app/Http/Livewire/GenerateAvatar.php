<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Faust\CharacterBuilder\Avatar;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class GenerateAvatar extends Component
{
    public ?string $identifier = '';

    public ?string $avatar = null;

    public function submit(): void
    {
        $this->validate([
            'identifier' => ['required', 'min:1'],
        ]);

        // Arr::random(json_decode(File::get(resource_path('assets/gradients.json')), true))['colors']

        $avatar = new Avatar($this->identifier);
        $avatar->withColors(Arr::random(json_decode(File::get(resource_path('parts/gradients.json')), true))['colors']);
        $avatar->withGradientBackground();
        // $avatar->withDominantColorBackground();
        // $avatar->withGreyscale();
        // $avatar->withFlip();
        // $avatar->withGradientBackground();
        // $avatar->withVerticalGradient();
        // $avatar->withQrCode();

        $this->avatar = (string) $avatar->create()->encode('data-url', 100);
    }
}
