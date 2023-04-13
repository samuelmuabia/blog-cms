<?php include('includes/header.php'); ?>

<!-- Navigation -->
<?php include('includes/navbar.php'); ?>
<?php

if (isset($_POST['add_comment'])) {
    $post_id = $_GET['post_id'];

    $comment_author = $_POST['comment_author'];
    $comment_email = $_POST['comment_email'];
    $comment_content = $_POST['comment_content'];
    $comment_date = date("Y-m-d");

    $add_comment_query = "INSERT INTO `comments` ( `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES ( {$post_id}, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'disapproved', '{$comment_date}')";
    $add_comment_query_execute = mysqli_query($connection, $add_comment_query);

    $update_comment_count_query = "UPDATE posts set post_comment_count = post_comment_count +1 WHERE post_id = {$post_id}";
    $update_comment_count_query_exwcute = mysqli_query($connection, $update_comment_count_query);
}


?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">
            <?php
            $post_id = $_GET['post_id'];
            $post_author = $_GET['author_name'];
            $select_posts_query = "select * from posts where post_author= '{$post_author}'";
            $select_posts_results = mysqli_query($connection, $select_posts_query);
            while ($post = mysqli_fetch_assoc($select_posts_results)) {

                $post_id = $post['post_id'];
                $post_title = $post['post_title'];
                $post_author = $post['post_author'];
                $post_date = $post['post_date'];
                $post_image = $post['post_image'];
                $post_content = $post['post_content'];
                $post_title = $post['post_title'];
                $post_title = $post['post_title'];

            ?>
                <!-- Blog Post -->

                <!-- Title -->
                <h1><a class="text-decoration-none" href="/cms/post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h1>
                <!-- Author -->
                <p class="lead">
                    by <a class="text-decoration-none" href="/cms/author_post.php?author_name=<?php echo  $post_author ?>&author_id=<?php echo  $post_author_id ?>"><?php echo  $post_author ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo  $post_date ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-fluid" src="images/<?php echo  $post_image ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo  $post_content ?></p>


                <hr>
            <?php } ?>

            <!-- Blog Comments -->





            <!-- Side Widget Well -->

        </div>
        <?php include('includes/sidebar.php') ?>

    </div>
    <!-- /.row -->


    <!-- Footer -->
    <?php include('includes/footer.php') ?>