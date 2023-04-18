<?php session_start(); ?>
<?php include('db.php');
include('../admin/functions.php');
?>


<?php

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
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
                redirect('../admin');
            } else {
                redirect('../index');
            }
        } else {
            redirect('../index');
        }
    } else {
        redirect('../index');
    }
}
















?>