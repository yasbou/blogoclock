<main class="container">
    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            <?php foreach ($arrayVars['posts'] as $post): ?>

                <?php  include 'post-preview.php'; ?>

                <hr>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<hr>
