<?php
function insertCategory(){

    global $connection;
    if(isset($_POST['add_category'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" or empty($cat_title)){
            echo "<small style='color:red;'>* Please enter a category</small>";
        }else{
            $sql = "INSERT INTO `categories`(`cat_id`, `cat_title`) VALUES (NULL,'$cat_title')";
            $result = mysqli_query($connection, $sql);
            if(!$result){
                die('Query failed'. mysqli_error($connection));
            }
        }

    }

}

function findAllCategories(){
    global $connection;

    $sql = "SELECT * FROM categories";
    $results = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_assoc($results)){
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
        echo "<tr>";
        echo "<td>$cat_id</td>";
        echo "<td>$cat_title</td>";
        echo "<td><a href='categories.php?delete=$cat_id'>Delete</a></td>";
        echo "<td><a href='categories.php?update=$cat_id'>Edit</a></td>";

        echo "</tr>";
    }
}

function deleteCategories(){
    global $connection;
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $delete_query = "DELETE FROM `categories` WHERE cat_id = '$id'";

        mysqli_query($connection,$delete_query);

        header('location:categories.php');
    }
}

function confirmQuery($result){
    global $connection;
    if(!$result){
        die("Query failed ".mysqli_error($connection));
    }
}

function deletePosts($post_id){
    global $connection;
    $delete_query = "DELETE FROM posts WHERE post_id = $post_id";
    if (!mysqli_query($connection, $delete_query)) {
        die("Query failed " . mysqli_error($connection));
    } else {
//        delete all comments associated with the post
        $delete_comment = "DELETE FROM comments WHERE comment_post_id = $post_id";
        $results = mysqli_query($connection, $delete_comment);
        confirmQuery($results);
        header('location:posts.php');
    }
}

function cleanData($data){
    global $connection;

    //$data = strtolower($data);
    //$data = stripslashes($data);
    //$data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($connection, $data); // escapes special characters usually used for SQL statements, it helps prevent sql injections

    return $data;
}

//function to verify password strength and matches
function passwordChecker($password, $confirm_password){
    $password_err ='';
    if ($password != $confirm_password) {
        $password_err = 'Oops! Your passwords do not seem to match';
    } elseif (strlen($password) < 8) {
        $password_err = 'Your password is less than 8 characters';

        //check for password strength using regex
    } elseif (!(preg_match('/[\'^£$!%&*()}{@#~?><>,|=_+¬-]/', $password))) { //regex pattern to check if password contains special characters
        $password_err = 'Your password does not contain any special characters';
    }
    return $password_err;
}

//function to securely hash passwords
function passwordHash($password){
    $password = password_hash($password, PASSWORD_DEFAULT);
    return $password;
}
