<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources\AddressResource\Pages;

<<<<<<< HEAD
use Modules\Geo\Filament\Resources\AddressResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;
=======
use Filament\Actions;
use Filament\Infolists\Infolist;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;
use Modules\Geo\Filament\Resources\AddressResource;

>>>>>>> 63c6dd4 (.)

class ViewAddress extends XotBaseViewRecord
{
    protected static string $resource = AddressResource::class;

<<<<<<< HEAD
=======
    

>>>>>>> 63c6dd4 (.)
    public function getInfolistSchema(): array
    {
        return [];
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 63c6dd4 (.)
