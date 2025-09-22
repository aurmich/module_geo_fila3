<<<<<<< HEAD
<?php

declare(strict_types=1);

?>
=======
>>>>>>> 19c8248 (.)
<x-filament-widgets::widget>
    <x-filament::section>
        <form wire:submit="submit">
            {{ $this->form }}

            <div class="mt-4">
                <x-filament::button
                    type="submit"
                    color="primary"
                >
                    {{ __('geo::widgets.location.submit') }}
                </x-filament::button>
            </div>
        </form>
    </x-filament::section>
<<<<<<< HEAD
</x-filament-widgets::widget>
=======
</x-filament-widgets::widget> 
>>>>>>> 19c8248 (.)
