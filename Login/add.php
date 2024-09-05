<?php require 'connection.php';



if(!isset($_SESSION["status"])){
    echo '<script>alert ("Please login first") ; window.location.href = "login.php"; </script>';
    exit();
}

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $reg_date = $_POST['reg_date'];

        $sql = "INSERT INTO myguests (firstname, lastname, email, reg_date)
                VALUES ('$firstname', '$lastname', '$email', '$reg_date')";

                if($conn->query($sql)){
                    header("Location: dashboard.php");
                    exit();
                }else{
                    echo "Error: ". $sql. "<br>" .$conn->error;
                }
            
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <title>Add Guest</title>
</head>
<body>

    <div class="for-group" style="display: flex; justify-content: center; align-items: center;">
    <form action="" method="POST" enctype="multipart/form-data" class="shadow p-5">
    <h1 style="text-align: center;" class="display-4">Add Guests</h1><br><br>
        <label for="">Firstname: </label>
        <input type="text" name="firstname" required><br><br>
        <label for="">Lastname:  </label>
        <input type="text" name="lastname" required><br><br>
        <label for="">Email:  </label>
        <input type="text" name="email" required><br><br>
        <label for="">Date-time: </label>
        <input type="text" name="reg_date" required><br><br>
        <input type="submit" value="Add Guest" class="btn btn-outline-success"><br><br>
        <a href="dashboard.php" class="btn btn-outline-danger">Back</a>
    </form>
    </div>
    <br><br><br>

</body>
</html>