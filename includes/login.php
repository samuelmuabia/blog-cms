<?php session_start(); ?>
<?php include('db.php') ?>

<?php

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = mysqli_real_escape_string($connection , $username);
    $password = mysqli_real_escape_string($connection , $password);
    $select_rand_salt = "SELECT randSalt from users";
    $select_rand_salt_execute = mysqli_query($connection, $select_rand_salt);
    $select_rand_salt_results = mysqli_fetch_array($select_rand_salt_execute);
    $rand_salt = $select_rand_salt_results['randSalt'];
    // $password = password_hash($password,PASSWORD_BCRYPT, array('cost'=> 12));
    
    $check_query = "SELECT * FROM users where username='{$username}'";
    $check_query_execute = mysqli_query($connection,$check_query);
    $check_query_result = mysqli_num_rows($check_query_execute);
    if($check_query_result==1){
    $user = mysqli_fetch_assoc($check_query_execute);
    $user_role = $user['user_role'];
    $user_firstname = $user['user_firstname'];
    $user_lastname = $user['user_lastname'];
    $user_id = $user['user_id'];
    $user_password = $user['user_password'];

    if(password_verify($password,$user_password)){
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_firstname'] = $user_firstname;
        $_SESSION['user_lastname'] = $user_lastname;
        $_SESSION['user_role'] = $user_role;

        if($user_role==='Admin'){
            header('location:../admin');
        }

    }
    else{
        // header('location:../index.php');
    }
}
else{
    header('location:../index.php');
}
        
    
    
}
















?>