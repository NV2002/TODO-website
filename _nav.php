<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
{
  $loggedin = true;
}
else
{
  $loggedin = false;
}
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/crud/index.php"><img src="/crud/logo.png" height="30px" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="/crud/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/crud/about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/crud/contactus.php">Contact Us</a>
        </li>
      </ul>';
      if(!$loggedin)
      {
        echo '<div class="d-grid gap-2 d-md-block">
        <a class="btn btn-outline-primary" href="/crud/login.php" role="button">Login</a>
        <a class="btn btn-outline-primary" href="/crud/signup.php" role="button">Signup</a>
        </li>';
      }
      if($loggedin)
      {
        echo '<a class="btn btn-outline-primary" href="/crud/logout.php" role="button">Logout</a>';
      }
      echo '</div>
    </div>
  </div>
</nav>';
?>