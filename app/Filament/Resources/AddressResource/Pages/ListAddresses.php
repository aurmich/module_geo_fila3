<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources\AddressResource\Pages;

use Filament\Actions;
<<<<<<< HEAD
use Modules\Geo\Filament\Resources\AddressResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
=======
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
use Modules\Geo\Filament\Resources\AddressResource;

>>>>>>> 19c8248 (.)

class ListAddresses extends XotBaseListRecords
{
    protected static string $resource = AddressResource::class;

    /**
     * @return array<\Filament\Actions\Action>
     */
<<<<<<< HEAD
    #[\Override]
=======
>>>>>>> 19c8248 (.)
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 19c8248 (.)
