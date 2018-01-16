<main class="container">
    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1">

            <div class="category-title">
                <h2>Admin</h2>
            </div>

            <div class="row">

                <div class="col-sm-3">

                    <div class="panel panel-default">
                      <!-- Default panel contents -->
                      <div class="panel-heading">Utilisateurs</div>
                      <!-- List group -->
                      <ul class="list-group">
                          <?php foreach ($arrayVars['users'] as $user): ?>


                              <li class="list-group-item"><?= ucfirst($user['username']) ?></li>

                        <?php endforeach; ?>
                      </ul>
                    </div>

                    <div class="panel panel-default">
                      <!-- Default panel contents -->
                      <div class="panel-heading">Catégories</div>
                      <!-- List group -->
                      <ul class="list-group">
                          <?php foreach ($arrayVars['categories'] as $categorie): ?>


                              <li class="list-group-item">#<?= $categorie['fullname'] ?></li>

                        <?php endforeach; ?>

                      </ul>
                    </div>

                </div>

                <div class="col-sm-9">

                    <h2>POSTS</h2>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Author</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                          <?php foreach ($arrayVars['posts'] as $post): ?>

                            <tr>
                                <td><?= $post['id'] ?></td>
                                <td><?= $post['title'] ?></td>
                                <td><?php echo date("d-m-Y", strtotime($post['date_created'])) ?></td>
                                <td><?= $post['username'] ?> </td>
                                <td><a href="<?php echo $this->router->generate('edit', array('id' => $post['id']));  ?>"><button type="button" class="btn btn-info">Edit</button></a></td>
                                <td><a href="<?php echo $this->router->generate('delete', array('id' => $post['id']));  ?>"><button type="button" class="btn btn-danger">Delete</button></a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-xs-12">
                    <a href="<?php echo $this->router->generate('admin_faker_users') ?>" class="btn btn-danger">Faker des users</a>
                    <a href="<?php echo $this->router->generate('admin_faker_posts') ?>" class="btn btn-danger">Faker des posts</a>
                </div>

            </div>

        </div>

    </div>
</main>
<hr>
