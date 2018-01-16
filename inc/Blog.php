<?php

namespace Application;

use Application\DBData;

/**
 * Notre classe principale
 */
class Blog
{
    // Routeur disponible dans la classe Blog
    private $router;
    // Classe d'accès aux données de notre Blog
    private $DBData;

    /**
     * Méthode appelée à l'instanciation de l'objet
     */
    public function __construct($router, $dbConfig)
    {
        // On assigne le router passé en paramètre
        // à notre variable private $router
        $this->router = $router;

        // On instancie notre classe DBData et on lui passe la config
        $this->DBData = new DBData($dbConfig);
    }

    public function indexAction()
    {
        $posts = $this->DBData->getAllPostsRecents();
        $this->render('articles', array('posts' => $posts));
    }

    public function articleAction($id)
    {
        $post = $this->DBData->getOnePost($id);

        $this->render('article', array('post' => $post));
    }

    public function categoryAction($id)
    {
        $posts = $this->DBData->getPostsFromCat($id);
        $this->render('articles', array('posts' => $posts));

    }

    public function adminAction()
    {
        $params['users'] =  $this->DBData->getAllUsers();
        $params['categories'] =  $this->DBData->getAllCategories();
        $params['posts'] = $this->DBData->getAllPostsWithAuthorname();

        $this->render('admin', $params);
    }
    public function editAction($id){
        // Traitement du formulaire (si données postées)
        if(!empty($_POST)){
            $this->DBData->updatePost($id,$_POST);
            header('Location: ' . $this->router->generate('article', ['id' => $id]));
            exit();
        }
        // Affichage du formulaire
        $params = $this->DBData->getOnePost($id);
        $this->render('edit-post', ['posts' => $params]);
    }
    public function addAction(){

        // Si des données sont postées
        if(!empty($_POST)){
            // On insère ces données (pas de validation...)
            $this->DBData->insertPost($_POST['title'], $_POST['summary'], $_POST['content'], $_POST['user_id'], $_POST['category_id']);
            // On redirige vers l'article ou l'admin
            header('Location: ' . $this->router->generate('admin'));
            exit();
        }
        // On récupère les infos users et catégories
        $params['users'] =  $this->DBData->getAllUsers();
        $params['categories'] =  $this->DBData->getAllCategories();
        // On transmet à la vue (au template)
        $this->render('add-post', $params);
    }
    public function deleteAction($id) {
        // On supprime le post VIA son id
        $this->DBData->deletePost($id);
        // On redirige vers l'admin
        header('Location: ' . $this->router->generate('admin'));
        exit();
    }

    /**
     * Création de faux utilisateurs
     */
    public function adminFakerUsersAction()
    {
        // use the factory to create a Faker\Generator instance
        $faker = \Faker\Factory::create('fr_FR');

        // generate data by accessing properties
        for ($i=0; $i < 10; $i++) {
            $this->DBData->insertUser($faker->userName, $faker->email);
        }

        // On redirige vers l'admin
        header('Location: ' . $this->router->generate('admin'));
        exit();
    }

    /**
     * Création de faux posts
     */
    public function adminFakerPostsAction()
    {
        // use the factory to create a Faker\Generator instance
        $faker = \Faker\Factory::create('fr_FR');

        // On récupère nos users
        $users = $this->DBData->getAllUsers();
        //dump($users);
        // On récupère nos catégories
        $categories = $this->DBData->getAllCategories();

        // generate data by accessing properties
        for ($i=0; $i < 10; $i++) {
            $title = $faker->text($maxNbChars = 60);
            $summary = $faker->text($maxNbChars = 200);
            $content = $faker->text($maxNbChars = 450);
            // on va chercher un index au hasard dans $users
            $key_author = array_rand($users);
            // on l'utilise pour récupérer un id de post au hasard
            $id_author = $users[$key_author]['id'];
            // idem avec la catégorie...
            $key_category = array_rand($categories);
            $id_category = $categories[$key_category]['id'];
            // On insert le post avec les données générées via Faker
            $this->DBData->insertPost($title, $summary, $content, $id_author, $id_category);
        }

        // On redirige vers l'admin
        header('Location: ' . $this->router->generate('admin'));
        exit();
    }

    /**
     * Méthode qui sert à afficher une page
     */
    public function render($page, $arrayVars = null)
    {
        include 'templates/header.php';
        // Inclusion dynamique de notre template en fonction du paramètre page transmis via GET
        include 'templates/'.$page.'.php';
        include 'templates/footer.php';
    }
}
