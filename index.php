<?php
// Un raccourci (alias) pour utiliser directemnt Blog dans le code
use Application\Blog;

// Inclusion fichier de config
require_once 'inc/config.php';

// Autoload des packages gérés par Composer
require 'vendor/autoload.php';

// On instancie Altorouter
$router = new AltoRouter();

// On crée un "objet" $blog instancié dcepuis la "classe" Blog
// et on trasmets le routeur au constructeur
$blog = new Blog($router, $dbConfig); // Equivaut à $blog = new Application\Blog($router) sans le use

// Notre projet est étant dans un sous-dossier, on précise ce chemin
// ATTENTION : PAS DE slash "/" final dans le chemin, au début oui
// ET SANS localhost
$router->setBasePath(BASE_URL);

// Définition des routes
// Route vers la page d'accueil
$router->map('GET', '/', function() use($blog) {
    $blog->indexAction();
}, 'home');
// Route vers un article
$router->map('GET', '/article/[i:id]', function($id) use($blog) {
    $blog->articleAction($id);
}, 'article');
// Route vers une category
$router->map('GET', '/category/[i:id]', function($id) use($blog) {
    $blog->categoryAction($id);
}, 'category');
// Route vers l'admin
$router->map('GET', '/admin', function() use($blog) {
    $blog->adminAction();
}, 'admin');
$router->map('GET|POST', '/edit/[i:id]', function($id) use($blog) {
    $blog->editAction($id);
}, 'edit');
// Besoin de préciser GET|POST comme méthodes pour cette route
// car c'est cette méthode qui gère
// l'affichage du formulaire (GET)
// le traitement du formulaire (POST)
$router->map('GET|POST', '/add', function() use($blog) {
    $blog->addAction();
}, 'add');
$router->map('GET', '/delete/[i:id]', function($id) use($blog) {
    $blog->deleteAction($id);
}, 'delete');

// Ajout d'utilisateurs via Faker
$router->map('GET', '/admin/faker/users', function() use($blog) {
    $blog->adminFakerUsersAction();
}, 'admin_faker_users');


// Ajout de posts via Faker
$router->map('GET', '/admin/faker/posts', function() use($blog) {
    $blog->adminFakerPostsAction();
}, 'admin_faker_posts');



// Faire correspondre la route
$match = $router->match();

//var_dump($match);

// Dispatch des routes
if($match) {
    // Cette fonction exécute la fonction PHP fournie
    call_user_func_array($match['target'], $match['params']);
}
else {
    echo 'Erreur 404 : page non trouvée';
	header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    exit;
}
