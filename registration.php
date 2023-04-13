<?php include "includes/header.php"; ?>


<!-- Navigation -->

<?php include "includes/navbar.php"; ?>

<?php
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
$options = array(
    'cluster' => 'ap2',
    'useTLS' => true
);
$pusher = new Pusher\Pusher(
    getenv('APP_KEY'),
    getenv('APP_SECRET'),
    getenv('APP_ID'),
    // '1d44af4bb383a0876416',
    // 'ec280c1ff2ad9f99dd69',
    // '1580676',
    $options
);

$message = '';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    if (!empty($username) && !empty($email) && !empty($password)) {



        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);
        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

        // $select_rand_salt = "SELECT randSalt from users";
        // $select_rand_salt_execute = mysqli_query($connection, $select_rand_salt);
        // $select_rand_salt_results = mysqli_fetch_array($select_rand_salt_execute);
        // $rand_salt = $select_rand_salt_results['randSalt'];
        // $password = crypt($password,$rand_salt);
        $user_date = date('Y-m-d');

        $register_user_query = "INSERT INTO users (username,user_email,user_password, user_role,user_date) VALUES('{$username}','{$email}','{$password}','Subscriber',{$user_date})";
        $register_user_query_execute = mysqli_query($connection, $register_user_query);

        $message = "<div class='alert alert-success'>
    <p>Registration has been successful</p>
    </div>";
        $data['message'] = $username;
        $pusher->trigger('notifications', 'new_user', $data);
    } else {
        $message = "Fields cannot be empty";
    }
}

?>

<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <?php echo $message ?>
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group mb-3">
                                <label for="username" class="sr-only">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Register">
                                <a class="text-decoration-none" href="/cms/login.php">Already have an Account?</a>
                            </div>
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>