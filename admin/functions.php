<?php
function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection,trim($string));
}
function users_online()
{
    if (isset($_GET['onlineusers'])) {
        session_start();
        include('../includes/db.php');
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 05;
        $time_out = $time - $time_out_in_seconds;
        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);
        if ($count == NULL) {
            mysqli_query($connection, "INSERT into users_online(session, time) VALUES ('{$session}','{$time}')");
        } else {
            mysqli_query($connection, "UPDATE users_online set time ='{$time}' where session ='{$session}'");
        }
        $users_online =     mysqli_query($connection, "select * from users_online where time>'{$time_out}' ");
        $total_users = mysqli_num_rows($users_online);
        echo $total_users;
    }
}
users_online();

function confirmQuery($result)
{
    if (!$result) {
        die('Query Failed' . mysqli_error($result));
    }
}
function insertCategories()
{
    global $connection;
    if (isset($_POST['category_submit'])) {
        $category_title = $_POST['category_title'];
        if (!$category_title) {
            echo "It cannot be empty";
        } else {
            $stmt = mysqli_prepare($connection,"insert into categories(`cat_title`) Value (?)");
            mysqli_stmt_bind_param($stmt,'s',$category_title);
            mysqli_stmt_execute($stmt);
           
        }
    }
}
function deleteCategories()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $delete_category_id = $_GET['delete'];
        $delete_category_query = "Delete from categories where cat_id = {$delete_category_id}";
        $delete_category_query_execute = mysqli_query($connection, $delete_category_query);
        echo "<script>window.location.href ='categories.php'</script>";

        // header('location:categories.php');
    }
?>

    <!-- <div class="alert alert-success">
        <p>Category has been deleted <strong>Successfully</strong> ?></p>
    </div> -->
<?php
}

function viewAllCategories()
{
    global $connection;

    $stmt = mysqli_prepare($connection,"select cat_id,cat_title from categories");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$category_id,$category_title);
    while(mysqli_stmt_fetch($stmt)):
        echo "<tr>
            <td>{$category_id}</td>
            <td>{$category_title}</td>
            <td><a href='categories.php?edit={$category_id}' class='btn btn-warning'>Edit</a></td>
            <td><a href='categories.php?delete={$category_id}' class='btn btn-danger'>Delete</a></td>
        </tr>";
    endwhile;

}

function showUpdateCategoriesInputField()
{
    global $connection;
?>
    <?php
    $edit_category_id = $_GET['edit'];
    $stmt = mysqli_prepare($connection,"select cat_title from categories where cat_id = ?");
    mysqli_stmt_bind_param($stmt,'i',$edit_category_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$edit_category_title);
    while(mysqli_stmt_fetch($stmt)):
        ?>
        <form action="" method="post">
        <input type="text" name="edit_category_id" value="<?php echo $edit_category_id ?>" hidden>
        <div class="form-group">
            <label for="addcategory" class="form-label">Edit Category Title - <?php echo $edit_category_title ?></label>
            <input type="text" name="edit_category_title" class="form-control" id="addcategory">
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Update Category" name="edit_category_submit">

        </div>
    </form>
    <?php
    endwhile;?>

<?php
    if (isset($_POST['edit_category_submit'])) {
        updateCategories();
    }
}
function updateCategories()
{
    global $connection;
    $updated_category_title = $_POST['edit_category_title'];
    $updated_category_id = $_POST['edit_category_id'];
    if (!$updated_category_title) {
        echo "It cannot be empty";
    } else {
        $stmt = mysqli_prepare($connection,"Update categories SET cat_title= ? where cat_id= ?");
        mysqli_stmt_bind_param($stmt,'si',$updated_category_title,$updated_category_id);
        mysqli_stmt_execute($stmt);

        echo "<script>window.location.href ='categories.php'</script>";
    }
}

function email_exists($email){

    global $connection;


    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0) {

        return true;

    } else {

        return false;

    }



}
?>











