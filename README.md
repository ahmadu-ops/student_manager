# 🎓 Student Manager

Une application web moderne de gestion des étudiants et des filières, développée avec Laravel et Tailwind CSS.

![Laravel](https://img.shields.io/badge/Laravel-11.x-red?style=flat-square&logo=laravel)
![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-4.x-blue?style=flat-square&logo=tailwindcss)
![PHP](https://img.shields.io/badge/PHP-8.2+-purple?style=flat-square&logo=php)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

---

## 📋 Table des matières

- [Aperçu](#-aperçu)
- [Fonctionnalités](#-fonctionnalités)
- [Prérequis](#-prérequis)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Utilisation](#-utilisation)
- [Structure du projet](#-structure-du-projet)
- [Routes disponibles](#-routes-disponibles)
- [Commandes utiles](#-commandes-utiles)
- [Technologies utilisées](#-technologies-utilisées)
- [Contribution](#-contribution)
- [Licence](#-licence)
- [Auteur](#-auteur)

---

## 🌟 Aperçu

**Student Manager** est une application web complète permettant de gérer efficacement les filières universitaires et les étudiants. Conçue avec une interface moderne et intuitive, elle offre une expérience utilisateur optimale pour les administrateurs d'établissements scolaires.

---

## ✨ Fonctionnalités

### 📊 Tableau de bord
- **Statistiques en temps réel** : nombre d'étudiants, filières, inscriptions du mois
- **Graphique des inscriptions** sur les 6 derniers mois
- **Répartition des étudiants** par filière et par tranche d'âge
- **Liste des dernières inscriptions**
- **Actions rapides** pour une navigation efficace

### 📁 Gestion des Filières
- ✅ Création de nouvelles filières
- ✅ Liste complète avec comptage des étudiants
- ✅ Suppression sécurisée (impossible si étudiants inscrits)
- ✅ Validation des données

### 👥 Gestion des Étudiants
- ✅ Création avec formulaire complet
- ✅ Liste paginée avec informations détaillées
- ✅ Suppression d'étudiants
- ✅ Validation des données (email unique, date de naissance)

### 🔍 Recherche Avancée (Bonus)
- Recherche par nom
- Recherche par email
- Filtrage par filière
- Filtrage par intervalle de date de naissance
- Combinaison de plusieurs critères

---

## 📋 Prérequis

Avant de commencer, assurez-vous d'avoir installé :

| Outil      | Version minimum |
|------------|-----------------|
| PHP        | 8.2+           |
| Composer   | 2.x            |
| Node.js    | 18.x+          |
| npm        | 9.x+           |
| MySQL      | 8.0+           |

---

## 🚀 Installation

### 1. Cloner le projet

```bash
git clone https://github.com/votre-username/student-manager.git
cd student-manager
```

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Installer les dépendances Node.js

```bash
npm install
```

### 4. Configurer l'environnement

```bash
# Copier le fichier d'environnement
cp .env.example .env

# Générer la clé d'application
php artisan key:generate
```

### 5. Configurer la base de données

Modifiez le fichier `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=student_manager
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe
```

### 6. Créer la base de données

```sql
CREATE DATABASE student_manager;
```

### 7. Exécuter les migrations et seeders

```bash
php artisan migrate:fresh --seed
```

### 8. Compiler les assets

```bash
# Développement (avec hot reload)
npm run dev

# Production
npm run build
```

### 9. Lancer le serveur

```bash
php artisan serve
```

🎉 **L'application est accessible sur** http://localhost:8000

---

## ⚙️ Configuration

### Variables d'environnement importantes

| Variable     | Description              | Valeur par défaut  |
|--------------|--------------------------|-------------------|
| APP_NAME     | Nom de l'application     | Student Manager   |
| APP_ENV      | Environnement            | local             |
| APP_DEBUG    | Mode debug               | true              |
| DB_DATABASE  | Nom de la BDD            | student_manager   |

### Personnalisation des seeders

Pour modifier le nombre d'étudiants générés, éditez `database/seeders/EtudiantSeeder.php` :

```php
$nombreEtudiants = 150; // Modifiez cette valeur
```

---

## 📖 Utilisation

### Accéder à l'application

1. Ouvrez votre navigateur
2. Allez sur http://localhost:8000
3. Naviguez via le menu principal

### Créer une filière

1. Cliquez sur **Filières** dans le menu
2. Cliquez sur **Nouvelle Filière**
3. Entrez le nom de la filière
4. Cliquez sur **Enregistrer**

### Créer un étudiant

1. Cliquez sur **Étudiants** dans le menu
2. Cliquez sur **Nouvel Étudiant**
3. Remplissez le formulaire :
   - Nom complet
   - Email
   - Date de naissance
   - Filière
4. Cliquez sur **Enregistrer**

### Rechercher des étudiants

1. Allez sur la liste des étudiants
2. Dépliez la section **Recherche avancée**
3. Entrez vos critères de recherche
4. Cliquez sur **Rechercher**

---

## 📂 Structure du projet

```
student_manager/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── HomeController.php      # Dashboard et statistiques
│   │       ├── FiliereController.php   # CRUD Filières
│   │       └── EtudiantController.php  # CRUD Étudiants
│   └── Models/
│       ├── Filiere.php                 # Modèle Filière
│       └── Etudiant.php                # Modèle Étudiant
├── database/
│   ├── migrations/
│   │   ├── create_filieres_table.php
│   │   └── create_etudiants_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── FiliereSeeder.php           # 19 filières scientifiques
│       └── EtudiantSeeder.php          # 150 étudiants sénégalais
├── resources/
│   ├── css/
│   │   └── app.css                     # Styles Tailwind
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php           # Layout principal
│       ├── home.blade.php              # Page d'accueil
│       ├── filieres/
│       │   ├── index.blade.php
│       │   └── create.blade.php
│       └── etudiants/
│           ├── index.blade.php
│           └── create.blade.php
├── routes/
│   └── web.php                         # Définition des routes
├── .env                                # Configuration environnement
├── tailwind.config.js                  # Configuration Tailwind
├── vite.config.js                      # Configuration Vite
└── README.md                           # Ce fichier
```

---

## 📝 Routes disponibles

| Méthode | URI                  | Action                      | Description                |
|---------|----------------------|-----------------------------|----------------------------|
| GET     | /                    | HomeController@index        | Page d'accueil avec stats  |
| GET     | /filieres            | FiliereController@index     | Liste des filières         |
| GET     | /filieres/create     | FiliereController@create    | Formulaire création        |
| POST    | /filieres            | FiliereController@store     | Enregistrer filière        |
| DELETE  | /filieres/{id}       | FiliereController@destroy   | Supprimer filière          |
| GET     | /etudiants           | EtudiantController@index    | Liste des étudiants        |
| GET     | /etudiants/create    | EtudiantController@create   | Formulaire création        |
| POST    | /etudiants           | EtudiantController@store    | Enregistrer étudiant       |
| DELETE  | /etudiants/{id}      | EtudiantController@destroy  | Supprimer étudiant         |

---

## 🧪 Commandes utiles

```bash
# Lancer les migrations
php artisan migrate

# Réinitialiser la base avec les seeders
php artisan migrate:fresh --seed

# Vider le cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Voir les routes
php artisan route:list

# Compiler les assets (dev)
npm run dev

# Compiler les assets (production)
npm run build
```

---

## 🛠️ Technologies utilisées

### Backend
- **Laravel 11** - Framework PHP moderne
- **PHP 8.2+** - Langage de programmation
- **MySQL 8** - Base de données relationnelle
- **Eloquent ORM** - ORM pour la gestion des données

### Frontend
- **Tailwind CSS 4** - Framework CSS utilitaire
- **Blade** - Moteur de templates Laravel
- **Vite** - Build tool moderne

### Outils de développement
- **Composer** - Gestionnaire de dépendances PHP
- **npm** - Gestionnaire de paquets Node.js
- **Git** - Contrôle de version

---

## 🤝 Contribution

Les contributions sont les bienvenues ! Pour contribuer :

1. Forkez le projet
2. Créez une branche (`git checkout -b feature/AmazingFeature`)
3. Committez vos changements (`git commit -m 'Add AmazingFeature'`)
4. Pushez sur la branche (`git push origin feature/AmazingFeature`)
5. Ouvrez une Pull Request

---

## 📜 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

---

## 👨‍💻 Auteur

**Cheikhouna Modou Bamba FALL**

- GitHub: [@votre-username](https://github.com/ahmadu-ops)
- Email: cmbamba.fall@univ-thies.sn

---

## 🙏 Remerciements

- **Laravel** pour le framework exceptionnel
- **Tailwind CSS** pour le design moderne
- La **communauté open source**

---

<div align="center">

**Fait avec ❤️ pour la gestion académique**

</div>