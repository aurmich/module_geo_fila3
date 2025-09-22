<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources\AddressResource\Pages;

use Filament\Actions;
use Filament\Infolists\Infolist;
<<<<<<< HEAD
use Modules\Geo\Filament\Resources\AddressResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;
=======
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;
use Modules\Geo\Filament\Resources\AddressResource;

>>>>>>> 19c8248 (.)

class ViewAddress extends XotBaseViewRecord
{
    protected static string $resource = AddressResource::class;

<<<<<<< HEAD
    #[\Override]
=======
    

>>>>>>> 19c8248 (.)
    public function getInfolistSchema(): array
    {
        return [];
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 19c8248 (.)
