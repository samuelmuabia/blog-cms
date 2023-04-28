<?php include('includes/header.php') ?>
<!-- Navigation -->
<?php include('includes/navbar.php') ?>

<!-- Page Content -->
<div class="container">

    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            if (isset($_POST['search'])) {
                $searched_text = $_POST['search-text'];
                if($searched_text==''){
                   redirect('index');

                }
                else{
                $search_query = "select * from posts where post_tags LIKE '%$searched_text%'";
                $search_query_results = mysqli_query($connection, $search_query);
                $number_of_posts = mysqli_num_rows($search_query_results);
                if ($number_of_posts == 0) {
                    echo "<h1>No Results Found</h1>";
                } else {
                    echo "<h1>{$number_of_posts} Results Found</h1>";
                    while ($post = mysqli_fetch_assoc($search_query_results)) {
                        $post_id = $post['post_id'];
                        $post_title = $post['post_title'];
                        $post_author = $post['post_author'];
                        $post_date = $post['post_date'];
                        $post_image = $post['post_image'];
                        $post_content = substr($post['post_content'], 0, 100);
                        $post_title = $post['post_title'];
            ?>
                        <h2>
                            <a class="text-decoration-none" href="/cms/post/<?php echo $post_id ?>"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a class="text-decoration-none" href="/cms/author_post.php?author_name=<?php echo  $post_author ?>&post_id=<?php echo  $post_id ?>"><?php echo  $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                        <hr>
                        <a href="post/<?php echo $post_id ?>"><img class="img-fluid" src="/cms/images/<?php echo $post_image ?>" alt=""></a>

                        <hr>
                        <p><?php echo $post_content ?></p>
                        <a class="btn btn-primary" href="post/<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
            <?php
                    }
                }
            } }else {
                redirect('/cms/');
            }
            ?>

            <!-- First Blog Post -->




        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include('includes/sidebar.php') ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include('includes/footer.php') ?>