<?php

/**
 * @see https://github.com/Althinect/filament-spatie-roles-permissions/blob/2.x/src/resources/PermissionResource/RelationManager/RoleRelationManager.php
 */

declare(strict_types=1);

namespace Modules\User\Filament\Resources\PermissionResource\RelationManager;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Xot\Filament\Resources\XotBaseResource\RelationManager\XotBaseRelationManager;

class RoleRelationManager extends XotBaseRelationManager
{
    protected static string $relationship = 'roles';

    protected static ?string $recordTitleAttribute = 'name';

   

    
}
