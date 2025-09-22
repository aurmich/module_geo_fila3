<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Forms;

use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use Illuminate\Support\Collection;
use Modules\Geo\Models\ComuneJson;

/**
 * Form per la selezione della località.
<<<<<<< HEAD
 *
 * Questo form fornisce una selezione a cascata per regione, provincia, città e CAP.
 *
=======
 * 
 * Questo form fornisce una selezione a cascata per regione, provincia, città e CAP.
 * 
>>>>>>> 19c8248 (.)
 * @see \Modules\Geo\docs\json-database.md
 * @see Modules\Geo\Filament\Forms\LocationForm
 */
class LocationForm
{
    /**
     * Costruttore.
     */
    public function __construct()
    {
        // No initialization needed as we're using static methods
    }

    /**
     * Ottiene lo schema del form.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> 19c8248 (.)
     * @return array<int, Select>
     */
    public function getSchema(): array
    {
        return [
            Select::make('region')
                ->label('geo::fields.region.label')
                ->placeholder('geo::fields.region.placeholder')
<<<<<<< HEAD
                ->options(ComuneJson::allRegions()->toArray(...))
                ->searchable()
                ->required()
                ->live()
                ->afterStateUpdated(fn() => ComuneJson::clearCache(false)),
            Select::make('province')
                ->label('geo::fields.province.label')
                ->placeholder('geo::fields.province.placeholder')
                ->options(fn(Get $get): array => filled($get('region'))
                    ? /** @phpstan-ignore argument.type */ ComuneJson::getProvincesByRegion($get('region'))->toArray()
                    : [])
                ->searchable()
                ->required()
                ->live()
                ->afterStateUpdated(fn() => ComuneJson::clearCache(false))
                ->visible(fn(Get $get) => filled($get('region'))),
=======
                ->options(fn (): array => ComuneJson::allRegions()->toArray())
                ->searchable()
                ->required()
                ->live()
                ->afterStateUpdated(fn () => ComuneJson::clearCache(false)),

            Select::make('province')
                ->label('geo::fields.province.label')
                ->placeholder('geo::fields.province.placeholder')
                ->options(fn (Get $get): array => 
                    filled($get('region')) 
                    /** @phpstan-ignore argument.type */
                        ? ComuneJson::getProvincesByRegion($get('region'))->toArray()
                        : []
                )
                ->searchable()
                ->required()
                ->live()
                ->afterStateUpdated(fn () => ComuneJson::clearCache(false))
                ->visible(fn (Get $get) => filled($get('region'))),

>>>>>>> 19c8248 (.)
            Select::make('city')
                ->label('geo::fields.city.label')
                ->placeholder('geo::fields.city.placeholder')
                ->options(function (Get $get): array {
                    if (!filled($get('province'))) {
                        return [];
                    }
<<<<<<< HEAD

                    /** @var Collection<int, array{cap: array<int, string>, nome: string}> $cities */
                    /** @phpstan-ignore argument.type */
                    $cities = ComuneJson::byProvince($get('province'));

=======
                    
                    /** @var Collection<int, array{cap: array<int, string>, nome: string}> $cities */
                    /** @phpstan-ignore argument.type */
                    $cities = ComuneJson::byProvince($get('province'));
                    
>>>>>>> 19c8248 (.)
                    return $cities->pluck('nome', 'nome')->toArray();
                })
                ->searchable()
                ->required()
                ->live()
<<<<<<< HEAD
                ->afterStateUpdated(fn() => ComuneJson::clearCache(false))
                ->visible(fn(Get $get) => filled($get('province'))),
=======
                ->afterStateUpdated(fn () => ComuneJson::clearCache(false))
                ->visible(fn (Get $get) => filled($get('province'))),

>>>>>>> 19c8248 (.)
            Select::make('cap')
                ->label('geo::fields.cap.label')
                ->placeholder('geo::fields.cap.placeholder')
                ->options(function (Get $get): array {
                    if (!filled($get('province')) || !filled($get('city'))) {
                        return [];
                    }
<<<<<<< HEAD

                    /** @var Collection<int, array{cap: array<int, string>, nome: string}> $cities */
                    /** @phpstan-ignore argument.type */
                    $cities = ComuneJson::byProvince($get('province'))->where('nome', $get('city'));

                    if ($cities->isEmpty()) {
                        return [];
                    }

                    $caps = $cities->first()['cap'];
                    return array_combine($caps, $caps);
                })
                ->required()
                ->visible(fn(Get $get) => filled($get('city'))),
        ];
    }
}
=======
                    
                    /** @var Collection<int, array{cap: array<int, string>, nome: string}> $cities */
                    /** @phpstan-ignore argument.type */
                    $cities = ComuneJson::byProvince($get('province'))
                        ->where('nome', $get('city'));
                        
                    if ($cities->isEmpty()) {
                        return [];
                    }
                    
                    $caps = $cities->first()['cap'] ;
                    return array_combine($caps, $caps);
                })
                ->required()
                ->visible(fn (Get $get) => filled($get('city'))),
        ];
    }
} 
>>>>>>> 19c8248 (.)
