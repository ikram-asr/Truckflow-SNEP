<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeVehicule;

class TypeVehiculeSeeder extends Seeder
{
    public function run()
{
    //DB::table('types_vehicule')->truncate(); // Efface les données existantes

    $types = [
        ['Type' => 'Plateau'],
        ['Type' => 'Grande Citerne'],
        ['Type' => 'Petite Citerne'],
    ];
    
    foreach ($types as $type) {
        TypeVehicule::create($type);
    }
    
    
}

}
