<?php session_start(); ?>
<?php include('db.php');
include('../admin/functions.php');
?>


<?php

if (checkMethod('post')) {

    if (isset($_POST['login'])) {

        if (isset($_POST['username']) && isset($_POST['password'])) {

            login_user($_POST['username'], $_POST['password']);
        } else {


            redirect('/cms/');
        }
    }
}
















?>