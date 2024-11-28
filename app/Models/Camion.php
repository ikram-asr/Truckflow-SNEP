<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Camion extends Model
{
    use HasFactory;
    protected $primaryKey = 'IdPassage';
    /*public $incrementing = false; // Pour les clés primaires non auto-incrémentées
    protected $keyType = 'string'; */ // Pour les clés primaires non numériques

    // Les champs que tu souhaites pouvoir remplir en masse
	 protected $dates = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at'=> 'datetime:Y-m-d H:i:s',
    ];
    protected $fillable = [
        //'IdPassage',
        'Immatriculation',
        'Type',
        'Operation',
        'heure_enregistrement',
        'Numero_Bl',
        'heure_sortie',
        'Sejour',
        'Cin_transporteur',
        'Nom_transporteur',
        'Prenom_transporteur',
        'admin_id',
        'agent_id',
        'heure_affectation_bl',

       // 'transporteur_id',
    ];
    // Définition de la relation avec Transporteur
    public function transporteur()
    {
        return $this->belongsTo(Transporteur::class, 'transporteur_id');
    }
    public function type()
{
    return $this->belongsTo(TypeVehicule::class, 'type_id', 'id');
}
    public function fromDateTime($value)
{
    // Only for MSSQL
    if(env('DB_CONNECTION') == 'sqlsrv') {
        return Carbon::parse(parent::fromDateTime($value))->format('d-m-Y H:i:s.000');
    }
    return $value;
}
public function admin()
{
    return $this->belongsTo(Admin::class, 'admin_id');
}

public function agent()
{
    return $this->belongsTo(Agent::class, 'agent_id');
}
/*public function getSejourAttribute()
    {
        if (!empty($this->heure_enregistrement) && !empty($this->heure_sortie)) {
            $enregistrement = Carbon::parse($this->heure_enregistrement);
            $sortie = Carbon::parse($this->heure_sortie);
            $diff = $enregistrement->diff($sortie);

            return $diff->format('%H:%I:%S'); // Formate la différence en heures, minutes et secondes
        }

        return '----';
    }

    // Event listener to update Sejour before saving
    protected static function booted()
    {
        static::saving(function ($camion) {
            if (!empty($camion->heure_enregistrement) && !empty($camion->heure_sortie)) {
                $enregistrement = Carbon::parse($camion->heure_enregistrement);
                $sortie = Carbon::parse($camion->heure_sortie);
                $diff = $enregistrement->diff($sortie);

                $camion->Sejour = $diff->format('%H:%I:%S'); // Met à jour le champ Sejour avant de sauvegarder
            } else {
                $camion->Sejour = '----';
            }
        });
    }*/
    public function getSejourAttribute()
    {
        if (!empty($this->heure_enregistrement) && !empty($this->heure_sortie)) {
            // Format de la date et heure "d/m/Y H:i:s"
            $format = 'd/m/Y H:i:s';
    
            try {
                // Conversion des dates et heures au format spécifié
                $enregistrement = Carbon::createFromFormat($format, $this->heure_enregistrement);
                $sortie = Carbon::createFromFormat($format, $this->heure_sortie);
    
                // Calcul de la différence entre heure_enregistrement et heure_sortie
                $diff = $enregistrement->diff($sortie);
    
                // Formater la différence en jours, heures, minutes et secondes
                $days = $diff->d > 0 ? $diff->format('%d jour(s) ') : '';
                return $days . $diff->format('%H:%I:%S'); // Retourne le temps écoulé
    
            } catch (\Exception $e) {
                return 'Erreur dans le format de la date/heure';
            }
        }
    
        return '----'; // Retourne "----" si l'une des heures est manquante
    }
    protected static function booted()
    {
        static::saving(function ($camion) {
            if (!empty($camion->heure_enregistrement) && !empty($camion->heure_sortie)) {
                // Format de la date et heure "d/m/Y H:i:s"
                $format = 'd/m/Y H:i:s';
    
                try {
                    // Conversion des dates et heures au format spécifié
                    $enregistrement = Carbon::createFromFormat($format, $camion->heure_enregistrement);
                    $sortie = Carbon::createFromFormat($format, $camion->heure_sortie);
    
                    // Calcul de la différence entre heure_enregistrement et heure_sortie
                    $diff = $enregistrement->diff($sortie);
    
                    // Formater la différence en jours, heures, minutes et secondes
                    $days = $diff->d > 0 ? $diff->format('%d jour(s) ') : '';
                    $camion->Sejour = $days . $diff->format('%H:%I:%S');
    
                } catch (\Exception $e) {
                    $camion->Sejour = 'Erreur dans le format de la date/heure';
                }
            } else {
                $camion->Sejour = '----'; // Si l'une des dates est manquante
            }
        });
    }
    

	    public function getCreatedAtAttribute($value)
    {
        // Seulement pour MSSQL
        if (env('DB_CONNECTION') == 'sqlsrv') {
            return Carbon::parse($value)->format('d-m-Y ');
        }

        // Pour les autres bases de données
        return Carbon::parse($value)->format('d/m/Y');
    }

}

