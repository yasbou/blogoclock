
<?php $post = $arrayVars['posts']; ?>

<main class="container">
    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            <div class="category-title">
                <h2>Editer un article</h2>
            </div>

        <form method="post" class="col-md-8 col-md-offset-2">

        <div class="post-preview">
          <div class="form-group">
            <label>Titre de l'article</label>
            <input type="text" class="form-control" value="<?= $post['title'] ?>" name="title">
          </div>

          <div class="form-group">
            <label>Résumé de l'article</label>
            <input type="text" class="form-control" value="<?= $post['summary'] ?>" name="summary">
          </div>
            <p>Posté par
                <span><?= $post['username'] ?></span> le  <?php echo date("d-m-Y", strtotime($post['date_created'])) ?> dans
                <span>#<?= $post['fullname'] ?></span>.
            </p>
        </div>
        <label class="label-article">Contenu de l'article</label>

          <div class="form-group">
            <textarea type="text" class="form-control" rows="13" name="content"><?= $post['content'] ?></textarea>
          </div>

          <div class="form-group">
            <button type="submit" class="form-control">Envoyer</button>
          </div>
        <hr>
        </form>
    </div>
</main>
