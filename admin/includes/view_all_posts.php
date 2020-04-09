<form action="" method="post">
<table class="table table-hover table-responsive">
    <div id="bulkOptionsContainer" class="col-xs-4">
        <select name="bulk_options" id="" class="form-control">
            <option value="">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
        </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a href="posts.php?source=add_post" class="btn btn-primary">Add New Post</a>
    </div>
    <thead>
        <tr>
            <th><input type="checkbox" id="selectAllBoxes"></th>
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

            <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $post_id ?>"></td>
            <td><?php echo $post_author ?></td>
            <td><a href='../post.php?p_id=<?php echo $post_id ?>'><?php echo $post_title ?></a></td>
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
</form>

<?php

//delete a post
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    deletePosts($id);
}

if (isset($_POST['checkBoxArray'])){
    foreach ($_POST['checkBoxArray'] as $postValueId){
        $bulk_options = $_POST['bulk_options'];
        switch ($bulk_options){
            case 'published':
                $query = "UPDATE posts SET post_status = 'published' WHERE post_id = $postValueId";
                $results = mysqli_query($connection, $query);
                confirmQuery($results);
                header('location:posts.php');
                break;
            case 'draft':
                $draft_query = "UPDATE posts SET post_status = 'draft' WHERE post_id = $postValueId";
                $results = mysqli_query($connection, $draft_query);
                confirmQuery($results);
                header('location:posts.php');
                break;
            case 'delete':
               deletePosts($postValueId);
                break;

        }
    }
}
?>