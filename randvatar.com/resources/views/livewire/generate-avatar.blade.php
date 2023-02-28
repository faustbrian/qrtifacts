<form method="POST" wire:submit.prevent="submit">
    @csrf

    @if ($avatar)
        <img src="{{ $avatar }}" alt="{{ $identifier }}" class="rounded-lg shadow-lg mb-4" />
    @endif

    <div>
        {{-- <x-jet-label for="email" value="{{ __('Identifier') }}" /> --}}
        <x-jet-input id="identifier" class="block mt-1 w-full" type="text" wire:model="identifier" required autofocus />
    </div>

    <div class="flex items-center justify-center mt-4">
        <x-jet-button>
            {{ __('Generate') }}
        </x-jet-button>
    </div>
</form>
