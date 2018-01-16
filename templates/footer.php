    <footer class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul class="list-inline">
                    <li><i class="fa fa-twitter" aria-hidden="true"></i></li>
                    <li><i class="fa fa-facebook" aria-hidden="true"></i></li>
                    <li><i class="fa fa-github" aria-hidden="true"></i></li>
                </ul>
                <p>Copyright &copy; A la dérive 2017 - <a href="<?php echo $this->router->generate('admin') ?>">Admin</a></p>
            </div>
        </div>
    </footer>

    <!-- inclusion de JQuery via le CDN, utilisé par Boostrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" charset="utf-8"></script>
    <!-- inclusion des JS de Bootstrap -->
    <script src="<?php echo BASE_URL ?>/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
</body>
</html>
