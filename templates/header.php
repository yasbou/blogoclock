<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>A la dérive - Blog Cosmos</title>

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,800" rel="stylesheet">
        <script src="https://use.fontawesome.com/7455f3feae.js"></script>
        <!-- inclusion des Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/bootstrap/css/bootstrap.min.css">
        <!-- inclusion de NOTRE CSS pour la personnalisation du blog -->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/css/blog.css">
    </head>
    <body>

        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?php echo $this->router->generate('home') ?>">A la dérive</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo $this->router->generate('add'); ?>">Ajouter</a></li>
                <li><a href="<?php echo $this->router->generate('admin'); ?>">Admin</a></li>
                <li><a href="<?php echo $this->router->generate('category', array('id' => 2)); ?>">Teamfront</a></li>
                <li><a href="<?php echo $this->router->generate('category', array('id' => 1)); ?>">Teamback</a></li>
                <li><a href="<?php echo $this->router->generate('category', array('id' => 3)); ?>">Collaboration</a></li>
                <li><a href="<?php echo $this->router->generate('category', array('id' => 4)); ?>">MaVieDeDev</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>

        <header>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-10 col-md-offset-1">
                        <h1>A la dérive</h1>
                        <hr>
                        <span>Un blog collaboratif de développeurs web dérivant délibérément au beau milieu de l'espace</span>
                    </div>
                </div>
            </div>
        </header>
