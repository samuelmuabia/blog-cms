<?php
if (isset($_GET['edit'])) {
    $edit_post_id = $_GET['edit'];
    $username = $_SESSION['username'];
    echo $username;
    $user_role = $_SESSION['user_role'];
    if(isLoggedInAsAdmin()){
        $search_post_query = "select * from posts where post_id ={$edit_post_id}";
        $search_post_query_execute = mysqli_query($connection, $search_post_query);
        $search_post_query_results = mysqli_fetch_assoc($search_post_query_execute);
    }
    else{
        $search_post_query = "SELECT * from posts where post_id ={$edit_post_id} and post_author = '{$username}' ";
        $search_post_query_execute = mysqli_query($connection, $search_post_query);
        $search_post_query_results = mysqli_num_rows($search_post_query_execute);
        if($search_post_query_results==0){
            redirect('posts.php');
        }
        else{
            $search_post_query_results = mysqli_fetch_assoc($search_post_query_execute);

        }

    }

    $post_title = $search_post_query_results['post_title'];
    $post_author = $search_post_query_results['post_author'];
    $post_content = $search_post_query_results['post_content'];
    $post_category_id = $search_post_query_results['post_category_id'];
    $post_status = $search_post_query_results['post_status'];
    $post_image = $search_post_query_results['post_image'];
    $post_tags = $search_post_query_results['post_tags'];
    $post_title = $search_post_query_results['post_title'];
    $post_date = $search_post_query_results['post_date'];
}
// neeed too checkk
if (isset($_POST['update_post'])) {
    $update_post_id = $_GET['edit'];
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_content = $_POST['post_content'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_title = $_POST['post_title'];
    $post_comment_count = 4;
    $post_date = date('Y-m-d');
    move_uploaded_file($post_image_temp, "../images/{$post_image}");
    if (empty($post_image)) {
        $image_query = "select `post_image` from posts where `post_id`= {$update_post_id}";
        $image_query_execute = mysqli_query($connection, $image_query);
        $image_query_results = mysqli_fetch_assoc($image_query_execute);
        $post_image = $image_query_results['post_image'];
    }
    $update_post_query = "update `posts` set `post_category_id`= {$post_category_id}, `post_title`='{$post_title}', `post_author`='{$post_author}', `post_date`= '{$post_date}' , `post_image`='{$post_image}', `post_content`='{$post_content}', `post_tags`='{$post_tags}', `post_status`='{$post_status}' where post_id={$update_post_id}";

    $update_post_query_execute = mysqli_query($connection, $update_post_query);
    ?>
    <div class="alert alert-success">
        <p>Post has been updated <strong>Successfully</strong> and is <?php echo $post_status ?> <a class="btn btn-primary" href="../post.php?post_id=<?php echo $edit_post_id ?>">View Post</a> <a class="btn btn-primary" href="posts.php">Edit More Posts</a> </p>
    </div>
<?php
}

?>
<form action="" method="post" enctype="multipart/form-data" class="ps-3 pe-2">

    <div class="form-group">
        <label class="form-label" for="post_title">Post Title</label class="form-label">
        <input type="text" class="form-control" name='post_title' value="<?php echo $post_title ?>">
    </div>
    <div class="form-group">
        <label class="form-label" for="editor">Post Content</label class="form-label">
        <textarea type="text" id="editor" class="form-control" name='post_content' ><?php echo $post_content ?></textarea>
        <!-- <textarea type="text" id="" class="form-control" name='post_content'  value="<?php //echo $post_content ?>"></textarea> -->
    </div>
    <div class="form-group">
        <label class="form-label" for="post_author">Post Author</label class="form-label">
        <input type="text" class="form-control" name='post_author' value="<?php echo $post_author ?>" disabled>
    </div>
    <div class="form-group">
        <label class="form-label" for="post_category_id">Post Category ID</label class="form-label">

        <select name="post_category_id" class="form-select mb-3" id="">
            <?php
            $select_categories_query = "select * from categories ";
            $select_categories_results = mysqli_query($connection, $select_categories_query);
            while ($category = mysqli_fetch_assoc($select_categories_results)) {
                $category_id = $category['cat_id'];
                $category_title = $category['cat_title'];
                echo "<option value='{$category_id}'>{$category_title}</option>
                 "
            ?>
            <?php } ?>
        </select>

    </div>
    <div class="form-group">
        <label class="form-label" for="post_status">Status</label class="form-label">
        <select name="post_status" multiple class="form-control" id="">
            <option class="mb-2" selected  value="<?php echo $post_status ?>"><?php echo $post_status ?></option>
            <?php
            if ($post_status == 'draft') {
                echo "<option value='published'>Published</option>";
            } else {
                echo "<option value='draft'>Draft</option>";
            }
            ?>

        </select>
    </div>

    <div class="form-group">
        <label class="form-label" for="post_image">Post Image</label class="form-label"><br>
        <img width="240px" src="../images/<?php echo $post_image ?>" alt="">
        <input type="file" class="form-control" name='post_image'>

    </div>
    <!-- <div class="form-group">
        <label class="form-label" for="post_comment">Post Comment Count</label class="form-label">
        <input type="text" class="form-control" name='post_comment' value="<?php echo $post_comment_count ?>">
    </div> -->
    <div class="form-group">
        <label class="form-label" for="post_tags">Post Tags</label class="form-label">
        <input type="text" class="form-control" name='post_tags' value="<?php echo $post_tags ?>">
    </div>
    <div class="form-group">
        <input type="submit" class="mt-2 btn btn-primary" name="update_post" value="Update the post">
    </div>

</form>