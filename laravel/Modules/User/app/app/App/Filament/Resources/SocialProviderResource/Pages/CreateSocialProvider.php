<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\SocialProviderResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\User\Filament\Resources\SocialProviderResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class CreateSocialProvider extends XotBaseCreateRecord
{
    protected static string $resource = SocialProviderResource::class;
}
