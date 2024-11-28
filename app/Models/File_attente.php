<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;
use App\Models\Agent;
use Carbon\Carbon;


class File_attente extends Model
{

protected $fillable = [
    'IdPassage', 'heure_entree', 'heure_sortie', 'Creator_id', 'Creator_role', 'Periode_sejour'
];

// Relation avec le modèle Camion pour obtenir l'heure d'enregistrement
public function camion()
{
    return $this->belongsTo(Camion::class, 'IdPassage');
}

// Accesseur pour obtenir la période de séjour au format H:i:s
public function getPeriodeSejourAttribute()
{
    if ($this->heure_entree && $this->heure_sortie && $this->camion) {
        $heure_entree = Carbon::parse($this->camion->heure_enregistrement);
        $heure_sortie = Carbon::parse($this->Heure_sortie);
        $interval = $heure_entree->diff($heure_sortie);
        return $interval->format('%H:%I:%S');
    }
    return null; // Retourner null si les heures ne sont pas définies
}

// Mutateur pour définir l'heure de sortie et calculer la période de séjour
public function setHeureSortieAttribute($value)
{
    $this->attributes['heure_sortie'] = $value;

    if ($this->heure_entree && $value && $this->camion) {
        $heure_entree = Carbon::parse($this->camion->heure_enregistrement);
        $heure_sortie = Carbon::parse($value);
        $interval = $heure_entree->diff($heure_sortie);
        $this->attributes['periode_sejour'] = $interval->format('%H:%I:%S');
    }
}
    // Relation conditionnelle basée sur le rôle du créateur
    public function creator()
    {
        if ($this->creator_role === 'admin') {
            return $this->belongsTo(Admin::class, 'creator_id');
        } elseif ($this->creator_role === 'agent') {
            return $this->belongsTo(Agent::class, 'creator_id');
        }
        return null; // Aucun utilisateur trouvé si le rôle est inconnu
    }

    // Accesseurs pour obtenir les informations du créateur
    public function getCreatorNameAttribute()
    {
        $creator = $this->creator;
        return $creator ? $creator->Nom . ' ' . $creator->Prénom : 'Inconnu';
    }
}