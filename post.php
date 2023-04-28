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
            $view_update_query = "UPDATE posts set post_views_count = post_views_count+1 where post_id = {$post_id}";
            $view_update_query_execute = mysqli_query($connection, $view_update_query);
            $select_posts_query = "select * from posts where post_id = {$post_id}";
            $select_posts_results = mysqli_query($connection, $select_posts_query);
            $post = mysqli_fetch_assoc($select_posts_results);
            $post_title = $post['post_title'];
            $post_author = $post['post_author'];
            $post_date = $post['post_date'];
            $post_image = $post['post_image'];
            $post_content = $post['post_content'];
            $post_title = $post['post_title'];
            $post_title = $post['post_title'];
            // Construct the URL of the current page
            $base_url = 'http://127.0.0.1';
            $current_url = $base_url . $_SERVER['REQUEST_URI'];

            // Encode the URL for use in the share link
            $encoded_url = urlencode($current_url);

            // Fetch the image URL and description from the database (example only)
            $current_post_image_url = 'http://example.com/image.jpg';
            $current_post_description = 'Check out this awesome post!';

            // Encode the image URL and description for use in the share link
            $encoded_image_url = urlencode($current_post_image_url);
            $encoded_description = urlencode($current_post_description);
            $current_post_title = $post_title;
            $current_post_text = $current_post_title . ' ' . $current_url;
            $encoded_text = urlencode($current_post_text);
            ?>


            <!-- Blog Post -->

            <!-- Title -->
            <h1><a class="text-decoration-none" href="/cms/post/<?php echo $post_id ?>"><?php echo $post_title ?></a>
            </h1>

            <!-- Author -->
            <div class="row row-cols-2">
                <p class="lead">
                    by <a class="text-decoration-none" href="/cms/author_post.php?author_name=<?php echo $post_author ?>&post_id=<?php echo $post_id ?>"><?php echo $post_author ?></a>
                </p>
                <div>
                    Share This Post Via
                    <div class="row row-cols-5 g-1">
                        <a class="btn icons" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $encoded_url; ?>"><img src="/cms/images/icons/facebook.png" alt=""></a>
                        <a class="btn icons" href="https://twitter.com/intent/tweet?url=<?php echo $encoded_url; ?>"><img src="/cms/images/icons/twitter.png" alt=""></a>
                        <a class="btn icons " href="https://wa.me/?text=<?php echo $encoded_text; ?>"><img src="/cms/images/icons/whatsapp.png" alt=""></a>

                        <a class="btn icons" href="mailto:?subject=Check out this post&amp;body=<?php echo $encoded_url; ?>"><img src="/cms/images/icons/gmail.png" alt=""></a>

                        <a class="btn icons" href="https://pinterest.com/pin/create/button/?url=<?php echo $encoded_url; ?>&amp;media=<?php echo $encoded_image_url; ?>&amp;description=<?php echo $encoded_description; ?>"><img src="/cms/images/icons/pinterest.png" alt=""></a>
                    </div>
                </div>
            </div>


            <hr>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on
                <?php echo $post_date ?>
            </p>

            <hr>

            <!-- Preview Image -->
            <img class="img-fluid" src="/cms/images/<?php echo $post_image ?>" alt="">

            <hr>

            <!-- Post Content -->
            <p class="lead">
                <?php echo $post_content ?>
            </p>

            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            <h4>Leave a Comment:</h4>
            <div class="well">
                <form role="form" action="" method="POST">
                    <div class="form-group">
                        <label for="comment_author">Name</label>
                        <input type="text" class="form-control" name="comment_author" id="comment_author" required>
                    </div>
                    <div class="form-group">
                        <label for="comment_email">Email</label>
                        <input type="email" class="form-control" name="comment_email" id="comment_email" required>
                    </div>
                    <div class="form-group">
                        <label for="comment_content">Comment</label>
                        <textarea class="form-control" name="comment_content" rows="3" required></textarea>
                    </div>
                    <button type="submit" name="add_comment" class="btn btn-primary">Add Comment</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            <?php
            $post_id = $_GET['post_id'];
            $select_comments_query = "select * from comments where comment_post_id = {$post_id} and comment_status='approved' ORDER BY comment_id DESC";
            $select_comments_results = mysqli_query($connection, $select_comments_query);
            while ($comment = mysqli_fetch_assoc($select_comments_results)) {
                $comment_author = $comment['comment_author'];
                $comment_content = $comment['comment_content'];
                $comment_date = $comment['comment_date'];
            ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <?php echo $comment_author ?>
                            <small>
                                <?php echo $comment_date ?>
                            </small>
                        </h4>
                        <p>
                            <?php echo $comment_content ?>
                        </p>
                    </div>
                </div>
            <?php
            } ?>


            <!-- Comment -->


        </div>
        <?php include('includes/sidebar.php') ?>
        <hr>
        <?php include "includes/footer.php"; ?>