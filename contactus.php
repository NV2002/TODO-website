<?php
session_start();
$message = false;
$error = false;
// Sending message
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    include 'partials/_dbconnect.php';
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    // SQL query
    $sql = "INSERT INTO `messages` (`name`, `email`, `subject`, `message`) VALUES ('$name', '$email', '$subject', '$message')";
    $result = mysqli_query($conn, $sql);
    if($name == NULL && $email == NULL && $subject == NULL && $message == NULL)
    {
        $error = "Please fill the details";
    }
    elseif($result)
    {
        $message = true;
    }
    else
    {
        echo "message sending failed! due to error ---> ". mysqli_error($conn);
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

    <title>iNotes - Notes taking made easy</title>

</head>

<body>
    <?php require 'partials/_nav.php' ?>
    <?php
        if($message)
        {
            echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>
            </svg>
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
          <div>
            Message sent successfully.
          </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        if($error)
        {
        echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
        </svg>
        <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
        '.$error.'
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
    ?>
<!--Section: Contact v.2-->
<section class="mb-4">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">iNotes-Contact us</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us
        directly. Our team will come back to you within
        a matter of hours to help you.</p>

    <div class="row">

        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form" action="contactus.php" method="POST">

                <!--Grid row-->
                <div class="container row">

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-3">
                            <input type="text" id="name" name="name" class="form-control">
                            <label for="name" class="">Your name</label>
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="email" name="email" class="form-control">
                            <label for="email" class="">Your email</label>
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="container row">
                    <div class="col-md-12">
                        <div class="md-form mb-3">
                            <input type="text" id="subject" name="subject" class="form-control">
                            <label for="subject" class="">Subject</label>
                        </div>
                    </div>
                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="container row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="md-form">
                            <textarea type="text" id="message" name="message" rows="2"
                                class="form-control md-textarea"></textarea>
                            <label for="message">Your message</label>
                        </div>

                    </div>
                </div>
                <!--Grid row-->

            </form>

            <div class="text-center text-md-left">
                <a class="btn btn-primary" onclick="document.getElementById('contact-form').submit();">Send</a>
            </div>
            <div class="status"></div>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-3 text-center">
            <ul class="list-unstyled mb-0">
                <li><i class="fas fa-map-marker-alt fa-2x color-info"></i>
                    <p>Ahmedabad, GUJ 380015, INDIA</p>
                </li>

                <li><i class="fas fa-phone mt-4 fa-2x color-info"></i>
                    <p>94473XXXXX</p>
                </li>

                <li><i class="fas fa-envelope mt-4 fa-2x color-info"></i>
                    <p>nandanvaghela.20.ce@iite.indusuni.ac.in</p>
                </li>
            </ul>
        </div>
        <!--Grid column-->

    </div>

</section>
<!--Section: Contact v.2-->
</body>

</html>

</html>