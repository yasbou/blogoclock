<?php

namespace Application;

/* Classe chargée d'interagir avec la base de données
  - connexion
  - éxécution de requêtes et renvoi des résultats
*/

class DBData
{

  /* la connexion à la base est conservée dans la propriété $db, mais récupérée dans les autres méthodes grâce à la méthode getDB
     ce qui permet de ne l'instancier qu'au premier appel, puis de réutiliser la même connexion (au lieu de re-créer une nouvelle connexion pour chaque requête) */
  private $db;

  // Config DB
  private $config;

  public function __construct($config)
  {
      $this->config = $config;
  }

  // fonction à utiliser par toutes les autres pour accéder à la connexion à la base de données:
  protected function getDB()
  {
    // Si la connection DB n'a pas déjà été faite, il faut la faire
    if(!$this->db)
    {
      // Se connecter à la base de données avec PDO
      try {
        $this->db = new \PDO("mysql:host=" . $this->config['dbhost'] . ";dbname=" . $this->config['dbname'].";charset=utf8", $this->config['dbuser'], $this->config['dbpass']);
      }
      catch (\PDOException $e) {
        die("Error connecting to DB: " . $e->getMessage());
      }
    }

    // dans tous les cas, on la retourne
    return $this->db;
  }


  // #### OPERATIONS DE LECTURE
  // Les opérations de lecture doivent renvoyer le résultat

  // - liste des articles
  public function getAllPosts()
  {
    $sql = 'SELECT * FROM posts';

    // cette requête ne prend pas de paramètre variable
    // => on peut utiliser la méthode query
    $res = $this->getDB()->query($sql);

    // on veut renvoyer tous les résultats de la requête = fetchAll
    return $res->fetchAll(\PDO::FETCH_ASSOC);
  }
  public function getAllUsers(){
      $sql = 'SELECT id,username FROM users';
      $res = $this->getDB()->query($sql);
      return $res->fetchAll();
  }
  public function getAllCategories(){
      $sql = 'SELECT * FROM categories';
      $res = $this->getDB()->query($sql);
      return $res->fetchAll();
  }

  // - détail d'un article
  public function getOnePost($id)
  {
    $sql = 'SELECT * FROM posts
    INNER JOIN users
        ON users.id = posts.id_author
    INNER JOIN categories
        ON posts.id_category = categories.id
    WHERE posts.id = :id';

    // Cette requête prend un paramètre variable,
    // => il faut utiliser les requêtes préparées : prepare
    $query = $this->getDB()->prepare($sql);
    // on indique à PDO par quelle valeur remplacer le paramètre id (et on précise qu'il s'agit d'un entier, par défaut les paramtres sont traités comme des chaînes de catractères)
    $query->bindValue(':id', $id, \PDO::PARAM_INT);
    $query->execute();

    // pratique pour débugger la requête et les paramètres :
    // echo '<pre>';
    // $query->debugDumpParams();
    // echo '</pre>';

    // on renvoie un seul résultat => fetch
    return $query->fetch(\PDO::FETCH_ASSOC);
  }

  // - liste des articles, le plus récent en premier
  public function getAllPostsRecents()
  {
    // ordonner les résultats avec ORDER BY xxxx ASC | DESC
    $sql = 'SELECT posts.*, users.username, categories.fullname FROM posts
        LEFT JOIN users ON posts.id_author = users.id
        LEFT JOIN categories ON posts.id_category = categories.id
        ORDER BY date_created DESC';

    // Cette requête ne prend pas de paramètre
    $res = $this->getDB()->query($sql);

    return $res->fetchAll(\PDO::FETCH_ASSOC);

  }

  // - liste des articles avec le nom de l'auteur
  public function getAllPostsWithAuthorname()
  {
    // jointure entre la table "posts" et la table "users"
    // pour récupérer le nom de l'auteur correspondant à chaque post
    // il y aura donc les champs de la table posts et les champs de la table users dans le résultat
    $sql = 'SELECT posts.*, users.username FROM posts LEFT JOIN users ON posts.id_author = users.id ORDER BY date_created DESC, id DESC';

    // Cette requête ne prend pas de paramètre
    $res = $this->getDB()->query($sql);
    return $res->fetchAll(\PDO::FETCH_ASSOC);
  }

  // - informations d'une catégorie dont l'id est fourni
  public function getCat($id)
  {
    $sql = 'SELECT * FROM categories WHERE id = :id';

    $query = $this->getDB()->prepare($sql);
    $query->bindValue(':id', $id, \PDO::PARAM_INT);
    $query->execute();

    return $query->fetch(\PDO::FETCH_ASSOC);

  }

  // - liste des articles d'une catégorie dont l'id est fourni
  public function getPostsFromCat($id)
  {
    $sql = 'SELECT *
            FROM posts p
            INNER JOIN categories c
              ON p.id_category = c.id
            INNER JOIN users u
              ON p.id_author = u.id
            WHERE p.id_category = :id';

    $query = $this->getDB()->prepare($sql);
    $query->bindValue(':id', $id, \PDO::PARAM_INT);
    $query->execute();

    return $query->fetchAll(\PDO::FETCH_ASSOC);

  }

  // - liste des articles d'un auteur dont le nom est fourni
  public function getPostsFromAuthorName($author)
  {
    $sql = "SELECT *
            FROM posts p
            INNER JOIN users u
              ON p.id_athor = u.id
            WHERE u.username LIKE '%:name%'";

    $query = $this->getDB()->prepare($sql);
    $query->bindValue(':name', $author);
    $query->execute();

    return $query->fetchAll(\PDO::FETCH_ASSOC);

  }

