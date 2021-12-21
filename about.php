<?php
session_start();
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
<?php require 'partials/_nav.php' ?>

<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://source.unsplash.com/2400x800/?pen,notes" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/2400x800/?computer,notes" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/2400x800/?laptop,notes" class="d-block w-100" alt="...">
    </div>
  </div>
</div>
<div class="p-2 mb-0 bg-info text-dark text-center fs-3 fw-bold">About iNotes</div>
<div class="p-2 mb-0 bg-info text-dark text-center fs-5">This website is made for internship purpose</div>
<div class="p-2 mb-2 bg-info text-dark text-center fs-5">"iNotes - Notes taking made easy"</div>