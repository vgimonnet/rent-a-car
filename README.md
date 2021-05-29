# Rent a car

## Installation

Copier/Coller le fichier **.env.example** et le renommer **.env**

### Base de données

Dans le fichier **.env** précédemment créé, modifiez les informations suivantes pour quelles correspondent à votre base de donnée :

* DB_CONNECTION=
* DB_HOST=
* DB_PORT=
* DB_DATABASE=
* DB_USERNAME=
* DB_PASSWORD=

Ensuite, rendez-vous sur _phpMyAdmin_ pour créer la base de données qui portera le même nom que la variable d'environnement **DB_DATABASE**, puis lancez la commande suivante pour créer les tables à partir des fichiers de migrations.
> php artisan migrate

La base de données est prête à fonctionner.

### Dépendances

Lancer les commandes suivantes pour installer les dépendances nécessaires au fonctionnement du projet :
> composer update
> 
> npm install
> 
> npm run dev

## Lancer l'application
Exécutez la commande suivante :
> php artisan serve

Puis rendez-vous [ici](http://localhost:8000)

