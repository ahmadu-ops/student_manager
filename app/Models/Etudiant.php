<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Etudiant extends Model
{
    use HasFactory;

    /**
     * Les attributs assignables en masse.
     */
    protected $fillable = [
        'nom',
        'email',
        'date_naissance',
        'filiere_id'
    ];

    /**
     * Les attributs à caster.
     */
    protected $casts = [
        'date_naissance' => 'date',
    ];

    /**
     * Relation : Un étudiant appartient à une filière.
     */
    public function filiere(): BelongsTo
    {
        return $this->belongsTo(Filiere::class);
    }
}