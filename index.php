<?php include('includes/header.php') ?>
<!-- Navigation -->
<?php include('includes/navbar.php') ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Latest Posts
            </h1>
            <?php
            $page_number = 1;
            if (isset($_GET['page'])) {
                $page_number = $_GET['page'];
                $current_page = $page_number;
            } else {
                $current_page = 1;
            }
            $number_of_posts_per_page = 2;
            $limit = $current_page * $number_of_posts_per_page - $number_of_posts_per_page;
            $select_posts_query = "SELECT * from posts where post_status='published' order by post_id DESC limit {$limit},{$number_of_posts_per_page} ";
            $select_posts_results = mysqli_query($connection, $select_posts_query);
            $number_of_posts_query = "SELECT * from posts where post_status='published'";
            $number_of_posts_results = mysqli_query($connection, $number_of_posts_query);

            $number_of_posts = mysqli_num_rows($number_of_posts_results);
            $pages = ceil($number_of_posts / $number_of_posts_per_page);
            while ($post = mysqli_fetch_assoc($select_posts_results)) {
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
            ?>
            <!-- First Blog Post -->


            <!-- Pager -->
            <div class="d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php
                        if ($current_page == 1) {?>
<?php 
                            echo   "<li class='page-item disabled' >
                    <a class='page-link' href=''>&larr; Newer </a>
                </li>";
                        } else {
                            $previous_page = $current_page - 1;
                            echo   "<li class='page-item' >
                    <a  class='page-link' href='/cms/index/{$previous_page}'>&larr; Newer </a></li>";
                        }

                        for ($i = 1; $i <= $pages; $i++) {
                            if ($i == $page_number) {
                                echo   "<li class='page-item active' >
                    <a class='page-link' href='/cms/index/{$i}'>{$i} </a>
                </li>";
                            } else {
                                echo   "<li class='page-item' >
                        <a class='page-link' href='/cms/index/{$i}'>{$i} </a>
                    </li>";
                            }
                        }
                        if ($current_page == $pages) {
                            echo   "<li class='page-item disabled' >
                    <a  class='page-link' href='#'>Older &rarr;</a>
                </li>";
                        } else {
                            $next_page = $current_page + 1;

                            echo   "<li class='page-item' >
                    <a class='page-link' href='/cms/{$next_page}'>Older &rarr;</a>
                </li>";
                        }



                        ?>
                        
                    </ul>
                </nav>
            </div>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include('includes/sidebar.php') ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>
