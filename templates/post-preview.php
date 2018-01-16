
            <!-- post preview -->

            <div class="post-preview">
                <a href="<?php echo $this->router->generate('article', array('id' => $post['id'])); ?>">
                    <h2><?php echo $post['title'] ?></h2>
                    <h3><?php echo $post['summary'] ?></h3>
                </a>
                <p>Posté par <a href="#"><?php echo $post['username'] ?></a> le <?php echo date("d-m-Y", strtotime($post['date_created'])) ?> dans <a href="#">#<?php echo $post['fullname'] ?></a></p>
            </div><!-- /.post-preview -->
            
