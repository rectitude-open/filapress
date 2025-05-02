<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Admin;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'super-admin',
            'guard_name' => 'admin',
        ]);

        Role::create([
            'name' => 'webmaster',
            'guard_name' => 'admin',
        ]);

        $superAdmin = Admin::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@test.com',
            'password' => bcrypt('superadmin'),
        ]);
        $superAdmin->assignRole('super-admin');

        $webmaster = Admin::create([
            'name' => 'Webmaster',
            'email' => 'webmaster@test.com',
            'password' => bcrypt('webmaster'),
        ]);
        $webmaster->assignRole('webmaster');
    }
}
