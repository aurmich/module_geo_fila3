<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 *  .
 */
class CreateOrdersTable extends XotBaseMigration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->id();
                // $table->uuid('orderId')->unique();
                // $table->uuid('productId')->index();
                // $table->integer('quantity');
                // $table->integer('total');
                // $table->timestamps();

                $table->date('date');
                $table->integer('article_id');
                $table->integer('rating_id');
                $table->integer('bet_credits');
                $table->timestamps();
            });

        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                if (! $this->hasColumn('rating_id')) {
                    $table->integer('rating_id')->after('article_id');
                }

                $this->updateTimestamps(table: $table, hasSoftDeletes: true);
            }
        );
    }
}
