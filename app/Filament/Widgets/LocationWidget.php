<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Widgets;

<<<<<<< HEAD
use Modules\Geo\Filament\Forms\LocationForm;
use Modules\Xot\Filament\Widgets\XotBaseWidget;

/**
 * Widget per la selezione della località.
 *
 * Questo widget fornisce un form per la selezione della località utilizzando
 * il form LocationForm.
 *
=======
use Modules\Xot\Filament\Widgets\XotBaseWidget;
use Modules\Geo\Filament\Forms\LocationForm;

/**
 * Widget per la selezione della località.
 * 
 * Questo widget fornisce un form per la selezione della località utilizzando
 * il form LocationForm.
 * 
>>>>>>> 19c8248 (.)
 * @see \Modules\Geo\docs\json-database.md
 */
class LocationWidget extends XotBaseWidget
{
    /**
     * Ordine di visualizzazione del widget.
     */
<<<<<<< HEAD
    protected static null|int $sort = 1;
=======
    protected static ?int $sort = 1;
>>>>>>> 19c8248 (.)

    /**
     * Numero di colonne occupate dal widget.
     */
    protected int|string|array $columnSpan = 'full';

    /**
     * Dati del widget.
     */
<<<<<<< HEAD
    public null|array $data = [];
=======
    public ?array $data = [];
>>>>>>> 19c8248 (.)

    /**
     * Titolo del widget.
     */
    public string $title = 'geo::widgets.location.title';

    /**
     * Vista del widget.
     */
    protected static string $view = 'geo::filament.widgets.location';

    /**
     * Icona del widget.
     */
    public string $icon = 'heroicon-o-map-pin';

    /**
     * Form per la selezione della località.
     */
    private \Modules\Geo\Filament\Forms\LocationForm $locationForm;

    /**
     * Costruttore.
     */
    public function __construct()
    {
        $this->locationForm = new \Modules\Geo\Filament\Forms\LocationForm();
    }

    /**
     * Inizializza il widget.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> 19c8248 (.)
     * @return void
     */
    public function mount(): void
    {
        $this->form->fill();
    }

    /**
     * Ottiene lo schema del form.
<<<<<<< HEAD
     *
     * @return array<int, \Filament\Forms\Components\Component>
     */
    #[\Override]
=======
     * 
     * @return array<int, \Filament\Forms\Components\Component>
     */
>>>>>>> 19c8248 (.)
    public function getFormSchema(): array
    {
        return $this->locationForm->getSchema();
    }

    /**
     * Gestisce l'invio del form.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> 19c8248 (.)
     * @return void
     */
    public function submit(): void
    {
        $data = $this->form->getState();

        $this->dispatch('location-selected', $data);

        // Utilizzo metodo Livewire per notifiche
        $this->dispatch('notify', [
            'type' => 'success',
<<<<<<< HEAD
            'message' => __('geo::widgets.location.messages.success'),
=======
            'message' => __('geo::widgets.location.messages.success')
>>>>>>> 19c8248 (.)
        ]);
    }

    /**
     * Verifica se il widget può essere visualizzato.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> 19c8248 (.)
     * @return bool
     */
    public static function canView(): bool
    {
        return true;
    }
<<<<<<< HEAD
}
=======
} 
>>>>>>> 19c8248 (.)
