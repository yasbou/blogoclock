<main class="container">
    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            <!-- article -->
            <?php $post = $arrayVars['post']; ?>
            <?php include 'post-preview.php' ?>
            <p><?= $post['content'] ?></p>
            <hr>
        </div>
    </div>
</main>
<hr>
