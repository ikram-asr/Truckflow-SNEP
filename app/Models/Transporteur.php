<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transporteur extends Model
{
    protected $fillable = [
        'Cin',
        'Nom',
        'Prénom',
        
    ];

    public function camions(){
        return $this->hasMany(Camion::class);
    }}