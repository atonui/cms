<?php
    include 'includes/header.php';
    include 'includes/db.php';

    //Navigation
    include 'includes/navigation.php';

    if (isset($_GET['msg'])){
        $message = $_GET['msg'];
        if ($message == 'registered'){
            echo "<p class='alert alert-success'>Your already registered, please login here!</p>";
        }
        if ($message == 'inserted'){
            echo "<p class='alert alert-success'>Your have been registered, please login here!</p>";
        }
    }

    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
                A Blog About My Journey to Being a Developer
                    <small>I also write other random stuff in here</small>
                </h1>

            <?php
                $sql = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC";

                $results = mysqli_query($connection, $sql);

                if (mysqli_num_rows($results) < 1){
                    echo "<h1 class='centered'>No posts yet, come back later!</h1>";

                }else {
                    while ($row = mysqli_fetch_assoc($results)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'], 0, 100);
                        $post_date = $row['post_date'];
                        $post_author_id = $row['post_author_id'];
                        $post_views = $row['post_views_count'];

                        ?>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="author_posts.php?author_id=<?php echo $post_author_id; ?>"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?> </p>
                        <p><span class="glyphicon glyphicon-eye-open" style="color: #2e6da4"></span> <?php echo $post_views ?> </p>
                        <hr>
                        <a href="post.php?p_id=<?php echo $post_id; ?>">
                            <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                        </a>
                        <hr>
                        <p> <?php echo $post_content ?> </p>
                        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span
                                class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>


                        <?php
                    }
                }?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php';?>

        </div>
        <!-- /.row -->

        <hr>
        <!-- Footer -->

<?php include 'includes/footer.php';