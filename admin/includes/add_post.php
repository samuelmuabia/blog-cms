<?php
if (isset($_POST['create_post'])) {
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_content = $_POST['post_content'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_title = $_POST['post_title'];
    $post_date = date('d-m-y');
    move_uploaded_file($post_image_temp, "../images/{$post_image}");

    $insert_post_query = "INSERT INTO `posts` ( `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`) VALUES ( {$post_category_id}, '{$post_title}', '{$post_author}', '{$post_date}', '{$post_image}', '{$post_content}', '{$post_tags}',  '{$post_status}')";

    $insert_post_query_execute = mysqli_query($connection, $insert_post_query);
    $post_id = mysqli_insert_id($connection)
?>
    <div class="alert alert-success">
        <p>Post has been uploaded <strong>Successfully</strong> and is <?php echo $post_status ?> <a class="btn btn-primary" href="../post.php?post_id=<?php echo $post_id ?>">View Post</a> <a class="btn btn-primary" href="posts.php?source=edit_post&edit=<?php echo $post_id ?>">Edit Post</a> </p>
    </div>
<?php
}



?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label class="form-label pt-2" for="post_title">Post Title</label>
        <input type="text" class="form-control" name='post_title'>
    </div>
    <div class="form-group">
        <label class="form-label pt-2" for="post_content">Post Content</label>
        <textarea type="text" id="editor" class="form-control" name='post_content'></textarea>
    </div>
    <div class="form-group">
        <label class="form-label pt-2" for="post_author">Post Author</label>
        <input type="text" class="form-control" name='post_author'>
    </div>
    <div class="form-group">
        <label class="form-label pt-2" for="post_author">Post Users</label>
        <select class="form-select" name="post_author" id="">
            <?php
            $select_users_query = "select * from users ";
            $select_users_results = mysqli_query($connection, $select_users_query);
            while ($user = mysqli_fetch_assoc($select_users_results)) {
                $user_id = $user['user_id'];
                $username = $user['username'];
                echo "<option value='{$user_id}'>{$username}</option>
                 "
            ?>
            <?php } ?>
        </select>

    </div>
    <div class="form-group">
        <label class="form-label pt-2" for="post_category_id">Post Category ID</label>
        <select class="form-select" name="post_category_id" id="">
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
        <label class="form-label pt-2" for="post_status">Status</label>
        <select multiple class="form-select"  name="post_status" id="">
            <option value='published'>Published</option>
            <option value='draft'>Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label class="form-label pt-2" for="post_image">Post Image</label>
        <input type="file" class="form-control" name='post_image'>
    </div>
    <div class="form-group">
        <label class="form-label pt-2" for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name='post_tags'>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish the post">
    </div>

</form>