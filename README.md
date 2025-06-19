#  Système de Gestion des Notes - Laravel
Un système web robuste et sécurisé, développé avec Laravel, permettant à l'administration de gérer les utilisateurs et les notes des étudiants, et aux étudiants de consulter leurs résultats en toute simplicité.

 Fonctionnalités Clés
Ce projet implémente les fonctionnalités suivantes pour une gestion complète des notes :

 Gestion des Utilisateurs et Rôles
Le système distingue trois profils d'utilisateurs avec des droits spécifiques :

Administrateurs : Contrôle total sur l'application.
Assistants : Gestion des étudiants et des notes.
Étudiants : Consultation de leurs informations et notes.
 Authentification et Autorisation Robuste
Comptes par défaut :
Administrateur : test@test.com / 123456789@
Étudiants : Création automatique via CSV (code_étudiant@supmti.com / code_étudiant).
Gestion des sessions sécurisée pour chaque type d'utilisateur.
 Fonctionnalités par Profil
Administrateurs
Gestion complète des utilisateurs : Ajout, modification, suppression des Administrateurs, Assistants et Étudiants.
Recherche avancée d'étudiants : Par Nom, Prénom, Code étudiant, Code du module.
Consultation et modification des informations et notes des étudiants.
Importation de notes via fichier CSV (format spécifique).
Suppression massive des comptes et notes d'étudiants (avec confirmation).
Accès à un tableau de bord des logs (suivi des activités).
Gestion de profil personnel.
Assistants
Mêmes droits que l'Administrateur, à l'exception de la gestion des Administrateurs/Assistants et de l'accès aux logs.
Étudiants
Page de profil : Modification du mot de passe.
Page de notes : Vue détaillée de toutes les notes par module.
 Importation CSV Intelligente
Acceptation exclusive de fichiers CSV avec les colonnes : first_name, last_name, student_code, module_name, module_code, professor_name, note_ct, note_ex, note_element, level.
Création automatique de comptes étudiants si l'étudiant n'existe pas.
Mise à jour automatique des notes si l'étudiant existe.
 Technologies Utilisées
Framework : Laravel (Version 10.x)
Langage : PHP
Base de Données : MySQL (ou PostgreSQL, SQLite si vous avez utilisé autre chose)
Frontend : HTML, CSS (TailwindCSS/Bootstrap si utilisé), JavaScript (Alpine.js/Livewire/Vue.js si utilisé)
Serveur Web : Nginx / Apache (via Laravel Valet, Laragon, XAMPP, WAMP, Docker etc.)
 Installation et Configuration Locale
Suivez ces étapes pour démarrer le projet sur votre machine locale :

Cloner le dépôt :

Bash

git clone https://github.com/votre_nom_utilisateur/nom_de_votre_depot.git
cd nom_de_votre_depot
Installer les dépendances Composer :

Bash

composer install
Copier le fichier d'environnement et générer la clé d'application :

Bash

cp .env.example .env
php artisan key:generate
Configurer la base de données :

Ouvrez le fichier .env et configurez vos informations de base de données :
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=votre_nom_bdd # ex: notes_db
DB_USERNAME=votre_utilisateur_bdd
DB_PASSWORD=votre_mot_de_passe_bdd
Créez une base de données vide avec le nom que vous avez choisi (notes_db dans l'exemple) via phpMyAdmin ou votre outil préféré.
Exécuter les migrations et les seeders :

Bash

php artisan migrate --seed
Cette commande va créer les tables nécessaires et insérer l'utilisateur administrateur par défaut.
Lancer le serveur de développement :

Bash

php artisan serve
Accéder à l'application :
Ouvrez votre navigateur et accédez à http://127.0.0.1:8000.

📸 Aperçu de l'Application
(À AJOUTER : C'est ici que vous insérerez des captures d'écran (PNG/JPG) ou des GIFs animés montrant les interfaces clés de votre application. C'est CRUCIAL pour les recruteurs !)

Exemples d'éléments à montrer :
Page de connexion/tableau de bord Admin
Page de gestion des utilisateurs (liste, ajout/modification)
Formulaire d'importation CSV
Page des notes de l'étudiant
Page de profil utilisateur
