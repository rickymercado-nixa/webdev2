<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<body class="bg-dark">

<div class="container">
<div  class="text-info">
  <div class="login-form">
  <form action="" method="post" class="form-group">
    
<?php require 'connection.php' ?>
<?php 

  if(isset($_POST['submit'])){
    $user = $_POST['user'];
    $pass = $_POST['pass'];


    $query = "SELECT * FROM `users` WHERE `username` = '$user'";
    $stmts = $conn->prepare($query);
    $stmts->execute();
    $result = $stmts->get_result();
    $row = $result->fetch_assoc();

    if($user == @$row['username']){

      echo '<p class="text-danger">User already exist! Please try another username!</p>';


    }else{

    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $sql = "INSERT INTO `users`(`username`, `password`) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $hashed_password);
    $stmt->execute();

    echo '<p class="text-success">Registered Successfully.</p>';

  }
}
?>
  <h2>SIGN UP!</h2>
      <label for="user">Username: <span class="required-indicator">
      <input type="text" name="user" id="user" placeholder="Username" required><br><br>

      <label for="pass">Password: <span class="required-indicator">
      <input type="password" name="pass" id="pass" placeholder="Password" required><br><br>

      <input type="checkbox" onclick="myFunction()">Show Password<br><br>

        <button type="submit" name="submit" class="btn btn-success">REGISTER</button><br><br>
        <p>Already have an account? <a href="login.php" class="btn btn-outline-info">Login Here</a></p>
        </div>
</div>
    </form>
</div>
</div>

<script>
function myFunction() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

</body>
</html>

<style>
  *{
    margin: 0;
    padding: 0;
    font-family: arial;
  }

  .container{
    height: 100vh;
		display: flex;
		align-items: center;
		justify-content: center;
  }

  form{
    text-align: center;
    box-shadow: 5px 5px 15px 1px;
		padding: 20px 30px 30px 30px;
  }

  input{
		font-size: 18px;
		border: none;
		border-radius: 3px;
		padding: 3px 5px 3px 5px;
		transition: 1s;
    color: black;
	}



  </style>