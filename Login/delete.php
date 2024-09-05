<?php include 'connection.php' ;?>

<?php


    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if(!$id){
        die('Invalid ID');
    }

    $sql = "DELETE FROM myguests WHERE id=$id";
    $conn->query($sql);

    header("Location: dashboard.php");
    exit();
?>