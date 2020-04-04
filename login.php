<?php

require 'includes/db.php';

session_start();

if (isset($_POST['login'])){

    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);


    $sql = "SELECT * FROM users WHERE username = '$username' ";

    $results = mysqli_query($connection, $sql);

    while ($row = mysqli_fetch_assoc($results)) {
        $user_id = $row['user_id'];
        $firstname = $row['user_firstname'];
        $lastname = $row['user_lastname'];
        $email = $row['user_email'];
        $role = $row['role'];
        $user_image = $row['user_image'];
        $password_hash = $row['user_password'];
    }

    if (password_verify($password,$password_hash)){ //if passwords match, login user
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_role'] = $role;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        header('location:./admin');
    }else{
        header('location:index.php');
    }


}


?>