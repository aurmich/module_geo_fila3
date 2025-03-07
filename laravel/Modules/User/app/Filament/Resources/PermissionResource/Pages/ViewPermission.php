<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\PermissionResource\Pages;

use Filament\Actions\EditAction;
use Modules\User\Filament\Resources\PermissionResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;

/**
 * ViewPermission
 */
class ViewPermission extends XotBaseViewRecord
{
    protected static string $resource = PermissionResource::class;

}
