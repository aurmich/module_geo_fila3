<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\ClientResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Modules\Geo\Actions\GetAddressDataFromFullAddressAction;
use Modules\TechPlanner\Filament\Imports\ClientImporter;
use Modules\TechPlanner\Filament\Resources\ClientResource;
use Modules\TechPlanner\Models\Client;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
use Webmozart\Assert\Assert;

class ListClients extends XotBaseListRecords
{
    protected static string $resource = ClientResource::class;

    public ?int $selectedClientId = null;

    protected $tableQuery;

    public function getListTableColumns(): array
    {
        return [
            'distance' => TextColumn::make('distance')
                ->formatStateUsing(fn ($state) => number_format($state, 2).' km'),

            'activity' => TextColumn::make('activity')
                ->searchable()
                ->sortable()
                ->wrap(),

            'company_name' => TextColumn::make('company_name')
                ->description(fn (Client $record): string => $record->full_address)
                ->searchable()
                ->sortable()
                ->wrap(),

            'fiscal_code' => TextColumn::make('fiscal_code')
                ->toggleable(isToggledHiddenByDefault: true),

            'city' => TextColumn::make('city')
                ->toggleable(isToggledHiddenByDefault: true),

            'province' => TextColumn::make('province')
                ->toggleable(isToggledHiddenByDefault: true),

            'country' => TextColumn::make('country')
                ->toggleable(isToggledHiddenByDefault: true),

            'phone' => TextColumn::make('phone')
                ->searchable()
                ->sortable(),

            'contacts' => TextColumn::make('email')
                ->label('Contatti Email')
                ->description(fn (Client $record): string => $record->pec ? "PEC: {$record->pec}" : '')
                ->searchable(['email', 'pec'])
                ->sortable()
                ->icon('heroicon-o-envelope')
                ->color('primary')
                ->tooltip('Email e PEC del cliente')
                ->wrap(),

            'longitude' => TextColumn::make('longitude')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            'latitude' => TextColumn::make('latitude')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            'business_closed' => TextColumn::make('business_closed')
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }

    protected function getTableFilters(): array
    {
        $activities = static::getModel()::query()
            ->whereNotNull('activity')
            ->distinct()
            ->pluck('activity', 'activity')
            ->map(fn ($value) => (string) $value)
            ->toArray();

        return [
            ...parent::getTableFilters(),
            'business_closed' => TernaryFilter::make('business_closed')
                ->default(false)
                ->label('Attività chiusa'),
            'activity' => SelectFilter::make('activity')
                ->label('Tipo attività')
                ->multiple()
                ->preload()
                ->options($activities),
        ];
    }

    public function getHeaderActions(): array
    {
        return [
            ...parent::getHeaderActions(),
            'import' => Actions\ImportAction::make('importClient')
                ->importer(ClientImporter::class),
            'coordinates' => Actions\Action::make('populateCoordinates')
                ->icon('heroicon-o-globe-alt')
                ->action(function () {
                    $this->populateAllCoordinates();
                })
                ->requiresConfirmation()
                ->modalHeading('Populate Coordinates')
                ->modalDescription('This will update coordinates for all clients based on their addresses. Continue?')
                ->modalSubmitActionLabel('Yes, Update All'),
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            'update_coordinates' => BulkAction::make('updateCoordinates')
                ->icon('heroicon-o-map-pin')
                ->action(function (Collection $records) {
                    $action = app(GetAddressDataFromFullAddressAction::class);
                    $successCount = 0;
                    $errorMessages = collect();

                    foreach ($records as $client) {
                        Assert::isInstanceOf($client, Client::class);
                        $addressData = $action->execute($client->full_address);

                        if ($addressData) {
                            $up = Arr::only($addressData->toArray(), ['latitude', 'longitude']);

                            $client->update($up);
                            $successCount++;
                        } else {
                            $errorMessages->push("Errore per {$client->name}: ".$action->getErrors()->join(', '));
                        }
                    }

                    if ($successCount > 0) {
                        Notification::make()
                            ->success()
                            ->title('Indirizzi aggiornati')
                            ->body("Aggiornati i dati di {$successCount} clienti")
                            ->send();
                    }

                    if ($errorMessages->isNotEmpty()) {
                        Notification::make()
                            ->warning()
                            ->title('Alcuni aggiornamenti non sono riusciti')
                            ->body($errorMessages->join("\n"))
                            ->persistent()
                            ->send();
                    }
                })
                ->deselectRecordsAfterCompletion()
                ->label('Aggiorna indirizzi'),
        ];
    }

    public function getTableActions(): array
    {
        return [
            ...parent::getTableActions(),
            'sort_distance' => Action::make('sortByDistance')
                ->icon('heroicon-o-map')
                ->action(function ($record) {
                    if (! $record->latitude || ! $record->longitude) {
                        Notification::make()
                            ->warning()
                            ->title('Attenzione')
                            ->body('Il cliente selezionato non ha coordinate valide')
                            ->send();

                        return;
                    }

                    Session::put('user_latitude', $record->latitude);
                    Session::put('user_longitude', $record->longitude);

                    Cookie::queue('user_latitude', $record->latitude, 60 * 24 * 30);
                    Cookie::queue('user_longitude', $record->longitude, 60 * 24 * 30);

                    $this->dispatch('coordinates-updated');
                    $this->applySort('distance');

                    Notification::make()
                        ->success()
                        ->title('Coordinate aggiornate')
                        ->body('La tabella è stata ordinata in base alla distanza dal cliente selezionato')
                        ->send();
                })
                ->label('Ordina per distanza'),
        ];
    }

    public function applySort($field): void
    {
        if ($field === 'distance') {
            $this->resetTable();
        }
    }

    #[On('sort-by-distance')]
    public function handleSortByDistance(): void
    {
        $this->applySort('distance');
    }

    protected function getTableQuery(): Builder
    {
        $query = parent::getTableQuery();
        $latitude = Session::get('user_latitude');
        $longitude = Session::get('user_longitude');

        return $query
            ->when($latitude && $longitude,
                function (Builder $query) use ($latitude, $longitude) {
                    $query->withDistance($latitude, $longitude)
                        ->orderByDistance($latitude, $longitude);
                }
            );
    }

    private function populateAllCoordinates(): void
    {
        $batchSize = 50;
        $totalProcessed = 0;
        $totalSuccess = 0;
        $errors = [];

        static::getModel()::whereNull('latitude')
            ->orWhereNull('longitude')
            ->chunk($batchSize, function ($clients) use (&$totalProcessed, &$totalSuccess, &$errors) {
                foreach ($clients as $client) {
                    try {
                        $addressData = app(GetAddressDataFromFullAddressAction::class)
                            ->execute($client->full_address);

                        if ($addressData) {
                            $client->update($addressData->toArray());
                            $totalSuccess++;
                        }
                    } catch (\Throwable $e) {
                        $errors[] = "Error updating {$client->company_name}: {$e->getMessage()}";
                    }
                    $totalProcessed++;
                }
            });

        $message = "Processed {$totalProcessed} clients. Successfully updated {$totalSuccess} coordinates.";

        if (! empty($errors)) {
            Notification::make()
                ->warning()
                ->title('Coordinate Update Completed with Errors')
                ->body($message."\n\n".implode("\n", array_slice($errors, 0, 5)))
                ->persistent()
                ->send();
        } else {
            Notification::make()
                ->success()
                ->title('Coordinates Updated Successfully')
                ->body($message)
                ->send();
        }
    }
}
