<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Modules\Xot\Actions\View\GetViewsSiblingsAndSelfAction;

// use Modules\Blog\Models\Article;

class MapBlock
{
<<<<<<< HEAD
    public static function make(string $name = 'map', string $context = 'form'): Block
    {
=======
    public static function make(
        string $name = 'map',
        string $context = 'form',
    ): Block {
>>>>>>> 19c8248 (.)
        $view = 'geo::components.blocks.map.location-map-table';
        $views = app(GetViewsSiblingsAndSelfAction::class)->execute($view);

        return Block::make($name)
            ->schema([
                /*
<<<<<<< HEAD
                 * Select::make('article_id')
                 * ->label('Article')
                 * ->options(Article::published()->orderBy('title')->pluck('title', 'id'))
                 * ->required(),
                 */
                TextInput::make('text')->label('Link text (optional)'),
=======
                Select::make('article_id')
                    ->label('Article')
                    ->options(Article::published()->orderBy('title')->pluck('title', 'id'))
                    ->required(),
                */
                TextInput::make('text')
                    ->label('Link text (optional)'),
>>>>>>> 19c8248 (.)
                Select::make('_tpl')
                    ->label('layout')
                    ->options($views)
                    ->default('v1')
                    ->required(),
            ])
            ->label('Map')
            ->columns('form' === $context ? 2 : 1);
    }
}
