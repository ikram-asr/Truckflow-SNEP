<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;


class Agent extends Authenticatable
{
    
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'Agent_id';
    protected $table = 'agents';
    protected $guard = 'agent';
    protected $fillable = [
        'Nom',
        'Prenom',
        'nomutilisateur',
        'password',
        'admin_id',
    ];

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
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the admin that owns the agent.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
        
    }
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
        return $this->hasMany(Camion::class, 'agent_id');
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
