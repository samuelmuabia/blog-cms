<?php
function redirect($location)
{


    header("Location:" . $location);
    exit;
}

function escape($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}
function checkMethod($method = null)
{

    if ($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {

        return true;
    }

    return false;
}

function isLoggedInAsAdmin()
{

    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {

        return true;
    }


    return false;
}

function checkIfUserIsLoggedInAndRedirect($redirectLocation = null)
{

    if (isLoggedInAsAdmin()) {

        redirect($redirectLocation);
    }
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
        return false;
    }
    return true;
}

function username_exists($username)
{

    global $connection;

    $query = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if (mysqli_num_rows($result) > 0) {

        return true;
    } else {

        return false;
    }
}



function email_exists($email)
{

    global $connection;


    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if (mysqli_num_rows($result) > 0) {

        return true;
    } else {

        return false;
    }
}


function login_user($username, $password)
{

    global $connection;

    $username = escape($username);
    $password = escape($password);


    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);
    if (confirmQuery($select_user_query)) {

        while ($row = mysqli_fetch_array($select_user_query)) {

            $db_user_id = $row['user_id'];
            $db_username = $row['username'];
            $db_user_password = $row['user_password'];
            $db_user_firstname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_role = $row['user_role'];


            if (password_verify($password, $db_user_password)) {
                $_SESSION['user_id'] = $db_user_id;
                $_SESSION['username'] = $db_username;
                $_SESSION['firstname'] = $db_user_firstname;
                $_SESSION['lastname'] = $db_user_lastname;
                $_SESSION['user_role'] = $db_user_role;
                if ($db_user_role == 'Admin') {
                    redirect("/cms/admin");
                } else {
                    redirect("/cms/");
                }
            } else {


                redirect("/cms/");
            }
        }
    }

    redirect("/cms/");
}

function insertCategories()
{
    global $connection;
    if (isset($_POST['category_submit'])) {
        $category_title = $_POST['category_title'];
        if (!$category_title) {
            echo "It cannot be empty";
        } else {
            $stmt = mysqli_prepare($connection, "insert into categories(`cat_title`) Value (?)");
            mysqli_stmt_bind_param($stmt, 's', $category_title);
            mysqli_stmt_execute($stmt);
        }
        redirect('categories.php');
    }
}
function deleteCategories()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $delete_category_id = $_GET['delete'];
        $delete_category_query = "Delete from categories where cat_id = {$delete_category_id}";
        $delete_category_query_execute = mysqli_query($connection, $delete_category_query);

        redirect('categories.php');
    }
?>


<?php
}

function viewAllCategories()
{
    global $connection;

    $stmt = mysqli_prepare($connection, "select cat_id,cat_title from categories");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $category_id, $category_title);
    while (mysqli_stmt_fetch($stmt)) :
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
    $stmt = mysqli_prepare($connection, "select cat_title from categories where cat_id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $edit_category_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $edit_category_title);
    while (mysqli_stmt_fetch($stmt)) :
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
    endwhile; ?>

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
        $stmt = mysqli_prepare($connection, "Update categories SET cat_title= ? where cat_id= ?");
        mysqli_stmt_bind_param($stmt, 'si', $updated_category_title, $updated_category_id);
        mysqli_stmt_execute($stmt);
    }
}

