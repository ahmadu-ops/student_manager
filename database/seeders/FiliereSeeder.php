<?php

namespace Database\Seeders;

use App\Models\Filiere;
use Illuminate\Database\Seeder;

class FiliereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filieres = [
            // Sciences exactes
            ['nom' => 'Mathématiques-Informatique (MI)'],
            ['nom' => 'Physique-Chimie (PC)'],
            ['nom' => 'Sciences de la Vie et de la Terre (SVT)'],
            ['nom' => 'Mathématiques-Physique (MP)'],
            
            // Informatique et Technologies
            ['nom' => 'Licence Informatique'],
            ['nom' => 'Génie Logiciel'],
            ['nom' => 'Réseaux et Télécommunications'],
            ['nom' => 'Sécurité Informatique'],
            ['nom' => 'Data Science et Intelligence Artificielle'],
            
            // Sciences de l\'Ingénieur
            ['nom' => 'Génie Civil'],
            ['nom' => 'Génie Électrique'],
            ['nom' => 'Génie Mécanique'],
            ['nom' => 'Génie Chimique'],
            
            // Sciences de la Santé
            ['nom' => 'Médecine'],
            ['nom' => 'Pharmacie'],
            ['nom' => 'Biologie Médicale'],
            
            // Autres filières scientifiques
            ['nom' => 'Agronomie'],
            ['nom' => 'Géologie'],
            ['nom' => 'Statistiques et Démographie'],
        ];

        foreach ($filieres as $filiere) {
            Filiere::create($filiere);
        }

        $this->command->info('✅ ' . count($filieres) . ' filières créées avec succès !');
    }
}