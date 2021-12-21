<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
  header("location: login.php");
  exit;
}
include 'partials/_dbconnect.php';
$error = false;
$insert = false;
$update = false;
$delete = false;
if(isset($_GET['delete']))
{
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `notes` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if(isset($_POST['snoEdit']))
  {
    // Updating record
    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $description = $_POST["descriptionEdit"];

    // SQL query
    $sql = "UPDATE `notes` SET `title` = '$title' , `description` = '$description' WHERE `notes`.`sno` = $sno";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
      $update = true;
    }
    else
    {
      echo "Record updation failed!". mysqli_error($conn);
    }
  }
else
{
  // Inserting record
  $title = $_POST["title"];
  $description = $_POST["description"];

  // SQL query
  $checksql = "SELECT * FROM `notes` WHERE `title` = '$title' AND `description` = '$description'";
  $result = mysqli_query($conn, $checksql);
  $numExistRows = mysqli_num_rows($result);
  if($title == NULL && $description == NULL)
  {
    $error = "Empty note discarded";
  }
  elseif($title == NULL || $description == NULL)
  {
    $error = "Please complete the note";
  }
  else
  {
    if($title != NULL && $description != NULL)
    {
      $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
      $result = mysqli_query($conn, $sql);
      if($result)
      {
        $insert = true;
      }
      else
      {
        echo "Note insertion failed!". mysqli_error($conn);
      }
    }
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
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

  <title>iNotes - Notes taking made easy</title>

</head>

<body>
  <!-- Edit modal -->
  <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
Edit modal
</button> -->

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit note</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/crud/index.php" method="post">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="desc" class="form-label">Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="5"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php require 'partials/_nav.php' ?>
  <div class="container my-3">
    <div class="alert alert-primary" role="alert">
      <h4 class="alert-heading">iNotes-Powered by iSecure</h4>
      <p>Welcome to iNotes. You are logged in as <?php echo "<b>". $_SESSION['username']. "</b>";?></p>
    </div>
  </div>
  <?php
  // Alert Messages
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
  <?php
  if($insert)
  {
    echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    </svg>
    <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div>
    Note saved successfully.
  </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  ?>
  <?php
  if($update)
  {
    echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    </svg>
    <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div>
    Note updated successfully.
  </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  ?>
  <?php
  if($delete)
  {
    echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    </svg>
    <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div>
    Note deleted successfully.
  </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  ?>

  <!-- Main page -->
  <div class="container my-3">
    <h2>Add a note</h2>
    <hr>
    <form action="/crud/index.php" method="post">
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="desc" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>

  <!-- Data Table -->
  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
          include 'partials/_dbconnect.php';
          // Display saved notes
          $sql = "SELECT * FROM `notes` ORDER BY `sno` DESC";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row=mysqli_fetch_assoc($result))
          {
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>".$sno."</th>
            <td>".$row['title']."</td>
            <td>".$row['description']."</td>
            <td><button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button></td>
            </tr>";
          }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit')
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit",);
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description)
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete')
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit",);
        sno = e.target.id.substr(1,);
        if (confirm("Are you sure you want to delete this note?")) {
          console.log("yes");
          window.location = `/crud/index.php?delete=${sno}`;
        }
        else {
          console.log("no");
        }
      })
    })
  </script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>
</html>