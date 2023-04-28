<?php include('includes/header.php') ?>
<?php include('includes/navbar.php');
if(!isLoggedInAsAdmin()){
    redirect('index.php');
}; ?>

<div class="ps-3 pe-2 mt-2">

    <!-- Navigation -->

    <div id="page-wrapper">
        <h1>Comments</h1>
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

                        case 'post_comment';
                            include('includes/post_comments.php');

                            break;

                        default:
                            include('includes/view_all_comments.php');
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
        if (isset($_GET['delete'])) {

            $delete_comment_id = $_GET['delete'];
            $delete_comment_query = "Delete from comments where comment_id = {$delete_comment_id}";
            $delete_comment_query_execute = mysqli_query($connection, $delete_comment_query);
            redirect('comments.php');
        }

        if (isset($_GET['approve'])) {

            $approve_comment_id = $_GET['approve'];
            $approve_comment_query = "UPDATE comments set comment_status = 'approved' where comment_id = {$approve_comment_id}";
            $approve_comment_query_execute = mysqli_query($connection, $approve_comment_query);
            redirect('comments.php');
        }
        if (isset($_GET['disapprove'])) {

            $disapprove_comment_id = $_GET['disapprove'];
            $disapprove_comment_query = "UPDATE comments set comment_status = 'disapproved' where comment_id = {$disapprove_comment_id}";
            $disapprove_comment_query_execute = mysqli_query($connection, $disapprove_comment_query);
            redirect('comments.php');
        }


        ?>