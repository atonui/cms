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
