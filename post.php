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
            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];
//                count the views on the post
                $views_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $post_id";
                $views_results = mysqli_query($connection, $views_query);

                confirmQuery($views_results);

                $sql = "SELECT * FROM posts WHERE post_id = $post_id";

                $results = mysqli_query($connection, $sql);
                while ($row = mysqli_fetch_assoc($results)) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_date = $row['post_date'];
                    $post_author_id = $row['post_author_id'];
                    $post_views = $row['post_views_count'];

                    ?>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="#"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author_posts.php?author_id=<?php echo $post_author_id; ?>"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?> </p>

                    <p><span class="glyphicon glyphicon-eye-open" style="color: #2e6da4"></span> <?php echo $post_views ?> </p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                    <hr>
                    <p> <?php echo $post_content ?> </p>
                    
                    <hr>

                <?php
                }
            }else{
                header('location:index.php');
            }
           // <!-- Comments Form -->

//            inserting comments to db
                if (isset($_POST['create_comment'])) {
                    $post_comment_id = cleanData($_GET['p_id']);
                    $comment_author = cleanData($_POST['comment_author']);
                    $comment_email = cleanData($_POST['comment_email']);
                    $comment_content = cleanData($_POST['comment_content']);

                    if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                        $post_comment_id = $_GET['p_id'];
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];

                        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

                            $sql = "INSERT INTO comments (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`) VALUES (NULL, $post_comment_id, '$comment_author','$comment_email','$comment_content')";

                            $results = mysqli_query($connection, $sql);

                            confirmQuery($results);

//                    query to increment the comment count in posts table every time a comment is posted
                            $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_comment_id ";

                            $queryResults = mysqli_query($connection, $query);

                            confirmQuery($queryResults);
                        } else {
                            echo "<script>alert('Fields Cannot be empty')</script>";
                        }
                    }
                }
                    ?>
                    <div class="well">
                        <h4>Leave a Comment:</h4>
                        <form role="form" action="" method="post">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" type="text" name="comment_author" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="email" name="comment_email" required>
                            </div>
                            <div class="form-group">
                                <label>Comment</label>
                                <textarea class="form-control" rows="3" name="comment_content" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                        </form>
                    </div>

                    <hr>

                    <!-- Posted Comments -->

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
                    }
                    ?>
                    </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php'; ?>

    </div>
    <!-- /.row -->

    <hr>
    <!-- Footer -->

<?php include 'includes/footer.php'; ?>