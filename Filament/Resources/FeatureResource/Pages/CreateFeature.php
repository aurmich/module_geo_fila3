<?php

namespace Modules\User\Filament\Resources\FeatureResource\Pages;

use Modules\User\Filament\Resources\FeatureResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFeature extends CreateRecord
{
    protected static string $resource = FeatureResource::class;
}
