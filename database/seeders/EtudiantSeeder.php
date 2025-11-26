<?php

namespace Database\Seeders;

use App\Models\Etudiant;
use App\Models\Filiere;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EtudiantSeeder extends Seeder
{
    /**
     * Prénoms sénégalais masculins
     */
    private array $prenomsMasculins = [
        'Mamadou', 'Ibrahima', 'Ousmane', 'Moussa', 'Abdoulaye',
        'Cheikh', 'Modou', 'Pape', 'Serigne', 'Babacar',
        'Aliou', 'Amadou', 'Boubacar', 'Djibril', 'El Hadji',
        'Fallou', 'Gorgui', 'Habib', 'Idrissa', 'Karim',
        'Lamine', 'Malick', 'Ndongo', 'Omar', 'Pathé',
        'Saliou', 'Talla', 'Youssou', 'Assane', 'Birima',
        'Demba', 'Elimane', 'Fodé', 'Ismaïla', 'Khadim',
        'Makhtar', 'Mor', 'Ndiaga', 'Ousseynou', 'Samba',
    ];

    /**
     * Prénoms sénégalais féminins
     */
    private array $prenomsFeminins = [
        'Fatou', 'Aminata', 'Aïssatou', 'Mariama', 'Khady',
        'Ndèye', 'Awa', 'Coumba', 'Dieynaba', 'Fama',
        'Gnima', 'Haby', 'Khadija', 'Mame', 'Ndeye Fatou',
        'Oumou', 'Rama', 'Seynabou', 'Thioro', 'Yacine',
        'Adja', 'Bintou', 'Dado', 'Fanta', 'Kiné',
        'Mbayang', 'Ngoné', 'Penda', 'Rokhaya', 'Sokhna',
        'Astou', 'Diary', 'Madjiguène', 'Nafissatou', 'Selbé',
    ];

    /**
     * Noms de famille sénégalais
     */
    private array $nomsFamille = [
        // Wolof
        'Diop', 'Ndiaye', 'Fall', 'Seck', 'Mbaye',
        'Gueye', 'Faye', 'Sarr', 'Diouf', 'Sy',
        'Thiam', 'Dieng', 'Kane', 'Ndoye', 'Sow',
        'Ba', 'Diallo', 'Niang', 'Cissé', 'Ly',
        
        // Pulaar
        'Bâ', 'Barry', 'Baldé', 'Diallo', 'Sow',
        
        // Sérère
        'Diouf', 'Faye', 'Ndour', 'Sarr', 'Sène',
        
        // Mandingue
        'Dramé', 'Konaté', 'Keita', 'Touré', 'Traoré',
        
        // Diola
        'Diatta', 'Badji', 'Manga', 'Sané', 'Sonko',
        
        // Autres
        'Camara', 'Mendy', 'Gomis', 'Sambou', 'Diedhiou',
    ];

    /**
     * Domaines email
     */
    private array $domainesEmail = [
        'ugb.edu.sn',           // Université Gaston Berger
        'ucad.edu.sn',          // Université Cheikh Anta Diop
        'uadb.edu.sn',          // Université Alioune Diop de Bambey
        'univ-thies.sn',        // Université de Thiès
        'uasz.edu.sn',          // Université Assane Seck de Ziguinchor
        'esp.sn',               // École Supérieure Polytechnique
        'isep-thies.edu.sn',    // ISEP Thiès
        'ept.sn',               // École Polytechnique de Thiès
        'gmail.com',
        'yahoo.fr',
        'hotmail.com',
        'outlook.com',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filieres = Filiere::all();

        if ($filieres->isEmpty()) {
            $this->command->error('❌ Aucune filière trouvée. Exécutez d\'abord FiliereSeeder.');
            return;
        }

        $nombreEtudiants = 150;
        $etudiants = [];

        for ($i = 0; $i < $nombreEtudiants; $i++) {
            $isFemale = rand(0, 1) === 1;
            $prenom = $isFemale 
                ? $this->prenomsFeminins[array_rand($this->prenomsFeminins)]
                : $this->prenomsMasculins[array_rand($this->prenomsMasculins)];
            $nom = $this->nomsFamille[array_rand($this->nomsFamille)];
            
            $nomComplet = $prenom . ' ' . $nom;
            $email = $this->genererEmail($prenom, $nom);
            $dateNaissance = $this->genererDateNaissance();
            $filiereId = $filieres->random()->id;

            $etudiants[] = [
                'nom' => $nomComplet,
                'email' => $email,
                'date_naissance' => $dateNaissance,
                'filiere_id' => $filiereId,
                'created_at' => $this->genererDateInscription(),
                'updated_at' => now(),
            ];
        }

        // Insérer par lots pour de meilleures performances
        foreach (array_chunk($etudiants, 50) as $chunk) {
            Etudiant::insert($chunk);
        }

        $this->command->info('✅ ' . $nombreEtudiants . ' étudiants sénégalais créés avec succès !');
    }

    /**
     * Générer un email unique à partir du prénom et nom
     */
    private function genererEmail(string $prenom, string $nom): string
    {
        $domaine = $this->domainesEmail[array_rand($this->domainesEmail)];
        
        // Nettoyer les caractères spéciaux
        $prenomClean = $this->nettoyerPourEmail($prenom);
        $nomClean = $this->nettoyerPourEmail($nom);
        
        $formats = [
            $prenomClean . '.' . $nomClean,
            $prenomClean . $nomClean,
            strtolower($prenomClean[0]) . '.' . $nomClean,
            $prenomClean . '.' . $nomClean . rand(1, 99),
            $prenomClean . rand(100, 999),
            $nomClean . '.' . $prenomClean,
        ];
        
        $localPart = $formats[array_rand($formats)];
        
        return strtolower($localPart) . '@' . $domaine;
    }

    /**
     * Nettoyer une chaîne pour utilisation dans un email
     */
    private function nettoyerPourEmail(string $str): string
    {
        $str = str_replace(
            ['é', 'è', 'ê', 'ë', 'à', 'â', 'ä', 'ù', 'û', 'ü', 'ô', 'ö', 'î', 'ï', 'ç', 'ñ', ' ', 'ï', 'Ï'],
            ['e', 'e', 'e', 'e', 'a', 'a', 'a', 'u', 'u', 'u', 'o', 'o', 'i', 'i', 'c', 'n', '', 'i', 'i'],
            $str
        );
        return preg_replace('/[^a-zA-Z0-9]/', '', $str);
    }

    /**
     * Générer une date de naissance réaliste (18-28 ans)
     */
    private function genererDateNaissance(): string
    {
        $ageMin = 18;
        $ageMax = 28;
        $age = rand($ageMin, $ageMax);
        
        return Carbon::now()
            ->subYears($age)
            ->subDays(rand(0, 365))
            ->format('Y-m-d');
    }

    /**
     * Générer une date d'inscription (dans les 12 derniers mois)
     */
    private function genererDateInscription(): string
    {
        return Carbon::now()
            ->subDays(rand(0, 365))
            ->format('Y-m-d H:i:s');
    }
}