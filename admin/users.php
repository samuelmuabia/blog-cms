<?php  include('includes/header.php') ?>
<?php include('includes/navbar.php');
if(!isLoggedInAsAdmin()){
    redirect('index.php');
} ?>

<div class="ps-3 pe-3 mt-2">

    <!-- Navigation -->
    <h1>Users</h1>
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <?php
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = "";
                    }
                    switch ($source) {
                        case 'add_user';
                            include('includes/add_user.php');
                            break;
                        case 'edit_user';
                            include('includes/edit_user.php');

                            break;
                        case '33';
                            echo 'hello 33';
                            break;
                        default:
                            include('includes/view_all_users.php');
                            break;
                    }

                    ?>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include('includes/footer.php') ?>

        <?php

        if (isLoggedInAsAdmin()) {
            if (isset($_GET['delete'])) {

                $delete_user_id = $_GET['delete'];
                $delete_user_query = "Delete from users where user_id = {$delete_user_id}";
                $delete_user_query_execute = mysqli_query($connection, $delete_user_query);
                redirect('users.php');
            }
        }


        if (isset($_GET['admin'])) {

            $change_role_user_id = $_GET['admin'];
            $change_role_query = "UPDATE users set user_role = 'Admin' where user_id = {$change_role_user_id}";
            $change_role_query_execute = mysqli_query($connection, $change_role_query);
            redirect('users.php');
        }
        if (isset($_GET['subscriber'])) {

            $change_role_user_id = $_GET['subscriber'];
            $change_role_query = "UPDATE users set user_role = 'Subscriber' where user_id = {$change_role_user_id}";
            $change_role_query_execute = mysqli_query($connection, $change_role_query);
            redirect('users.php');
        }



        ?>