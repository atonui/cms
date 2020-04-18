<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/cms/index">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                <?php
                        if (isset($_SESSION['user_role'])){
                            echo "<li>

                                <a href='/cms/profile.php'>Profile</a>

                            </li>";
                            if ($_SESSION['user_role'] == 'administrator'){
                                echo "<li>
                                    <a href=\"/cms/admin\">Admin</a>
                                  </li>";
                            }
                            if (isset($_GET['p_id'])){
                                $post_id = $_GET['p_id'];
                                echo "<li>
                                    <a href=\"/cms/admin/posts.php?source=edit_post&id=$post_id\">Edit Post</a>
                                  </li>";
                            }
                            echo "<li>
                                <a href=\"/cms/includes/logout\"><i class=\"fa fa-fw fa-power-off\"></i> Log Out</a>
                            </li>";
                        }else{
                            echo "<li>
                                <a href=\"/cms/registration\"><i class=\"fa fa-fw fa-user\"></i>Register Here</a>
                            </li>";
                        }
                ?>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>