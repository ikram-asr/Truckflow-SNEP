<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
//supadmin
class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'Nom' => 'Admin',
            'Prénom' => 'Initial',
            'nom_utilisateur' => 'admin',
            'password' => 'admin123', 
        ]);
    }
}
