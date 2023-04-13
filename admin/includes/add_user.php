<?php
if (isset($_POST['create_user'])) {
    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];
    // $user_image = $_FILES['user_image']['name'];
    // $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_password = $_POST['user_password'];
    $user_password = password_hash($user_password,PASSWORD_BCRYPT, array('cost'=> 12));
    // $select_rand_salt = "SELECT randSalt from users";
    // $select_rand_salt_execute = mysqli_query($connection, $select_rand_salt);
    // $select_rand_salt_results = mysqli_fetch_array($select_rand_salt_execute);
    // $rand_salt = $select_rand_salt_results['randSalt'];
    // $usr_password = crypt($user_password,$rand_salt);
    $user_date = date('d-m-y');
    // move_uploaded_file($user_image_temp, "../images/{$user_image}");

    $insert_user_query = "INSERT INTO `users` ( `username`, `user_firstname`, `user_lastname`, `user_role`, `user_email`, `user_password`, `user_date`) VALUES ( '{$username}', '{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$user_email}', '{$user_password}', '{$user_date}')";

    $insert_user_query_execute = mysqli_query($connection, $insert_user_query);
    if(!$insert_user_query_execute){
        die("query failed");
    }
    ?>
    <div class="alert alert-success">
        <p>New User has been added <strong>Successfully</strong> and is <?php echo $user_role ?> <a class="btn btn-primary" href="users.php">View all Users</a> </p>
    </div>
<?php
}



?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_title">Username</label>
        <input type="text" class="form-control" name='username'>
    </div>
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name='user_firstname'>
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name='user_lastname'>
    </div>
    <div class="form-group">
        <label for="user_role">Select Role</label>
        <select class="form-select" mutiple name="user_role" id="">
            <option  value="Admin">Admin</option>
            <option selected value="Subscriber">Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <label for="user_author">Email</label>
        <input type="email" class="form-control" name='user_email'>
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name='user_password'>
    </div>
    <!-- <div class="form-group">
        <label for="user_category_id">user Category ID</label>
        <select name="user_category_id" id="">
            <?php
            $select_categories_query = "select * from categories ";
            $select_categories_results = mysqli_query($connection, $select_categories_query);
            while ($category = mysqli_fetch_assoc($select_categories_results)) {
                $user_id = $category['user_id'];
                $category_title = $category['cat_title'];
                echo "<option value='{$category_id}'>{$category_title}</option>
                 "
            ?>
            <?php } ?>
        </select>

    </div> -->

    <!-- <div class="form-group">
        <label for="user_image">user Image</label>
        <input type="file" class="form-control" name='user_image'>
    </div> -->

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add user">
    </div>

</form>