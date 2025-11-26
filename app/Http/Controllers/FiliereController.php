<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FiliereController extends Controller
{
    /**
     * Afficher la liste des filières.
     */
    public function index(): View
    {
        $filieres = Filiere::withCount('etudiants')->orderBy('nom')->get();
        
        return view('filieres.index', compact('filieres'));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create(): View
    {
        return view('filieres.create');
    }

    /**
     * Enregistrer une nouvelle filière.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:filieres,nom',
        ], [
            'nom.required' => 'Le nom de la filière est obligatoire.',
            'nom.unique' => 'Cette filière existe déjà.',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.',
        ]);

        // Création
        Filiere::create($validated);

        return redirect()
            ->route('filieres.index')
            ->with('success', 'Filière créée avec succès !');
    }

    /**
     * Supprimer une filière.
     */
    public function destroy(Filiere $filiere): RedirectResponse
    {
        // Vérifier si la filière a des étudiants
        if ($filiere->hasEtudiants()) {
            return redirect()
                ->route('filieres.index')
                ->with('error', 'Impossible de supprimer cette filière car elle contient des étudiants.');
        }

        $filiere->delete();

        return redirect()
            ->route('filieres.index')
            ->with('success', 'Filière supprimée avec succès !');
    }
}