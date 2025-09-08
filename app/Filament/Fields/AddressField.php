<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Fields;

// use Filament\Forms\Components\Select;
// use Filament\Forms\Components\Field;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;

class AddressField extends Section
{
    // protected string $optionValueProperty = 'id';

    protected function setUp(): void
    {
        parent::setUp();
        $this
            // ->description('The items you have selected for purchase')
            ->icon('heroicon-o-map-pin')
            // ->label((string) __('geo::place.fields.address'))
            ->relationship('place')
            ->schema(
                [
                    TextInput::make('route')->label((string) __('geo::place.fields.route')), // via
                    TextInput::make('street_number')->label((string) __('geo::place.fields.street_number')), // civico
                    TextInput::make('postal_code')->label((string) __('geo::place.fields.postal_code')), // 20124
                    TextInput::make('locality')->label((string) __('geo::place.fields.locality')), // citta
                    TextInput::make('administrative_area_level_2')->label((string) __('geo::place.fields.administrative_area_level_2')), // provincia
                    // TextInput::make('administrative_area_level_1')->label((string) __('geo::place.fields.administrative_area_level_1')), //regione
                    TextInput::make('country')->label((string) __('geo::place.fields.country')), // italia
                ]
            )->columns(2);
    }
}
