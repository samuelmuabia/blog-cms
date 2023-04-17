<?php include('includes/header.php') ?>
<!-- Navigation -->
<?php include('includes/navbar.php') ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            
            <?php
            if (isset($_GET['category_id'])) {
                $category_id = $_GET['category_id'];

                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {
                    $stmt1 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ?");
                } else {
                    $stmt2 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image,post_content FROM posts WHERE post_category_id = ? AND post_status = ? ");
                    $published = 'published';
                    // $select_posts_query = "select * from posts where post_category_id={$category_id} and post_status='pubLished'";
                    // $select_posts_results = mysqli_query($connection, $select_posts_query);
                }
                if(isset($stmt1)){
                    mysqli_stmt_bind_param($stmt1,'i',$category_id);
                    mysqli_stmt_execute($stmt1);
                    mysqli_stmt_bind_result($stmt1,$post_id,$post_title,$post_author,$post_date,$post_image,$post_content);
                    $stmt = $stmt1;
                    mysqli_stmt_store_result($stmt);
                }
                else{
                    mysqli_stmt_bind_param($stmt2,'is',$category_id,$published);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2,$post_id,$post_title,$post_author,$post_date,$post_image,$post_content);
                    $stmt = $stmt2;
                    mysqli_stmt_store_result($stmt);

                }

                //error
                
                if(mysqli_stmt_num_rows($stmt)===0){
                    echo "<h1>No Posts are available in this category</h1>";
                }
                else{
                    while (mysqli_stmt_fetch($stmt)) :
                
                
                    
            ?>
                    <h2>
                        <a class="text-decoration-none" href="/cms/post/<?php echo $post_id ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                    by <a class="text-decoration-none" href="/cms/author_post.php?author_name=<?php echo  $post_author ?>&post_id=<?php echo  $post_id ?>"><?php echo  $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                    <hr>
                    <a href="post.php?post_id=<?php echo $post_id ?>"><img class="img-fluid" src="/cms/images/<?php echo $post_image ?>" alt=""></a>
                    <hr>
                    <p><?php echo $post_content ?></p>
                    <a class="btn btn-primary" href="/cms/post.php?post_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
            <?php
                endwhile;
            }}
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