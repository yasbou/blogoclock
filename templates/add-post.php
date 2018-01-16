<main class="container">
    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            <div class="category-title">
                <h2>Envoyer un article</h2>
            </div>
        <form  method="post" class="col-md-8 col-md-offset-2">


          <div class="form-group">
            <label>Titre de l'article</label>
            <input type="text" class="form-control" value="" name="title">
          </div>
        


          <div class="form-group">
            <label>Auteur</label>
            <select name="user_id">
                <?php foreach ($arrayVars['users'] as $user): ?>
                    <option value="<?= $user['id'] ?>"><?= $user['username'] ?></option>
                <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Catégorie</label>
            <select name="category_id">
                <?php foreach ($arrayVars['categories'] as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['fullname'] ?></option>
                <?php endforeach; ?>
            </select>
          </div>


          <div class="form-group">
            <label>Résumé de l'article</label>
            <input type="text" class="form-control" value="" name="summary">
          </div>


          <label class="label-article">Contenu de l'article</label>
          <div class="form-group">
            <textarea type="text" class="form-control" rows="13" name="content"></textarea>
          </div>

          <div class="form-group">
            <button type="submit" class="form-control">Envoyer</button>
          </div>
        <hr>
        </form>
    </div>
</main>
