<?php
if (isset($_POST['create_post'])) {
    $post_title = $_POST['title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');

    $sql = "INSERT INTO posts (post_id, post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES (NULL,$post_category_id,'$post_title','$post_author',now(),'$post_image','$post_content','$post_tags', 0, '$post_status')";

    if (!mysqli_query($connection, $sql)) {
        die("Query failed ". mysqli_error($connection));
    } else {
        move_uploaded_file($post_image_temp, "../images/$post_image");
    }
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <select name="post_category" id="">
            <?php
            $select_query = "SELECT * FROM categories";

            $results = mysqli_query($connection, $select_query);

            confirmQuery($results);

            while ($row = mysqli_fetch_assoc($results)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo " <option value=\"$cat_id\">$cat_title</option>";

            }
            ?>

        </select>
    </div>
    <div class="form-group">
        <label>Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label>Post Status</label><br>
        <select name="post_status">
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
<!--        <input type="text" class="form-control" name="post_status">-->
    </div>
    <div class="form-group">
        <label>Post Image</label>
        <input type="file" class="form-control" name="post_image">
    </div>
    <div class="form-group">
        <label>Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label>Post Content</label>
        <textarea class="form-control" name="post_content" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>