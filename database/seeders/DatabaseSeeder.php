<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('🌱 Début du seeding de la base de données...');
        $this->command->newLine();

        // Exécuter les seeders dans l'ordre
        $this->call([
            FiliereSeeder::class,
            EtudiantSeeder::class,
        ]);

        $this->command->newLine();
        $this->command->info('🎉 Seeding terminé avec succès !');
    }
}