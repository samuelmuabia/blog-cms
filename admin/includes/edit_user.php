<?php
if(!isLoggedInAsAdmin()){
    redirect('index.php');
}
if (isset($_GET['edit'])) {
    $edit_user_id = $_GET['edit'];
    $search_user_query = "select * from users where user_id ={$edit_user_id}";
    $search_user_query_execute = mysqli_query($connection, $search_user_query);
    $search_user_query_results = mysqli_fetch_assoc($search_user_query_execute);
    $username = $search_user_query_results['username'];
    $user_firstname = $search_user_query_results['user_firstname'];
    $user_lastname = $search_user_query_results['user_lastname'];
    $user_role = $search_user_query_results['user_role'];
    $user_email = $search_user_query_results['user_email'];
    $user_password = $search_user_query_results['user_password'];
}
// neeed too checkk
if (isset($_POST['update_user'])) {
    $update_user_id = $_GET['edit'];
    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];
    $password = $_POST['user_password'];
    $user_date = date('Y-m-d');

    // $select_rand_salt = "SELECT randSalt from users";
    // $select_rand_salt_execute = mysqli_query($connection, $select_rand_salt);
    // $select_rand_salt_results = mysqli_fetch_array($select_rand_salt_execute);
    // $rand_salt = $select_rand_salt_results['randSalt'];
    if($password!=$user_password){
        $password = password_hash($password,PASSWORD_BCRYPT, array('cost'=> 12));
        $update_user_query = "update `users` set `username`= '{$username}', `user_firstname`='{$user_firstname}', `user_lastname`='{$user_lastname}', `user_date`= '{$user_date}' , `user_role`='{$user_role}', `user_email`='{$user_email}', `user_password`='{$password}' where user_id={$update_user_id}";
        $update_user_query_execute = mysqli_query($connection, $update_user_query);
    }
    else{
        $update_user_query = "update `users` set `username`= '{$username}', `user_firstname`='{$user_firstname}', `user_lastname`='{$user_lastname}', `user_date`= '{$user_date}' , `user_role`='{$user_role}', `user_email`='{$user_email}', `user_password`='{$password}' where user_id={$update_user_id}";
        $update_user_query_execute = mysqli_query($connection, $update_user_query);
    }
    
    // move_uploaded_file($user_image_temp, "../images/{$user_image}");
    // if (empty($user_image)) {
    //     $image_query = "select `user_image` from users where `user_id`= {$update_user_id}";
    //     $image_query_execute = mysqli_query($connection, $image_query);
    //     $image_query_results = mysqli_fetch_assoc($image_query_execute);
    //     $user_image = $image_query_results['user_image'];
    // }
   
    ?>
    <div class="alert alert-success">
        <p>User profile has been updated <strong>Successfully</strong> and is <?php echo $user_role ?> <a class="btn btn-primary" href="users.php">View all Users</a> </p>
    </div>
<?php
}

?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_title">Username</label>
        <input type="text" class="form-control" name='username' value="<?php echo $username ?>">
    </div>
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name='user_firstname' value="<?php echo $user_firstname ?>">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name='user_lastname' value="<?php echo $user_lastname ?>">
    </div>
    <div class="form-group">
        <label for="user_role">Role</label>
        <select multiple class="form-select" name="user_role" id="">
            <option selected value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
            <?php
                if($user_role=='Admin'){
                    echo "<option value='Subscriber'>Subscriber</option>";
                }
                else{
                    echo "<option value='Admin'>Admin</option>";

                }
            ?>
            
        </select>
    </div>
    <div class="form-group">
        <label for="user_author">Email</label>
        <input type="email" class="form-control" name='user_email' value="<?php echo $user_email ?>">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name='user_password' value="<?php echo $user_password ?>">
    </div>
   

    <!-- <div class="form-group">
    <label for="user_image">user Image</label>
    <input type="file" class="form-control" name='user_image'>
</div> -->

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_user" value="Update user">
    </div>

</form>