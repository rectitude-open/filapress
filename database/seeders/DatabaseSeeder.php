<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
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
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'webmaster',
            'guard_name' => 'web',
        ]);

        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@test.com',
            'password' => bcrypt('superadmin'),
        ]);
        $superAdmin->assignRole('super-admin');

        $webmaster = User::create([
            'name' => 'Webmaster',
            'email' => 'webmaster@test.com',
            'password' => bcrypt('webmaster'),
        ]);
        $webmaster->assignRole('webmaster');
    }
}
