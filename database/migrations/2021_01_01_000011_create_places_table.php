<?php

/**
 * Syntax error or access violation: 1118 Row size too large. The maximum row size for the used table type, not counting BLOBs, is 8126. This includes storage overhead, check the manual. You have to change some columns to TEXT or BLOBs (SQL: alter table `places` add `address` text null).
 */

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
// ----- models -----
use Modules\Geo\Models\Place as MyModel;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/*
 * Class CreatePlacesTable.
 */
return new class extends XotBaseMigration {
    /**
     * db up.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(function (Blueprint $blueprint): void {
            $blueprint->increments('id');
            $blueprint->nullableMorphs('model');
            $blueprint->text('address')->nullable();
            $blueprint->text('formatted_address')->nullable();
            $blueprint->decimal('latitude', 15, 10)->nullable();
            $blueprint->decimal('longitude', 15, 10)->nullable();
            /*
<<<<<<< HEAD
             * $address_components = MyModel::$address_components;
             * foreach ($address_components as $address_component) {
             * if (! $this->hasColumn($address_component)) {
             * $blueprint->text($address_component)->nullable();
             * }
             * if (! $this->hasColumn($address_component.'_short')) {
             * $blueprint->text($address_component.'_short')->nullable();
             * }
             * }
             */
=======
            $address_components = MyModel::$address_components;
            foreach ($address_components as $address_component) {
                if (! $this->hasColumn($address_component)) {
                    $blueprint->text($address_component)->nullable();
                }
                if (! $this->hasColumn($address_component.'_short')) {
                    $blueprint->text($address_component.'_short')->nullable();
                }
            }
            */
>>>>>>> 19c8248 (.)
            $blueprint->text('nearest_street')->nullable();
            $blueprint->string('created_by')->nullable();
            $blueprint->string('updated_by')->nullable();
            $blueprint->string('deleted_by')->nullable();
            $blueprint->timestamps();
        });
        // -- UPDATE --
        $this->tableUpdate(function (Blueprint $blueprint): void {
<<<<<<< HEAD
            if (!$this->hasColumn('post_type')) {
                $blueprint->string('post_type', 50)->index()->nullable();
            }
            /*
             * if (! $this->hasColumn('address')) {
             * $table->text('address')->nullable();
             * }
             */
            if (!$this->hasColumn('latitude')) {
=======
            if (! $this->hasColumn('post_type')) {
                $blueprint->string('post_type', 50)->index()->nullable();
            }
            /*
            if (! $this->hasColumn('address')) {
                $table->text('address')->nullable();
            }
            */
            if (! $this->hasColumn('latitude')) {
>>>>>>> 19c8248 (.)
                $blueprint->decimal('latitude', 15, 10)->nullable();
                $blueprint->decimal('longitude', 15, 10)->nullable();
            }

<<<<<<< HEAD
            if (!$this->hasColumn('model_id')) {
=======
            if (! $this->hasColumn('model_id')) {
>>>>>>> 19c8248 (.)
                $blueprint->nullableMorphs('model');
            }
        });
    }
};
