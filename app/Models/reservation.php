<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
     use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',       
        'salle_id',
        'date_reservation',
        'heure_debut',
        'heure_fin',
        'statut',
        

    ];

    /**
     * Les attributs qui doivent être cachés pour les tableaux.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token', // Utilisé pour les sessions persistantes
    ];

    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le modèle Medecin
    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }
}
