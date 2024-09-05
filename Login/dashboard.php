<?php
    require 'connection.php';
?>

<?php
    if(!isset($_SESSION["status"])){
        echo '<script>alert ("Please login first") ; window.location.href = "login.php"; </script>';
        exit();
    }

    if(isset($_POST['logout'])){
        if(isset($_SESSION['username'])){
            $username=$_SESSION['username'];
            $sql = "UPDATE `users` SET `Status` = '0' WHERE `Username` = '$username'";
            $result = mysqli_query($conn, $sql);
    
            header("Location:logout.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <title>Guests Dashboard</title>
</head>
<body>
	<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Guest</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this guest?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="#" class="btn btn-danger" id="confirmDeleteBtn">Delete</a>
      </div>
    </div>
  </div>
</div>

<div class="container">

<h1 class="display-4 text-center">Guests Dashboard</h1>

<form method="GET" style="text-align: right;">
	<input type="text" name="search" placeholder="Search by name..." style="padding: 3px 2px 7px 3px;">
	<button type="submit" class="btn btn-info" >Search</button>
	<a href="dashboard.php" class="btn btn-success">RESET</a>
</form>
<a href="add.php" class="btn btn-info">Add New Guest</a>

<br><br>

<?php
if(isset($_GET['search'])){
		$search_query = $_GET['search'];
		$sql = "SELECT * FROM myguests WHERE firstname LIKE '%$search_query%' OR lastname";
		$result = $conn->query($sql);
	}else{
		$sql = "SELECT * FROM myguests";
		$result = $conn->query($sql);
	}
?>
<table border="1" class="table table-striped text-center table-bordered border-dark">
	<b>
		<th>Firstname</th>
		<th>Lastname</th>
		<th>Email</th>
		<th>Reg_date</th>
		<th>Action</th>
        <?php
	if($result->num_rows > 0){
		while($row = $result -> fetch_assoc()){
			echo "<tr>";
			echo "<td>".$row["firstname"]."</td>";
			echo "<td>".$row["lastname"]."</td>";
			echo "<td>".$row["email"]."</td>";
			echo "<td>".$row["reg_date"]."</td>";
			echo "<td><a href='update.php?id=".$row["id"]."'  class='btn btn-info'>Edit</a> || <a href='#' class='btn btn-danger deleteBtn' data-id='".$row["id"]."' data-bs-toggle='modal' data-bs-target='#deleteModal'>Delete</a></td>";
			echo "</tr>";
		}
	} else{
		echo "<tr><td colspan = '7'> No records found</td></tr>";
	}
?>
	</b>
</table>
    <form action="" method="POST"><br>
	<button type="submit" name="logout" value="logout" class="btn btn-danger"  onclick="return confirm('Are you sure you want to logout?')">Logout</button>
</form>
</div>


<script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var deleteButtons = document.querySelectorAll('.deleteBtn');
    var confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var userId = this.getAttribute('data-id');
            confirmDeleteBtn.setAttribute('href', 'delete.php?id=' + userId);
        });
    });
});
</script>

</body>
</html>


<style>
  body{
    height: 100svh;
    background: linear-gradient(35deg, #F875AA,#8B93FF ,#FFF6F6);
    background-size: 50ren 50rem;
    animation: color 12s ease infinite;
  }

  @keyframes color{
    0%{
      background-position: 0% 50%;
    }

    50%{
      background-position: 100% 50%;
    }

    10%{
      background-position: 0% 50%;
    }
  }
</style>