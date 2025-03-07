<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Resources\XotBaseResource\RelationManager;

use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Xot\Filament\Resources\XotBaseResource;
use Modules\Xot\Filament\Traits\HasXotTable;
use Webmozart\Assert\Assert;

/**
 * @property class-string<Model> $resource
 */
abstract class XotBaseRelationManager extends RelationManager
{
    use HasXotTable;

    protected static string $relationship = '';

    /** @var class-string<XotBaseResource>|null */
    protected static ?string $resourceClass = null;

    public static function getModuleName(): string
    {
        return Str::between(static::class, 'Modules\\', '\Filament');
    }

    public static function getNavigationLabel(): string
    {
        return static::transFunc(__FUNCTION__);
    }

    public static function getNavigationGroup(): string
    {
        return static::transFunc(__FUNCTION__);
    }

    protected static function getPluralModelLabel(): string
    {
        return static::transFunc(__FUNCTION__);
    }

    final public function form(Form $form): Form
    {
        return $form
            ->schema($this->getFormSchema());
    }

    /**
     * Get form schema.
     *
     * @return array<string, \Filament\Forms\Components\Component>
     */
    public function getFormSchema(): array
    {
        $resourceClass = $this->getResource();
        return $resourceClass::getFormSchema();
    }

    public function getListTableColumns(): array
    {
        $resourceClass = $this->getResource();
        $index = Arr::get($resourceClass::getPages(), 'index');
        $index_page = $index->getPage();
        $columns = app($index_page)->getListTableColumns();

        return $columns;
    }

    // public function table(Table $table): Table
    // {

    //     /** @var class-string<Model> $resource */
    //     $resource = $this->getResource();
    //     Assert::classExists($resource);

    //     if (method_exists($resource, 'getListTableColumns')) {
    //         /** @var array<string, Tables\Columns\Column> $columns */
    //         $columns = $resource::getListTableColumns();

    //         return $table->columns($columns);
    //     }

    //     return $table->columns($this->getTableColumns());
    // }

    // /**
    //  * Get table columns.
    //  *
    //  * @return array<string, Tables\Columns\Column>
    //  */
    // protected function getTableColumns(): array
    // {
    //     return [];
    // }

    /**
     * Get the resource class.
     *
     * @return class-string<XotBaseResource>
     */
    protected function getResource(): string
    {
        if (static::$resourceClass !== null) {
            return static::$resourceClass;
        }

        try {
            $class = $this::class;
            $resource_name = Str::of(class_basename($this))
                ->beforeLast('RelationManager')
                ->singular()
                ->append('Resource')
                ->toString();
            $ns = Str::of($class)
                ->before('Resources\\')
                ->append('Resources\\')
                ->toString();
            Assert::classExists($resource_class = $ns.'\\'.$resource_name);

            static::$resourceClass = $resource_class;
            return $resource_class;
        } catch (\Throwable $e) {
            throw new \RuntimeException(
                'Impossibile determinare la classe Resource per ' . static::class . 
                '. Definisci la proprietà statica $resourceClass o sovrascrivi il metodo getResource().',
                0,
                $e
            );
        }
    }
}
