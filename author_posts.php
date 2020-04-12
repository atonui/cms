<?php
include 'includes/header.php';
include 'includes/db.php';
include './admin/functions.php'

?>
    <!-- Navigation -->
<?php include 'includes/navigation.php'; ?>

    <!-- Page Content -->
    <div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
            if (isset($_GET['author_id'])) {
                $author_id = $_GET['author_id'];


                $sql = "SELECT * FROM posts WHERE post_author_id = $author_id ORDER BY post_id DESC";

                $results = mysqli_query($connection, $sql);
                while ($row = mysqli_fetch_assoc($results)) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_date = $row['post_date'];
                    $post_id = $row['post_id'];

                    ?>

                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author_posts.php?author_id=<?php echo $author_id; ?>"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?> </p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                    <hr>
                    <p> <?php echo $post_content ?> </p>

                    <hr>

                    <?php
                }
            }
            ?>

            <?php
            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];

                $sql = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'Approved' ORDER BY comment_id DESC ";

                $results = mysqli_query($connection, $sql);
                confirmQuery($results);

                while ($row = mysqli_fetch_assoc($results)) {
                    $comment_author = $row['comment_author'];
                    $comment_content = $row['comment_content'];
                    $comment_date = $row['comment_date'];

                    ?>

                    <!-- Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author ?>
                                <small><?php echo $comment_date ?></small>
                            </h4>

                            <?php echo $comment_content; ?>
                        </div>
                    </div>

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