<?php include('includes/header.php') ?>
<!-- Navigation -->
<?php include('includes/navbar.php') ?>

<?php
require './classes/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/phpmailer/phpmailer/src/Exception.php';
require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './vendor/phpmailer/phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

if (!isset($_GET['forgot'])) {
    redirect('index');
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $length = 50;
    $token = bin2hex(openssl_random_pseudo_bytes($length));

    if (email_exists($email)) {
        $stmt = mysqli_prepare($connection, "UPDATE users SET token='{$token}' where user_email=?");
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host = Config::SMTP_HOST;
        $mail->Username = Config::SMTP_USER;
        $mail->Password = Config::SMTP_PASSWORD;
        $mail->Port = Config::SMTP_PORT;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';


        $mail->setFrom('samuel.muabia@gmail.com', 'Samuel Muabia');
        $mail->addAddress($email);

        $mail->Subject = 'This is mail to reset your password';

        $mail->Body = '<p>Please click to reset your password

                    <a href="http://localhost/cms/reset.php?email=' . $email . '&token=' . $token . ' ">http://localhost:888/cms/reset.php?email=' . $email . '&token=' . $token . '</a>



                    </p>';


        if ($mail->send()) {

            $emailSent = true;
        } else {

            echo "NOT SENT";
        }
    }
}

?>






<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body ">
                        <div class="text-center">


                            <?php if (!isset($emailSent)) : ?>


                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body ">




                                    <form  role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group mb-3">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control" type="email">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                            <?php else : ?>


                                <h2>Please check your email</h2>


                            <?php endif; ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<!-- /.row -->

<hr>



    <?php include "includes/footer.php"; ?>

</div> <!-- /.container -->