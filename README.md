#Etape 1: Configuration de la partie authentification avec breeze
Laravel Breeze est un package minimaliste qui fournit une implémentation simple de l'authentification avec des vues Blade.

Installer Laravel Breeze :
- composer require laravel/breeze --dev


Installer Breeze :
- php artisan breeze:install


Compiler les assets :
- npm install && npm run dev


Migrer la base de données :
- php artisan migrate

#Etape 2 : Configuration des role en Créer une migration pour ajouter une colonne role à la table users :
php artisan make:migration add_role_to_users_table --table=users

Etape 3 : Création d'un middleware pour gérer les rôles
-  php artisan make:middleware CheckRole

Control des accès
(
    @auth
    @if(auth()->user()->role === 'admin')
        <a href="/admin">Tableau de bord administrateur</a>
    @else
        <a href="/user">Tableau de bord utilisateur</a>
    @endif
    @endauth
)

#Etape 4 : Ajouter des logs pour suivre les changements de rôles.

#Etape 5 : Si tu veux personnaliser les fichiers Blade de Breeze (y compris verify-email-notice.blade.php), exécute cette commande pour publier les vues
- php artisan vendor:publish --tag=laravel-mai