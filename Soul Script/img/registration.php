<?php
include './config.php';
$name = $_GET['dname'];

// $email = $_GET['dmail'];
// $pass = $_GET['dpass'];

$email = mysqli_real_escape_string($conn,$_GET['dmail']);
$pass = mysqli_real_escape_string($conn,sha1($_GET['dpass']));

$sql = "INSERT INTO `user`(`username`, `email`, `password`) VALUES ('$name','$email','$pass')";
if(mysqli_query($conn,$sql)){
  header("Location: ./login.php");
}
else{
    echo "Erro";
}


?>
