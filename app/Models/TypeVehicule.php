<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeVehicule extends Model
{
    use HasFactory;
    protected $table = 'types_vehicule';

    protected $fillable = ['Type'];
    public $timestamps = false;  // Désactive les timestamps automatiques

    public function camions()
{
    return $this->hasMany(Camion::class, 'type_id', 'id');
}

}
