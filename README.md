# Ajouter les fonctionnalités manquantes

Notre appli commence à ressembler à quelque chose, mais elle n'est pas terminée ! :scream:

Je vous propose donc de la terminer.

Cette liste est à traiter dans l'ordre de votre choix, il n'y pas de priorité à priori. Commencez par ce qui vous semble abordable, ne restez pas bloqué sur une fonctionnalité.

## Accueil

- Afficher le nom de l'auteur au lieu de son id dans les posts, idem avec le nom de la catégorie (indice : ces valeurs sont déjà retournées, il suffit de les afficher).
- Formater la date au format français (au moins JJ-MM-AAAA et plus si affinités => voir la fonction PHP `date`).

## Menu principal

- Créer la liste des catégories de manière dynamique (il faudra créer la requête dans DBData si elle n'existe pas) : lignes 34 à 37 dans `templates/header.php`.

## Page catégorie

- Sur les pages catégories (lien depuis le menu), utiliser l'id de la catégorie pour n'afficher que les posts de la catégorie (la méthode existe déjà dans DBData).
- BONUS : de base, vous avez dû copier-coller le même code source que dans la page "articles". Trouver le moyen _d'inclure_ ici un sous-template commun, utilisé par les 2 pages :wink:

## Page article unique

- Supprimer le debug du `$id` qui traine dans le template.
- Afficher le titre, le résumé, les infos du post, son contenu.
- BONUS : utiliser le sous-template commun créé plus haut.

## Page admin

- Débugguer le lien de bas de page qui ne fonctionne pas bien sur toutes les pages.
- Afficher la liste des auteurs.
- Afficher la liste des catégories.
- Afficher la liste des posts !

## Installer une autre dépendance avec Composer

Installer la classe VarDumper, disponible ici : https://packagist.org/packages/symfony/var-dumper

Cette classe donne accès à une fonction `dump()` bien plus pratique que `var_dump()` ou `print_r()`.

Installez-la avec Composer.

Faites un dump de cette variable :
```php
$var = [
    'id' => 2,
    'colors' => ['red', 'green', 'blue'],
    'test' => false,
    'amount' => 32.5654,
    'now' => new \DateTime(),
];
```

**Une fois le dump affiché, vous pouvez cliquer sur les variables pour les ouvrir !** (celles avec une flèche).

Essayer de dumper les données depuis la classe Blog (les $posts par ex.).

## BIG FAT BONUS admin des posts

**Pour les plus furieux d'entre vous.**

A l'aide de formulaires simples (pas de traitement de la validation !), traiter les cas suivants :

- Nouveau post.
- Edition d'un post.
- Suppression d'un post.

=> L'auteur du post peut-être dans un menu déroulant (un seul auteur).  
=> La catégorie peut-être dans un menu déroulant (une seule catégorie).  

# Ressources du cours d'aujourd'hui

- [Les replays du jour](https://drive.google.com/drive/folders/0B8VHXS3kmVlBT0hacnJZMUd2bzA)
- [Fiche récap' Composer](https://github.com/O-clock-Cosmos/fiches-recap/blob/master/php/composer.md)
- [Fiche récap' Namespaces](https://github.com/O-clock-Cosmos/fiches-recap/blob/master/php/namespaces.md)
- [Site Altorouter](http://altorouter.com)
- [Le schéma MVC](https://raw.githubusercontent.com/O-clock-Cosmos/fiches-recap/master/gestion-projet/img/MVC.png?token=AZoGsfJCbxLvmHD70bfMurJoq5letJZ-ks5Ze1ZSwA%3D%3D)
- [Le projet Blog](https://github.com/O-clock-Cosmos/blog-structure-php-pdo) (même code source de base que ce challenge).
