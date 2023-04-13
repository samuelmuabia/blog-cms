<?php include "includes/header.php"; ?>


<!-- Navigation -->

<?php include "includes/navbar.php"; ?>

<?php
    $message = '';

if (isset($_POST['submit'])) {
    $to = "samuel.planet1@gmail.com";
    $name = $_POST['name'];
    $email = "From: ". $_POST['email'];
    $subject = wordwrap($_POST['subject'],70);
    $message = $_POST['message'];
    mail($to,$subject,$message,$email);

    
} 


?>

<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <?php echo $message ?>
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3 ">
                    <div class="form-wrap">
                        <h1 class="text-center">Contact Us</h1>
                        <form role="form" action="" method="post" id="l" autocomplete="off">
                            <div class="form-group mb-3">
                                <label for="username" class="sr-only">Name</label>
                                <input type="text" name="username" id="Name" class="form-control" placeholder="Enter Name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group mb-3">
                                <label for="subject" class="sr-only">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                            </div>
                            <div class="form-group mb-3">
                                <label for="query" class="sr-only">Query</label>
                                <textarea type="text" name="query" id="query" class="form-control" placeholder="Message Here"></textarea>
                            </div>

                            <input type="submit" name="submit"  class="btn btn-primary" value="Send Message">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>