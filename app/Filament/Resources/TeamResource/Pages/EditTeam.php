<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\TeamResource\Pages;

use Modules\User\Filament\Resources\TeamResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

class EditTeam extends XotBaseEditRecord
{
    // //
    protected static string $resource = TeamResource::class;
}
