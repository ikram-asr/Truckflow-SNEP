<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bl extends Model
{
    use HasFactory;
    protected $table='bl';
    protected $fillable = [
        'NumeroBl',
        'IdPassage',
    ];
    public function camion(){
        return $this->belongsTo(Camion::class, 'IdPassage');
    }
}