  // - tous les articles contenant un mot XXX dans leur titre
  public function searchPostsTitleHas($word)
  {
    $sql = "SELECT *
            FROM posts p
            WHERE p.title LIKE :word";

    $query = $this->getDB()->prepare($sql);
    // pour comparer des chaines de caractères, on utilise LIKE en sql
    // qui permet entre autres de rechercher selon certains critères, pas seulement un identité exacte
    // http://sql.sh/cours/where/like
    $query->bindValue(':word', '%' . $word . '%');
    $query->execute();

    return $query->fetchAll(\PDO::FETCH_ASSOC);

  }

  // - tous les articles contenant un mot XXX dans leur titre ou leur contenu
  public function searchPostsHas($word)
  {
    $sql = "SELECT *
            FROM posts p
            WHERE p.title LIKE :word
            OR p.summary LIKE :word
            OR p.content LIKE :word";

    $query = $this->getDB()->prepare($sql);
    // on ne bind qu'une fois le paramètre, même s'il est plusieurs fois dans la requête
    $query->bindValue(':word', '%' . $word . '%');
    $query->execute();

    return $query->fetchAll(\PDO::FETCH_ASSOC);

  }


  // #### OPERATIONS D'ECRITURE
  // les opérations d'écriture doivent renvoyer le nombre de lignes affectées par la modif.
  // Toutes les opérations d'écriture utilisent un paramètre, ce sont donc forcément des requêtes préparées!

  // - insérer un nouvel article
  public function insertPost($title, $summary, $content, $id_author, $id_category)
  {
    $sql = "INSERT INTO posts
            VALUES ( NULL, :title, :summary, :content, NOW(), :id_author, :id_category)";
    /* OU
    $sql = "INSERT INTO posts
            VALUES ( NULL, :title, :summary, :content, NOW(), :id_author)";
    */

    $query = $this->getDB()->prepare($sql);
    // plusieurs paramètres = on appelle plusieurs fois bindValue
    $query->bindValue(':title', $title);
    $query->bindValue(':summary', $summary);
    $query->bindValue(':content', $content);
    $query->bindValue(':id_author', $id_author, \PDO::PARAM_INT);
    $query->bindValue(':id_category', $id_category, \PDO::PARAM_INT);
    $ok = $query->execute();

    return $ok ? $query->rowCount() : $ok;
  }

  // - modifier un article dont on connait l'id
  // $data est un tableau qui contient les nouvelles valeurs, indexé par les noms de champs d'un post
  /* ex: [
    "title" => "nouveau titre",
    "summary" => "nouveau résumé"
    ""
  ] */
  public function updatePost($id, $data)
  {
    $sql = "UPDATE posts
            SET
              ";
    if(!empty($data['title'])) $sql .= ' title = :title, ';
    if(!empty($data['summary'])) $sql .= ' summary = :summary, ';
    if(!empty($data['content'])) $sql .= ' content = :content, ';
    if(!empty($data['id_author'])) $sql .= ' id_author = :id_author, ';
    if(!empty($data['id_category'])) $sql .= ' id_category = :id_category, ';

    // remove last ,
    $sql = substr($sql, 0, -2);

    // !! ne pas oublier l'id pour ne modifier qu'UNE ligne
    $sql .= ' WHERE id = :id';

    $query = $this->getDB()->prepare($sql);

    $query->bindValue(':id', $id, \PDO::PARAM_INT);
    if(!empty($data['title'])) $query->bindValue(':title', $data['title'] );
    if(!empty($data['summary'])) $query->bindValue(':summary', $data['summary'] );
    if(!empty($data['content'])) $query->bindValue(':content', $data['content'] );
    if(!empty($data['id_author'])) $query->bindValue(':id_author',$data['id_author'], \PDO::PARAM_INT);
    if(!empty($data['id_category'])) $query->bindValue(':id_category',$data['id_category'], \PDO::PARAM_INT);
    $ok = $query->execute();

    return $ok ? $query->rowCount() : $ok;

  }

  // - supprimer un post à partir de son id
  public function deletePost($id)
  {
    // ATTENTION ne pas oublier de mettre une condition dans une requete DELETE, sinon... on vide la table.
    $sql = "DELETE FROM posts
            WHERE id = :id";
    $queryDelete = $this->getDB()->prepare($sql);
    $queryDelete->bindValue(':id', $id, \PDO::PARAM_INT);
    $ok = $queryDelete->execute();

    return $ok ? $queryDelete->rowCount() : $ok;
  }

  // - supprimer tous les posts plus vieux qu'une date donnée
  public function deleteOlderPosts($date)
  {
    $sql = "DELETE FROM posts
            WHERE date_created < :limitdate";
    $queryDelete = $this->getDB()->prepare($sql);
    $queryDelete->bindValue(':limitdate', $date);
    $ok = $queryDelete->execute();

    return $ok ? $queryDelete->rowCount() : $ok;
  }

  // - insérer un nouvel article
  public function insertUser($username, $email)
  {
    $sql = "INSERT INTO users
            VALUES ( NULL, :username, :email)";

    $query = $this->getDB()->prepare($sql);
    // plusieurs paramètres = on appelle plusieurs fois bindValue
    $query->bindValue(':username', $username);
    $query->bindValue(':email', $email);
    $ok = $query->execute();

    return $ok ? $query->rowCount() : $ok;
  }


}
