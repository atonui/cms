<div class="col-md-4">
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>


                <!-- Login Form -->
                <div class="well">
                    <h4>Login</h4>
                    <form action="./login.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username">
                        </div>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" placeholder="Password">

                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit" name="login">Login</button>
                        </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->

                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php
                                $sql = "SELECT * FROM categories";
                                $results = mysqli_query($connection, $sql);

                                    while($row = mysqli_fetch_assoc($results)){
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                        echo "<li>
                                                <a href='/cms/category/$cat_id'>$cat_title</a>
                                            </li>";
                                    }
                                ?>
                            </ul>
                        </div>
                     
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
<!--                --><?php //include 'widget.php'; ?>

            </div>