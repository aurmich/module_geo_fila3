<?php

declare(strict_types=1);

namespace Modules\Geo\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GeoDataMigrator extends Seeder
{
    /**
     * Run the migration of geographical data from SaluteOra to Geo module.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> 63c6dd4 (.)
     * This should only be run once during the migration process.
     */
    public function run(): void
    {
        $this->command->info('Starting migration of geographical data from SaluteOra to Geo module...');
<<<<<<< HEAD

        try {
            DB::beginTransaction();

            // 1. Migrate regions
            $this->migrateRegions();

            // 2. Migrate provinces
            $this->migrateProvinces();

            // 3. Migrate cities
            $this->migrateCities();

            // 4. Migrate CAPs
            $this->migrateCaps();

            DB::commit();
            $this->command->info('Successfully migrated all geographical data to Geo module.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to migrate geographical data: '.$e->getMessage());
            $this->command->error('Failed to migrate geographical data: '.$e->getMessage());
        }
    }

=======
        
        try {
            DB::beginTransaction();
            
            // 1. Migrate regions
            $this->migrateRegions();
            
            // 2. Migrate provinces
            $this->migrateProvinces();
            
            // 3. Migrate cities
            $this->migrateCities();
            
            // 4. Migrate CAPs
            $this->migrateCaps();
            
            DB::commit();
            $this->command->info('Successfully migrated all geographical data to Geo module.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to migrate geographical data: ' . $e->getMessage());
            $this->command->error('Failed to migrate geographical data: ' . $e->getMessage());
        }
    }
    
>>>>>>> 63c6dd4 (.)
    /**
     * Migrate regions from SaluteOra to Geo module
     */
    protected function migrateRegions(): void
    {
<<<<<<< HEAD
        if (! DB::getSchemaBuilder()->hasTable('regions')) {
            $this->command->warn('Regions table does not exist in SaluteOra module. Skipping...');

            return;
        }

        $count = DB::table('regions')->count();
        $this->command->info("Found $count regions to migrate...");

        $regions = DB::table('regions')->get();

=======
        if (!DB::getSchemaBuilder()->hasTable('regions')) {
            $this->command->warn('Regions table does not exist in SaluteOra module. Skipping...');
            return;
        }
        
        $count = DB::table('regions')->count();
        $this->command->info("Found $count regions to migrate...");
        
        $regions = DB::table('regions')->get();
        
>>>>>>> 63c6dd4 (.)
        foreach ($regions as $region) {
            DB::table('geo_regions')->updateOrInsert(
                ['id' => $region->id],
                [
                    'name' => $region->name,
                    'code' => $region->code ?? null,
                    'created_at' => $region->created_at ?? now(),
                    'updated_at' => $region->updated_at ?? now(),
                ]
            );
        }
<<<<<<< HEAD

        $this->command->info("Migrated $count regions.");
    }

=======
        
        $this->command->info("Migrated $count regions.");
    }
    
>>>>>>> 63c6dd4 (.)
    /**
     * Migrate provinces from SaluteOra to Geo module
     */
    protected function migrateProvinces(): void
    {
<<<<<<< HEAD
        if (! DB::getSchemaBuilder()->hasTable('provinces')) {
            $this->command->warn('Provinces table does not exist in SaluteOra module. Skipping...');

            return;
        }

        $count = DB::table('provinces')->count();
        $this->command->info("Found $count provinces to migrate...");

        $provinces = DB::table('provinces')->get();

=======
        if (!DB::getSchemaBuilder()->hasTable('provinces')) {
            $this->command->warn('Provinces table does not exist in SaluteOra module. Skipping...');
            return;
        }
        
        $count = DB::table('provinces')->count();
        $this->command->info("Found $count provinces to migrate...");
        
        $provinces = DB::table('provinces')->get();
        
>>>>>>> 63c6dd4 (.)
        foreach ($provinces as $province) {
            DB::table('geo_provinces')->updateOrInsert(
                ['id' => $province->id],
                [
                    'region_id' => $province->region_id,
                    'name' => $province->name,
                    'code' => $province->code ?? null,
                    'created_at' => $province->created_at ?? now(),
                    'updated_at' => $province->updated_at ?? now(),
                ]
            );
        }
<<<<<<< HEAD

        $this->command->info("Migrated $count provinces.");
    }

=======
        
        $this->command->info("Migrated $count provinces.");
    }
    
>>>>>>> 63c6dd4 (.)
    /**
     * Migrate cities from SaluteOra to Geo module
     */
    protected function migrateCities(): void
    {
<<<<<<< HEAD
        if (! DB::getSchemaBuilder()->hasTable('cities')) {
            $this->command->warn('Cities table does not exist in SaluteOra module. Skipping...');

            return;
        }

        $count = DB::table('cities')->count();
        $this->command->info("Found $count cities to migrate...");

        $cities = DB::table('cities')->get();

=======
        if (!DB::getSchemaBuilder()->hasTable('cities')) {
            $this->command->warn('Cities table does not exist in SaluteOra module. Skipping...');
            return;
        }
        
        $count = DB::table('cities')->count();
        $this->command->info("Found $count cities to migrate...");
        
        $cities = DB::table('cities')->get();
        
>>>>>>> 63c6dd4 (.)
        foreach ($cities as $city) {
            DB::table('geo_cities')->updateOrInsert(
                ['id' => $city->id],
                [
                    'province_id' => $city->province_id,
                    'name' => $city->name,
                    'code' => $city->code ?? null,
                    'created_at' => $city->created_at ?? now(),
                    'updated_at' => $city->updated_at ?? now(),
                ]
            );
        }
<<<<<<< HEAD

        $this->command->info("Migrated $count cities.");
    }

=======
        
        $this->command->info("Migrated $count cities.");
    }
    
>>>>>>> 63c6dd4 (.)
    /**
     * Migrate CAPs from SaluteOra to Geo module
     */
    protected function migrateCaps(): void
    {
<<<<<<< HEAD
        if (! DB::getSchemaBuilder()->hasTable('caps')) {
            $this->command->warn('CAPs table does not exist in SaluteOra module. Skipping...');

            return;
        }

        $count = DB::table('caps')->count();
        $this->command->info("Found $count CAPs to migrate...");

        $caps = DB::table('caps')->get();

=======
        if (!DB::getSchemaBuilder()->hasTable('caps')) {
            $this->command->warn('CAPs table does not exist in SaluteOra module. Skipping...');
            return;
        }
        
        $count = DB::table('caps')->count();
        $this->command->info("Found $count CAPs to migrate...");
        
        $caps = DB::table('caps')->get();
        
>>>>>>> 63c6dd4 (.)
        foreach ($caps as $cap) {
            DB::table('geo_caps')->updateOrInsert(
                ['id' => $cap->id],
                [
                    'city_id' => $cap->city_id,
                    'code' => $cap->code,
                    'created_at' => $cap->created_at ?? now(),
                    'updated_at' => $cap->updated_at ?? now(),
                ]
            );
        }
<<<<<<< HEAD

=======
        
>>>>>>> 63c6dd4 (.)
        $this->command->info("Migrated $count CAPs.");
    }
}
