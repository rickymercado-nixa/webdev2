<?php include 'connection.php';?>

<?php

if(!isset($_SESSION["status"])){
    echo '<script>alert ("Please login first") ; window.location.href = "login.php"; </script>';
    exit();
}


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST['id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $reg_date = $_POST['reg_date'];


            $sql = "UPDATE myguests SET firstname ='$firstname', lastname='$lastname', email='$email',
            reg_date='$reg_date' WHERE id='$id'";

        $conn->query($sql);

        header("Location: dashboard.php");
        exit();
    }

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if(!$id){
        die('Invalid ID');
    }

    $sql = "SELECT * FROM myguests WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <title>Update Guest</title>
</head>
<body>
    <div class="for-group" style="display: flex; justify-content: center; align-items: center;">
    <form action="" method="POST" enctype="multipart/form-data" class="shadow p-5">
    <h1 style="text-align: center;" class="display-4">Update Guest</h1><br>
        <input type="hidden" name="id" value="<?php echo $row['id'];?>"
        <label for="">Firstname:</label>
        <input type="text" name="firstname" value="<?php echo $row['firstname'];?>" required><br><br>
        <label for="">Lastname:</label>
        <input type="text" name="lastname" value="<?php echo $row['lastname'];?>"><br><br>
        <label for="">Email:</label>
        <input type="text" name="email" value="<?php echo $row['email'];?>"><br><br>
        <label for="">Reg_date:</label>
        <input type="text" name="reg_date" value="<?php echo $row['reg_date'];?>"><br><br>
        <input type="submit" value="Update Guest" class="btn btn-success"><br><br>
        <a href="dashboard.php" class="btn btn-outline-info">Back</a>
    </form>
    </div>
</body>
</html>