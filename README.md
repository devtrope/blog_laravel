# Blog Laravel/VueJS

## Prérequis

- PHP version 8.2 ou au-dessus
- Node.js version 18.3 ou au-dessus

## Récupération du projet

Pour récupérer le projet en local, exécutez la commande suivante :

```
git clone https://github.com/devtrope/blog_laravel.git
```

## Installation du projet

Une fois le projet récupéré, installez les différentes dépendances du projet via les 2 commandes suivantes :

```
composer install
```

```
npm i
```

Dupliquer le fichier `.env.example` à la racine du projet et renommez le en `.env` puis lancez la commande suivante pour générer la clé de l'application :

```
php artisan key:generate
```

## Génération de la base de données

Commencez tout d'abord par la création de la base de données en lançant la commande :

```
php artisan migrate
```

Validez ensuite que vous souhaitez créer la base dans votre terminal de commande.  
Afin de créer les liens symboliques permettant de gérer les images de l'application lancez la commande :

```
php artisan storage:link
```

La base de données est alors prête à être remplie, pour cela lancez la commande :

```
php artisan db:seed
```

## Lancement du projet

Pour pouvoir lancer le projet, vous n'avez plus qu'à lancer les commandes suivantes :

```
npm run dev
```

```
php artisan serve
```

Le projet devrait alors être accessible à l'adresse `localhost:8000`.