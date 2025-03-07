<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Modules\Xot\Actions\View\GetViewByClassAction;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

/**
 * @property bool $shouldRender
 */
abstract class XotBaseWidget extends Widget implements HasForms
{
    use InteractsWithPageFilters;
    use InteractsWithForms;


    public string $title = '';

    public string $icon = '';

    /** @var view-string */
    protected static string $view = 'ui::empty';

    public function __construct()
    {
        /** @var view-string */
        $view = app(GetViewByClassAction::class)->execute(static::class);
        static::$view = $view;
    }

    public static function canView(): bool
    {
        return true;
    }

    /**
     * Get the view / contents that represent the widget.
     */
    public function render(): View
    {
        return view(static::$view, [
            'widget' => $this,
        ]);
    }
}
