<?php include "includes/header.php"; ?>


<?php

if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

    header('location:./admin');
}
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    echo $password;

    $check_query = "SELECT * FROM users where username='{$username}'";
    $check_query_execute = mysqli_query($connection, $check_query);
    $check_query_result = mysqli_num_rows($check_query_execute);
    if ($check_query_result == 1) {
        $user = mysqli_fetch_assoc($check_query_execute);
        $user_role = $user['user_role'];
        $user_firstname = $user['user_firstname'];
        $user_lastname = $user['user_lastname'];
        $user_id = $user['user_id'];
        $user_password = $user['user_password'];
        if (password_verify($password, $user_password)) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_firstname'] = $user_firstname;
            $_SESSION['user_lastname'] = $user_lastname;
            $_SESSION['user_role'] = $user_role;

            if ($user_role === 'Admin') {
                header('location:./admin');
            }
            else{
                header('location:/cms/');

            }
        } else {
            header('location:/cms/login');
        }
    }
    else {
        header('location:/cms/login');
    }
}






?>



<!-- Navigation -->

<?php include "includes/navbar.php"; ?>


<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row d-flex  justify-content-center">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">


                            <h3><i class="fa fa-user fa-4x"></i></h3>
                            <h2 class="text-center">Login</h2>
                            <div class="panel-body">


                                <form id="login-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>

                                            <input name="username" type="text" class="form-control" placeholder="Enter Username">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                            <input name="password" type="password" class="form-control" placeholder="Enter Password">
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <input name="login" class="btn btn-lg btn-primary btn-block" value="Login" type="submit">
                                    </div>


                                </form>

                            </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <?php include "includes/footer.php"; ?>

</div> <!-- /.container -->