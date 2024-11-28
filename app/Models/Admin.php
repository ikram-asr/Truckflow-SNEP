<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;



class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Nom',
        'Prénom',
        'nom_utilisateur',
        'password',
    ];
    protected $guard = 'admin';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    /*protected $casts = [
        'Email_verified_at' => 'datetime',
    ];*/

    public function fromDateTime($value)
{
    // Only for MSSQL
    if(env('DB_CONNECTION') == 'sqlsrv') {
        return Carbon::parse(parent::fromDateTime($value))->format('d-m-Y H:i:s.000');
    }
    return $value;
}
public function camions()
{
    return $this->hasMany(Camion::class, 'admin_id');
}
public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
		    public function getCreatedAtAttribute($value)
    {
        // Seulement pour MSSQL
        if (env('DB_CONNECTION') == 'sqlsrv') {
            return Carbon::parse($value)->format('m-d-Y ');
        }

        // Pour les autres bases de données
        return Carbon::parse($value)->format('d/m/Y');
    }
}
