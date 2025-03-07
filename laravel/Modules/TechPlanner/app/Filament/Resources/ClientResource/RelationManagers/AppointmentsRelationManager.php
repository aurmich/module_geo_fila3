<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Modules\TechPlanner\Filament\Resources\AppointmentResource;
use Modules\Xot\Filament\Resources\XotBaseResource\RelationManager\XotBaseRelationManager;

/**
 * Undocumented class
 */
class AppointmentsRelationManager extends XotBaseRelationManager
{
    protected static string $relationship = 'appointments';

    protected static string $resource = AppointmentResource::class;

    public function getListTableColumns(): array
    {
        return [
            'date' => Tables\Columns\TextColumn::make('date')
                ->sortable()
                ->dateTime('d/m/Y H:i')
                ->icon('heroicon-o-calendar'),

            'notes' => Tables\Columns\TextColumn::make('notes')
                ->limit(50)
                ->tooltip(fn ($record): string => $record->notes ?? '')
                ->wrap()
                ->icon('heroicon-o-document-text')
                ->searchable(),

            'machines_count' => Tables\Columns\TextColumn::make('machines_count')
                ->counts('machines')
                ->icon('heroicon-o-wrench')
                ->color('primary'),

            'status' => Tables\Columns\TextColumn::make('status')
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'scheduled' => 'Scheduled',
                    'in_progress' => 'In Progress',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                    default => $state,
                })
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'scheduled' => 'warning',
                    'in_progress' => 'primary',
                    'completed' => 'success',
                    'cancelled' => 'danger',
                    default => 'secondary',
                }),
        ];
    }

    public function getTableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make()
                ->icon('heroicon-o-eye'),

            Tables\Actions\EditAction::make()
                ->icon('heroicon-o-pencil'),
            /*
            Tables\Actions\Action::make('viewMachines')
                ->icon('heroicon-o-wrench')
                ->url(fn ($record) => route('filament.resources.appointments.show', $record))
                ->openUrlInNewTab(),
                */
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'scheduled' => 'Scheduled',
                    'in_progress' => 'In Progress',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ]),

            Tables\Filters\Filter::make('date')
                ->form([
                    Forms\Components\DatePicker::make('from'),
                    Forms\Components\DatePicker::make('until'),
                ])
                ->query(function ($query, array $data): mixed {
                    return $query
                        ->when(
                            $data['from'],
                            fn ($query, $date): mixed => $query->whereDate('date', '>=', $date),
                        )
                        ->when(
                            $data['until'],
                            fn ($query, $date): mixed => $query->whereDate('date', '<=', $date),
                        );
                }),
        ];
    }
}
