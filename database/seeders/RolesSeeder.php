<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
            'name' => 'admin',
            'description'=> 'L\'administrateur a tous les droits'
            ],
            
            [
            'name' => 'assistant',
            'description'=> 'Même droits que l’administrateur sauf gestion des administrateurs et assistants, et accès aux logs.'
            ],

            [
            'name' => 'etudiant',
            'description'=> 'Accès à deux pages: Profil et notes'
            ],
            
        ]);
    }
}
