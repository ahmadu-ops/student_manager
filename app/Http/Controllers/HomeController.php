<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Filiere;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Afficher la page d'accueil avec les statistiques.
     */
    public function index(): View
    {
        // Statistiques générales
        $stats = [
            'total_etudiants' => Etudiant::count(),
            'total_filieres' => Filiere::count(),
            'etudiants_ce_mois' => Etudiant::whereMonth('created_at', now()->month)
                                          ->whereYear('created_at', now()->year)
                                          ->count(),
            'age_moyen' => $this->calculateAverageAge(),
        ];

        // Répartition par filière
        $repartitionFilieres = Filiere::withCount('etudiants')
            ->orderByDesc('etudiants_count')
            ->get();

        // Derniers étudiants inscrits
        $derniersEtudiants = Etudiant::with('filiere')
            ->latest()
            ->take(5)
            ->get();

        // Statistiques par mois (6 derniers mois)
        $statsParMois = $this->getMonthlyStats();

        // Répartition par tranche d'âge
        $repartitionAge = $this->getAgeDistribution();

        return view('home', compact(
            'stats',
            'repartitionFilieres',
            'derniersEtudiants',
            'statsParMois',
            'repartitionAge'
        ));
    }

    /**
     * Calculer l'âge moyen des étudiants.
     */
    private function calculateAverageAge(): float
    {
        $avgAge = Etudiant::selectRaw('AVG(TIMESTAMPDIFF(YEAR, date_naissance, CURDATE())) as avg_age')
            ->first()
            ->avg_age;

        return round($avgAge ?? 0, 1);
    }

    /**
     * Obtenir les statistiques mensuelles.
     */
    private function getMonthlyStats(): array
    {
        $stats = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $count = Etudiant::whereMonth('created_at', $date->month)
                            ->whereYear('created_at', $date->year)
                            ->count();
            
            $stats[] = [
                'mois' => $date->translatedFormat('M Y'),
                'count' => $count,
            ];
        }

        return $stats;
    }

    /**
     * Obtenir la répartition par tranche d'âge.
     */
    private function getAgeDistribution(): array
    {
        $distribution = [
            '< 18 ans' => 0,
            '18-20 ans' => 0,
            '21-23 ans' => 0,
            '24-26 ans' => 0,
            '> 26 ans' => 0,
        ];

        $etudiants = Etudiant::all();

        foreach ($etudiants as $etudiant) {
            $age = $etudiant->date_naissance->age;
            
            if ($age < 18) {
                $distribution['< 18 ans']++;
            } elseif ($age <= 20) {
                $distribution['18-20 ans']++;
            } elseif ($age <= 23) {
                $distribution['21-23 ans']++;
            } elseif ($age <= 26) {
                $distribution['24-26 ans']++;
            } else {
                $distribution['> 26 ans']++;
            }
        }

        return $distribution;
    }
}