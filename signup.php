<?php
$alert = false;
$error = false;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    // $exists = false;

    // Checking already existing username
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($username == NULL && $password == NULL && $cpassword == NULL)
    {
      $error = "Please fill the credentials";
    }
    elseif($username == NULL || $password == NULL || $cpassword == NULL)
    {
      $error = "Please fill the credentials";
    }
    elseif($numExistRows > 0)
    {
      // $exists = true;
      $error = "Username already exists";
    }
    else
    {
        // $exists = false; 
        if($password == $cpassword)
        {
            $hash = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`username`, `password`, `date`) VALUES ('$username', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result)
            {
                $alert = true;
            }
        }
        else
        {
          $error = "Passwords do not match";
        }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Signup</title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if($alert)
    {
    echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    </svg>
    <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div>
    Account created successfully. Please Login!.
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
    <div class="container my-3">
        <h1 class="text-center">Please Signup to continue</h1>
        <form action="/crud/signup.php" method="post" style="display: flex;flex-direction: column;align-items: center;">
            <div class="mb-3 col-md-5">
                <label for="username" class="form-label">Username</label>
                <input type="text" maxlength="11" class="form-control" id="username" name="username" aria-describedby="emailHelp">    
            </div>
            <div class="mb-3 col-md-5">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="20" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 col-md-5">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
                <div id="text" class="form-text">Re-enter the password</div>
                <p class="mb-2">Already have an account? Please <a href="/crud/login.php">Login</a></p>
            </div>
            <button type="submit" class="btn btn-primary">SignUp</button>
        </form>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html> 
</body>
</html>