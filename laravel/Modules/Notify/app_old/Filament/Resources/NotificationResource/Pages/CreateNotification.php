<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Resources\NotificationResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Notify\Filament\Resources\NotificationResource;

class CreateNotification extends CreateRecord
{
    protected static string $resource = NotificationResource::class;
}
