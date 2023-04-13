<nav class="navbar navbar-expand-lg fixed-top bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/cms/index">Blogs</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <?php
                $category_class = '';
                $registration_class = '';
                $contact_class = '';
                $home_class = '';
                $pageName = basename($_SERVER['PHP_SELF']);
                $registration = 'registration.php';
                $contact = 'contact.php';
                $home = 'index.php';


                $select_categories_query = "select * from categories";
                $select_categories_results = mysqli_query($connection, $select_categories_query);
                while ($row = mysqli_fetch_assoc($select_categories_results)) {
                    $category_title = $row['cat_title'];
                    $category_id = $row['cat_id'];
                    if (isset($_GET['category_id']) && $_GET['category_id'] == $category_id) {
                        $category_class = 'active';
                    } else {
                        $category_class = '';
                    }
                    echo "<li class='nav-item'><a class='nav-link {$category_class}' href='/cms/category/{$category_id}'>{$category_title}</a></li>";
                }

                if (isset($_SESSION['user_role'])) {
                    if ($_SESSION['user_role'] !== 'Admin') {
                        echo " <li class='nav-item'><a class='nav-link' href='admin/posts.php'>Edit Posts</a></li>";
                    }
                }
                if (isset($_SESSION['user_id'])) {

                    $user_role = $_SESSION['user_role'];
                    if ($user_role == 'Admin') {
              
              echo "<li class='nav-item' ><a class='nav-link' href='/cms/admin'>Admin</a></li>";
                        echo " <li class='nav-item'><a class='nav-link' href='/cms/admin/posts.php'>Manage Posts</a></li>";
                        if (isset($_GET['post_id'])) {
                            $post_id = $_GET['post_id'];
                            echo " <li class='nav-item'><a class='nav-link' href='/cms/admin/posts.php?source=edit_post&edit={$post_id}'>Edit Post</a></li>";
                        }
                    }
                }
                else{
                    echo "<li class='nav-item' ><a class='nav-link disabled' href='/cms/admin'>Admin</a></li>";

                }
                if ($pageName == $registration) {
                    $registration_class = 'active';
                } else if ($pageName == $contact) {
                    $contact_class = 'active';
                } else if ($pageName == $home) {
                    $home_class = 'active';
                }
                ?>
              <li class="nav-item "><a class="nav-link <?php echo $registration_class ?>" href='/cms/registration'>Registration</a></li>
              <li class="nav-item "><a class="nav-link <?php echo $contact_class ?>" href='/cms/contact'>Contact</a></li>

            </ul>
            <form class="d-flex" role="search" action="./search.php" method="post">
                <input name="search-text" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" name="search" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
<!-- 
