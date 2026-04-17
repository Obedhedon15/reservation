<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Gerant extends Model  implements AuthenticatableContract // Notez le 'G' majuscule
{
    use HasFactory, Authenticatable;

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array
     */
    protected $fillable = [
        'nom',       
        'email',
        'password',      
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
}
