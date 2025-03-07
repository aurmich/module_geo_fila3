<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\DeviceResource\Pages;

use Filament\Actions\DeleteAction;
use Modules\User\Filament\Resources\DeviceResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

/**
 * EditDevice
 */
class EditDevice extends XotBaseEditRecord
{
    protected static string $resource = DeviceResource::class;

    
}
