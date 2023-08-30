<?php
include 'config.php';
session_start();
$idd=$_SESSION['idd'];
// $sql2="SELECT * from blog";
// $row=mysqli_query($conn,$sql2);
// $run=mysqli_num_rows($row);
// if($run){
//     $idd=mysqli_fetch_assoc($row);
// }
// $id2=$idd['blog_id'];

// $sql3="SELECT * FROM blog LEFT JOIN blog ON comment.blog_id=blog.blog_id;
// $run3=mysqli_query($conn,$sql3);
// $row3=mysqli_num_rows($run3);
// if($row3){
//     $omg=mysqli_fetch_assoc($run3);
// }


$name = $_GET['name'];
$id=$data['blog_id'];
$comment = mysqli_real_escape_string($conn,$_GET['comment']);
$sql = "INSERT INTO `comment`(`name`, `comment`,`blog_id`) VALUES ('$name','$comment','$idd')";

if(mysqli_query($conn,$sql)){
  header("Location: ./blog.php");
  
}
else{
    echo "Erro";
}


?>
