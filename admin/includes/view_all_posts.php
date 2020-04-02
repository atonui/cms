<table class="table table-hover table-responsive">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $posts_query = "SELECT * FROM `posts`";
        $results = mysqli_query($connection, $posts_query);

        while ($row = mysqli_fetch_assoc($results)) {
            $post_id = $row['post_id'];
            $post_category_id = $row['post_category_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_status = $row['post_status'];

            $select_category_query = "SELECT * FROM categories WHERE cat_id = '$post_category_id' ";

            $cat_results = mysqli_query($connection, $select_category_query);

            while ($rows = mysqli_fetch_assoc($cat_results)) {
                $cat_title = $rows['cat_title'];
            }

            echo "<tr>";
        ?>

            <td><?php echo $post_id ?></td>
            <td><?php echo $post_author ?></td>
            <td><?php echo $post_title ?></td>
            <td><?php echo $cat_title ?></td>
            <td><?php echo $post_status ?></td>
            <td><img width="100" class="img-responsive" src="../images/<?php echo $post_image ?>"></td>
            <td><?php echo $post_tags ?></td>
            <td><?php echo $post_comment_count ?></td>
            <td><?php echo $post_date ?></td>
            <td><a href="posts.php?source=edit_post&id=<?php echo $post_id ?>">Edit</a></td>
            <td><a href="posts.php?delete=<?php echo $post_id ?>">Delete</a></td>

        <?php
        }
        echo "</tr>";
        ?>
    </tbody>
</table>

<?php

//delete a post
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM posts WHERE post_id = $id";

    if (!mysqli_query($connection, $sql)) {
        die("Query failed " . mysqli_error($connection));
    } else {
//        delete all comments associated with the post
        $sql = "DELETE FROM comments WHERE comment_post_id = $id";
        $results = mysqli_query($connection, $sql);
        confirmQuery($results);
        header('location:posts.php');
    }
}
?>