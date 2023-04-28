<?php
include('includes/header.php') ?>
<?php include('includes/navbar.php') ?>

<main class="p-2">
    <div class="">

        <h1>Post</h1>

        <!-- Page Heading -->
        <div class="row ">
            <div class="col-lg-12">

                <?php
                if (isset($_GET['source'])) {
                    $source = $_GET['source'];
                } else {
                    $source = "";
                }
                switch ($source) {
                    case 'add_post';
                        include('includes/add_post.php');
                        break;
                    case 'edit_post';
                        include('includes/edit_post.php');

                        break;


                    default:
                        include('includes/view_all_posts.php');
                        break;
                }

                ?>
            </div>

        </div>
    </div>



</main>

<?php include('includes/footer.php') ?>
<?php
if (isset($_GET['delete'])) {

    $delete_post_id = $_GET['delete'];
    $username = $_SESSION['username'];
    $user_role = $_SESSION['user_role'];
    if (isLoggedInAsAdmin()) {
        $delete_post_query = "Delete from posts where post_id = {$delete_post_id}";
        $delete_post_query_execute = mysqli_query($connection, $delete_post_query);
        redirect('posts.php');
    } else {
        $delete_post_query = "Delete from posts where post_id = {$delete_post_id} and post_author = '{$username}' ";
        $delete_post_query_execute = mysqli_query($connection, $delete_post_query);
        redirect('posts.php');
        
    }

    $delete_post_query = "Delete from posts where post_id = {$delete_post_id}";
    $delete_post_query_execute = mysqli_query($connection, $delete_post_query);
    redirect('posts.php');
}
if (isset($_GET['reset'])) {

    $reset_view_post_id = $_GET['reset'];
    $reset_view_post_query = "UPDATE posts set post_views_count = 0 where post_id = {$reset_view_post_id}";
    $reset_view_post_query_execute = mysqli_query($connection, $reset_view_post_query);

    redirect('posts.php');
}


?>