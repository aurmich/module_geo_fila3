<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Widgets;

use Filament\Forms;
use Illuminate\Support\Str;
use Webbingbrasil\FilamentMaps\Actions;
use Webbingbrasil\FilamentMaps\Marker;
use Webbingbrasil\FilamentMaps\Widgets\MapWidget;

class OSMMapWidget extends MapWidget
{
    protected int|string|array $columnSpan = 2;
    // protected static string $view = 'geo::filament.widgets.osm-map';

    protected bool $hasBorder = false;

    public function getMarkers(): array
    {
        return [
            Marker::make('pos2')
                ->lat(-15.7942)
                ->lng(-47.8822)
                ->tooltip('I am a tooltip')
                ->popup('Hello Brasilia!'),
        ];
    }

    public function getActions(): array
    {
        return [
            Actions\ZoomAction::make(),
            Actions\FullpageAction::make(),
            Actions\FullscreenAction::make(),
            Actions\Action::make('form')
            // ->icon('filamentmapsicon-o-arrows-pointing-in')
            // ->icon('heroicon-o-plus')
                ->icon('marker-plus')
                ->form([
                    Forms\Components\TextInput::make('name')
                        ->label('Name')
                        ->required(),
                    Forms\Components\TextInput::make('lat')
                        ->label('Latitude')
                        ->numeric()
                        ->required(),
                    Forms\Components\TextInput::make('lng')
                        ->label('Longitude')
                        ->numeric()
                        ->required(),
                ])
                ->action(function (array $data, self $livewire) {
                    $livewire
                        ->addMarker(
                            Marker::make(Str::camel($data['name']))
                                ->lat(floatval($data['lat']))
                                ->lng(floatval($data['lng']))
                                ->popup($data['name'])
                        )
                        ->centerTo(location: [$data['lat'], $data['lng']], zoom: 13);
                }),
            // Actions\CenterMapAction::make()->zoom(2),
            // Actions\CenterMapAction::make()->centerTo([51.505, -0.09])->zoom(13),
            Actions\CenterMapAction::make()->centerOnUserPosition()->zoom(13),
            Actions\Action::make('mode')
                ->icon('filamentmapsicon-o-square-3-stack-3d')
                ->callback('setTileLayer(mode === "OpenStreetMap" ? "OpenTopoMap" : "OpenStreetMap")'),
        ];
    }
}
