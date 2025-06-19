<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminUserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /** 
         *  User::factory()->create([
           * 'name' => 'Admin',
            *'email' => 'admin@material.com',
            *'password' => ('secret')
        *   ]);
        */
        $this->call([
            RolesSeeder::class,
            UpdateUsersWithRoleSeeder::class,  // Appel du seeder pour les utilisateurs
            AdminUserSeeder::class,
        ]);

        

    }
}
