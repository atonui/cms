<?php
    include "includes/db.php";
    include "includes/header.php";
    include "admin/functions.php";
    //Navigation
    
    include "includes/navigation.php";

    $username_err = $email_err = $password_err = $confirm_password_err = $firstname_err = $lasttname_err = $password_text = '';

    if (isset($_POST['submit'])){
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];


        if (isset($_POST['username'])){
            $username = cleanData($_POST['username']);
        }else{
            $username_err = 'Please fill in this field';
        }if (isset($_POST['firstname'])){
            $firstname = cleanData($_POST['firstname']);
        }else{
            $firstname_err = 'Please fill in this field';
        }if (isset($_POST['lastname'])){
            $lastname = cleanData($_POST['lastname']);
        }else{
            $lasttname_err = 'Please fill in this field';
        }
        if (isset($_POST['email'])){
            $email = cleanData($_POST['email']);//add regex to check email validity?
        }else{
            $email_err = 'Please fill in this field';
        }
        if (isset($_POST['password'])){
            $password = $_POST['password'];
        }else{
            $password_err = 'Please fill in this field';
        }
        if (isset($_POST['confirm_password'])){
            $confirm_password = $_POST['confirm_password'];
        }else{
            $confirm_password_err = 'Please fill in this field';
        }
        if (!empty(passwordChecker($password,$confirm_password))){
            $password_err = passwordChecker($password,$confirm_password);
        }else {
            //check if user is already registered
            $sql = "SELECT * FROM users WHERE user_email = '$email'";//make usernames unique too?
            $results = mysqli_query($connection,$sql);
            if (mysqli_num_rows($results) > 0){
                //this means that the user already exists so redirect to login
                header('location:index.php?msg=registered');//provide a way to let the user know that they're already registered so they should just login
                exit();
            }else {
//        hash the password
                $password = passwordHash($password);

                $sql = "INSERT INTO users (username, user_password, user_firstname, user_lastname, user_email, date_created) VALUES ('$username', '$password', '$firstname', '$lastname', '$email', CURRENT_TIMESTAMP )";
                if (mysqli_query($connection, $sql)) {
                    header('location:index.php?msg=inserted');
                } else {
                    echo "User not added: " . mysqli_error($connection);
                }
            }
        }
    }

    ?>
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <small style="color: orangered!important;" class="text-muted"><?php echo $username_err?></small>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label for="username" class="sr-only">First Name</label>
                            <small style="color: orangered!important;" class="text-muted"><?php echo $firstname_err?></small>
                            <input type="text" name="firstname" id="username" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="form-group">
                            <label for="username" class="sr-only">Last Name</label>
                            <small style="color: orangered!important;" class="text-muted"><?php echo $lasttname_err?></small>
                            <input type="text" name="lastname" id="username" class="form-control" placeholder="Last Name" required>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                             <small style="color: orangered!important;" class="text-muted"><?php echo $email_err?></small>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                             <small style="color: orangered!important;" class="text-muted"><?php echo $password_err?></small>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Confirm Password</label>
                            <small style="color: orangered!important;" class="text-muted"><?php echo $confirm_password_err ?></small>
                            <input type="password" name="confirm_password" id="key" class="form-control" placeholder="Confirm Password" required>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-info btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
