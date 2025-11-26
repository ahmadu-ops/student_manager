<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Filiere;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EtudiantController extends Controller
{
    /**
     * Afficher la liste des étudiants avec recherche.
     */
    public function index(Request $request): View
    {
        $query = Etudiant::with('filiere');

        // BONUS : Recherche avancée multi-critères
        if ($request->filled('nom')) {
            $query->where('nom', 'like', '%' . $request->nom . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('filiere_id')) {
            $query->where('filiere_id', $request->filiere_id);
        }

        if ($request->filled('date_debut')) {
            $query->where('date_naissance', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->where('date_naissance', '<=', $request->date_fin);
        }

        $etudiants = $query->orderBy('nom')->paginate(10);
        $filieres = Filiere::orderBy('nom')->get();

        return view('etudiants.index', compact('etudiants', 'filieres'));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create(): View
    {
        $filieres = Filiere::orderBy('nom')->get();
        
        return view('etudiants.create', compact('filieres'));
    }

    /**
     * Enregistrer un nouvel étudiant.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:etudiants,email',
            'date_naissance' => 'required|date|before:today',
            'filiere_id' => 'required|exists:filieres,id',
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'date_naissance.required' => 'La date de naissance est obligatoire.',
            'date_naissance.before' => 'La date de naissance doit être antérieure à aujourd\'hui.',
            'filiere_id.required' => 'La filière est obligatoire.',
            'filiere_id.exists' => 'La filière sélectionnée n\'existe pas.',
        ]);

        // Création
        Etudiant::create($validated);

        return redirect()
            ->route('etudiants.index')
            ->with('success', 'Étudiant créé avec succès !');
    }

    /**
     * Supprimer un étudiant.
     */
    public function destroy(Etudiant $etudiant): RedirectResponse
    {
        $etudiant->delete();

        return redirect()
            ->route('etudiants.index')
            ->with('success', 'Étudiant supprimé avec succès !');
    }
}