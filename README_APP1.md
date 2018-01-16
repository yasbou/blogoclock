# Ajuster l'application

## A partir du code existant

- Après avoir cloné le repo, modifiez votre `$router->setBasePath()` dans index.php (sinon plantage...).
- Créer les routes avec le routeur, pour les pages restantes : `category` et `admin`, par ex. `/category` (mettre ce lien dans le header sur les 4 catégories) et `/admin` (mettre ce lien dans le footer à côté du copyright).
- Ajouter les 2 routes `/article/1` et `/article/2` dans le template `articles.php`, sur les 2 liens correspondants (ces liens sont statiques pour le moment bien sûr).
- Tenter de comprendre pourquoi l'affichage est planté sur ces pages articles.
- Trouver un moyen de résoudre le problème (pensez à utiliser l'inspecteur web, mais vous le faites déjà n'est-ce-pas :upside_down_face: ?). Une fois que vous aurez trouvé n'hésitez pas à utiliser une constante PHP pour répondre à votre besoin, voir  http://php.net/manual/fr/language.constants.php (si vous en êtes arrivé là, vous pourrez utiliser cette constante à un autre endroit de votre script, je vous laisse trouver où !).

## Bonus

- On souhaite créer des "actions" dans notre classe Blog, et ne pas utiliser directement `render()` dans la définition des routes : trouver un moyen de transformer les lignes actuelles pour les remplacer par des appels du genre `$blog->indexAction()` pour la page d'accueil par exemple (on ne veut donc aucun appel à `render()` depuis nos routes).
- Pour les articles, depuis la route, le paramètre `$id` a été transmis, le faire passer dans la méthode du Blog associée et faire un `echo` de cette variable dans la méthode du contrôleur pour s'assurer qu'elle est bien passée.
- Pouvez-vous afficher cet `$id` dans le template directement ? Si non pourquoi ? Tenter de trouver un moyen de le faire...
- Depuis la doc ou le github d'Altorouter, trouver le moyen d'écrire des routes inversées (Reversed routing) et surtout, mettre en évidence le problème qui se pose :nerd_face: Tenter de résoudre ce problème !

**La plupart des astuces à utiliser ici se trouvent la correction du projet Todolist ! (mais pas toutes).**
