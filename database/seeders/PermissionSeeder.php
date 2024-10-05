<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Models\Performance;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        foreach (PermissionEnum::cases() as $permission)
            Permission::FirstOrCreate(['name' => $permission->value]);

    }
}
