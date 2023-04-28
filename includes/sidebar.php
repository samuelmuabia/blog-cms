<?php


?>

<div class="col-md-4">

    <!-- Blog Search Well -->
    <!-- <div class="well">
        <h4>Blog Search</h4>
        <form action="./search.php" method="post">
            <div class="input-group">
                <input name="search-text" type="text" class="form-control">
                <span class="input-group-btn">
                    <input name="search" class="btn btn-primary" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                    
                </span>
            </div>
        </form>
    </div> -->
    <!-- /.input-group -->

    <div class="well">
        <?php
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $user_role = $_SESSION['user_role'];
            echo "<h2>Logged in as {$username}, <small>({$user_role})</small></h2>";
            echo "<a class='btn btn-primary mt-4 mb-2 me-3' href='./admin/posts.php'>Manage Posts</a>";
            echo "<a class='btn btn-warning mt-4 mb-2 ms-3' href='./admin/posts.php?source=add_post'>Add Post</a><br>";
            echo "<a class='btn btn-info mb-2' href='./admin'>Analytical Views</a><br>";
            echo "<a class='btn btn-danger' href='includes/logout.php'>Logout</a>";
        } else {
        ?>
            <h4>Login</h4>
            <form class="text-center" action="/cms/includes/login.php" method="post">
                <div class="form-group mb-3">
                    <input name="username" placeholder="Enter Your Username" type="text" class="form-control">
                </div>
                <div class="form-group mb-1">
                    <input name="password" placeholder="Enter Your Password" type="password" class="form-control">
                </div>

                <div class="form-group mb-2">
                    <a href="/cms/forgot.php?forgot=<?php echo uniqid(true) ?>">Forgot Password?</a>
                </div>
                <input  name="login" class="btn btn-primary" type="submit" value="Login">
            </form>
        <?php
        }
        ?>

        <!-- /.input-group -->
    </div>
    <!-- Blog Categories Well -->
    <div class="well mt-5">
        <h4>Blog Categories</h4>

        <div class="row">
            <div class="col-lg-12 ">
                <ul class="list-unstyled">
                    <?php

                    $select_categories_query = "select * from categories";
                    $select_categories_results = mysqli_query($connection, $select_categories_query);
                    while ($row = mysqli_fetch_assoc($select_categories_results)) {
                        $category_id = $row['cat_id'];
                        $category_title = $row['cat_title'];
                        echo "<li><a class='text-decoration-none' href='/cms/category/{$category_id}'>{$category_title}</a></li>";
                    }


                    ?>
                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>



</div>