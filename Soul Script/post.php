<?php session_start();
include 'config.php';
if(!$conn){
    die("Error: ".mysqli_connect_error());
}

// if(isset($_POST["submit"])){
//     $name = $_POST["title"];
//     $blogbody=$_POST['blog_body'];
//     $name = $_POST["title"];
//   if($_FILES["image"]["error"] == 4){
//     echo
//     "<script> alert('Image Does Not Exist'); </script>"
//     ;
//   }
//   else{
//     $fileName = $_FILES["image"]["name"];
//     $fileSize = $_FILES["image"]["size"];
//     $tmpName = $_FILES["image"]["tmp_name"];

//     $validImageExtension = ['jpg', 'jpeg', 'png'];
//     $imageExtension = explode('.', $fileName);
//     $imageExtension = strtolower(end($imageExtension));
//     if ( !in_array($imageExtension, $validImageExtension) ){
//       echo
//       "
//       <script>
//         alert('Invalid Image Extension');
//       </script>
//       ";
//     }
//     else if($fileSize > 1000000){
//       echo
//       "
//       <script>
//         alert('Image Size Is Too Large');
//       </script>
//       ";
//     }
//     else{
//       $newImageName = uniqid();
//       $newImageName .= '.' . $imageExtension;
//       if(isset($_SESSION['user_data'])){
//         $authod_id=$_SESSION['user_data']['3'];
//     }
//     $authod_id=null;
//     if(isset($_SESSION['user_data'])){
//         $authod_id=$_SESSION['user_data']['0'];
    
//       move_uploaded_file($tmpName, 'upload/' . $newImageName);
//       $sql2="INSERT INTO `blog`(`blog_id`, `title`, `blog_blog`, `blog_image`, `authod_id`) VALUES ('$blog_id','$name','$blogbody','$tmpName','$authod_id')";
//     }
//       $query2=mysqli_query($conn,$sql2);
//     //   $query = "INSERT INTO `tablename`(`img`) VALUES ('', '$name', '$newImageName')";
//     //   mysqli_query($conn, $query);
//       echo
//       "
//       <script>
//         alert('Successfully Added');
//         document.location.href = 'user.php';
//       </script>
//       ";
//     }
//   }
// }

if(isset($_POST["submit"])){

  $name = $_POST["title"];
  $blogbody = $_POST["blog_body"];
  if(isset($_SESSION['user_data'])){
    $authod_id=$_SESSION['user_data']['3'];
  }
  $authod_id=null;
      if(isset($_SESSION['user_data'])){
          $authod_id=$_SESSION['user_data']['0'];}
  if($_FILES["image"]["error"] == 4){
    echo
    "<script> alert('Image Does Not Exist'); </script>"
    ;
  }
  else{
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if ( !in_array($imageExtension, $validImageExtension) ){
      echo
      "
      <script>
        alert('Invalid Image Extension');
      </script>
      ";
    }
    else if($fileSize > 1000000){
      echo
      "
      <script>
        alert('Image Size Is Too Large');
      </script>
      ";
    }
    else{
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;

      move_uploaded_file($tmpName, 'upload/' . $newImageName);
      $query = "INSERT INTO `blog`(`blog_id`, `title`, `blog_blog`, `blog_image`, `authod_id`) VALUES ('$blog_id','$name','$blogbody','$newImageName','$authod_id')";
      mysqli_query($conn, $query);
      echo
      "
      <script>
        alert('Successfully Added');
        document.location.href = 'user.php';
      </script>
      ";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel="stylesheet" href="./css/post.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2&display=swap" rel="stylesheet">
 
</head>
<body style="color:white;">
    <div class="nav">
        <div class="logo">
            <p class="Soul"><a href="./index.php" style="text-decoration: none; cursor: pointer; background: transparent; color: #FE4233;">Soul</a></p>
            <p><a href="./index.php" style="text-decoration: none; cursor: pointer; background: transparent; color: white;">Scripter</a></p>
        </div>
        <div class="nav_feature">
            <ul>
                <li><a href="">Search</a></li>
                <li><a href="">Contact</a></li>
                <button><a href="./registration.html">Login/Register</a></button>
            </ul>
        </div>
    </div>
    <div class="user_profile">
        <img src="./img/card_main_img3.png" alt="">
        <div class="user_profile_text">
        <h1 style="text-transform:uppercase"> <?php 
            
            if(isset($_SESSION['user_data'])){
                $omg=$_SESSION['user_data']['1'];
                echo $omg;
            }
            ?></h1>
            <h3><?php 
            
            if(isset($_SESSION['user_data'])){
                $omg=$_SESSION['user_data']['2'];
                echo $omg;
            }
            ?></h3>
        </div>
    </div>
    <form style="    background: #0b0b0b;
    padding: 2rem 4rem;
    border: 2px solid;
    margin: 3rem;
    margin: 2rem 25rem;
    border-radius: 15px;
}" class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">
            <h2>Create your blog</h2>
            <input style="padding: 1rem;
    margin: 1rem 0.5rem;
    /* border: none; */
    font-size: 1rem;
    font-weight: 500;
    /* width: 100%; */
    background: transparent;
    border: 2px solid;" type="text" name="title" placeholder="Enter the title of blog">
            <label for="">Body/Description</label>
            <textarea style=" padding: 1rem;
    margin: 1rem 0.5rem;
    border: 2px solid;
    background: transparent;
    font-size: 1rem;" name="blog_body" id="blog_body_" cols="10" rows="5" placeholder="Enter the Text of blog"></textarea>
            <input style="padding: 1rem;
    margin: 1rem 0.5rem;
    /* border: none; */
    font-size: 1rem;
    font-weight: 500;
    /* width: 100%; */
    background: transparent;
    border: 2px solid;" type="file" name='image'>
            <button 
            style="background: #FE4233;
    border: none;
    padding: 0.5rem 1rem;
    font-size: 17px;
    cursor: pointer;
    border-radius: 10px;
    margin: 0 15rem;" type='submit' name='submit'>Submit</button>
        </form>

   


    <!-- <div class="fotter">
        <div class="fotter_main">
            <div class="fotter_main_box1">
                <h1><a style="text-decoration: none;" class="Soul">Soul</a>Scripter </h1>
                <p>Step into the boundless cosmos of written artistry. <a style="text-decoration: none;" class="Soul">Soul</a> Scripter weaves ethereal tales, poetic verses, and insightful musings, inviting you on a journey through the depths of the human <a style="text-decoration: none;" class="Soul">soul</a>.</p>
                <h3>Mobile: 9XXXXXXX</h3>
                <h3>soulscripter@gmail.com</h3>
            </div>
            <div class="fotter_main_box2">
                <h1>Contact Us</h1>
                <form action="">
                    <div class="fotter_input_box Name">
                        <h2>Name :</h2>
                        <input type="text" placeholder="Enter your name">
                    </div>
                    <div class="fotter_input_box Email">
                        <h2>Email :</h2>
                        <input type="text" placeholder="Enter your email">
                    </div>
                    <div class="fotter_input_box Message" >
                        <h2>Message</h2>
                        <textarea cols="20" rows="1" type="text" placeholder="Message"></textarea>

                    </div>
                    <button>Submit</button>
                </form>
            </div>
        </div>
        <footer>All Copyright are reserved @soulscripter</footer>
    </div> -->
</body>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy='origin'></script>
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('blog_body_');
</script>
</html>