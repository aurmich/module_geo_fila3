<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Pages;

<<<<<<< HEAD
=======
use Modules\Xot\Filament\Pages\XotBasePage;
>>>>>>> 63c6dd4 (.)
use Modules\Xot\Filament\Pages\XotBaseDashboard;

class Dashboard extends XotBaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'geo::filament.pages.dashboard';

    // public function mount(): void {
    //     $user = auth()->user();
    //     if(!$user->hasRole('super-admin')){
    //         redirect('/admin');
    //     }
    // }
}
