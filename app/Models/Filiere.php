<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Filiere extends Model
{
    use HasFactory;

    /**
     * Les attributs assignables en masse.
     */
    protected $fillable = ['nom'];

    /**
     * Relation : Une filière a plusieurs étudiants.
     */
    public function etudiants(): HasMany
    {
        return $this->hasMany(Etudiant::class);
    }

    /**
     * Vérifie si la filière a des étudiants.
     */
    public function hasEtudiants(): bool
    {
        return $this->etudiants()->count() > 0;
    }
}