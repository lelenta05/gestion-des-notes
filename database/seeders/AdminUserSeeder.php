<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrcreate(//pour creer un nouveau user 
            ['email' => 'test@test.com'],
            [
                'name'=> 'Administrateur',
                'last_name'=>'SuperAdmin',
                'password' => Hash::make('123456789@'),
                'role_id' => 1//role admin
            ]
        );
    }
}
