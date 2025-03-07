<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Modules\TechPlanner\Filament\Resources\ClientResource\Pages;
use Modules\TechPlanner\Models\Client;
use Modules\Xot\Filament\Resources\XotBaseResource;

/**
 * Undocumented class
 */
class ClientResource extends XotBaseResource
{
    protected static ?string $model = Client::class;

    public static function getFormSchema(): array
    {
        return [
            Forms\Components\Section::make('Informazioni Aziendali')
                ->schema([
                    TextInput::make('company_name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('activity')
                        ->maxLength(255),
                    TextInput::make('vat_number')
                        ->maxLength(20),
                    TextInput::make('fiscal_code')
                        ->maxLength(16),
                    TextInput::make('tax_code')
                        ->maxLength(20),
                    Forms\Components\Toggle::make('business_closed'),
                ])
                ->columns(2),

            Forms\Components\Section::make('Indirizzo')
                ->schema([
                    TextInput::make('address')
                        ->maxLength(255),
                    TextInput::make('street_number')
                        ->maxLength(10),
                    TextInput::make('city')
                        ->maxLength(100),
                    TextInput::make('postal_code')
                        ->maxLength(10),
                    TextInput::make('province')
                        ->maxLength(2),
                    TextInput::make('country')
                        ->default('Italia')
                        ->maxLength(100),
                ])
                ->columns(2),

            Forms\Components\Section::make('Contatti')
                ->schema([
                    TextInput::make('phone')
                        ->tel()
                        ->maxLength(20),
                    TextInput::make('mobile')
                        ->tel()
                        ->maxLength(20),
                    TextInput::make('fax')
                        ->tel()
                        ->maxLength(20),
                    Forms\Components\Grid::make(2)
                        ->schema([
                            TextInput::make('email')
                                ->email()
                                ->maxLength(255)
                                ->columnSpan(1),
                            TextInput::make('pec')
                                ->email()
                                ->maxLength(255)
                                ->columnSpan(1),
                        ]),
                ])
                ->columns(2),

            Forms\Components\Section::make('Informazioni Aggiuntive')
                ->schema([
                    TextInput::make('competent_health_unit')
                        ->maxLength(255),
                    TextInput::make('company_office')
                        ->maxLength(255),
                    Forms\Components\Textarea::make('notes')
                        ->rows(3)
                        ->maxLength(65535)
                        ->columnSpanFull(),
                ])
                ->columns(2),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
