<?php include './config.php';
    session_start(); 
if (!isset($_SESSION['user_data'])){
    header('location: ./registration.php');}
if(isset($_SESSION['user_data'])){
        $userid=$_SESSION['user_data']['0'];
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./css/user.css">
    
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
                <button><a href="./logout.php">Log Out</a></button>
            </ul>
        </div>
    </div>




    <div class="user_profile">
        <img src="./img/card_main_img3.png" alt="">
        <div class="user_profile_text">
             <h1 style="text-transform:uppercase;color:white"> <?php 
            if(isset($_SESSION['user_data'])){
                $omg=$_SESSION['user_data']['1'];
                echo $omg;
            }
            ?></h1>
            <h3 style="color:white;"><?php 
            
            if(isset($_SESSION['user_data'])){
                $omg=$_SESSION['user_data']['2'];
                echo $omg;
            }
            ?></h3>
            
            <button><a href="./post.php">Create a blog</a></button>
        </div>
    </div>
    <div class="main_feature">
        
         <div class="main_feature_featured_post">
             <h2>Your Posts</h2>
             <span style="width:100%" class="Span_red"></span>
         <?php 
$sql="SELECT * FROM blog LEFT JOIN user ON blog.authod_id=user.user_id WHERE user_id='$userid' ORDER BY blog.publish_date DESC"     ;
$query=mysqli_query($conn,$sql); 
$row=mysqli_num_rows($query);
$count=0;
if($row){
    while($result=mysqli_fetch_assoc($query)){
        ?>
        <h3 style="padding:1rem;text-decoration:none;">
        <a style="text-decoration:none;color:white;" href="blog.php?id=<?=$result['blog_id'] ?>" >
            <?= strip_tags($result['title']) ?>
        </h3>
        <p style="padding:0 1rem;"><?= strip_tags($result["blog_blog"])?></p>
    </a>
    <p style="font-weight: bold; color: white; padding:1rem;"><?= date('d-m-y',strtotime($result['publish_date']))?></p>
    <!-- <button name='edit' style="padding:1rem 1.5rem;border:none;border-radius:10px;margin:0.5rem;cursor:pointer; color:black;background:white;">
        Edit
    </button>
    <button name='delete' style="padding:1rem 1.5rem;border:none;border-radius:10px;cursor:pointer;margin:0.5rem;color:white;background:#FE4233;">Delete</button> -->

    <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete?')">
    <input type="hidden" name="id" value="<?= $result['blog_id']?>">
    <input type="hidden" name="image" id="" value="<?= $result['blog_image']?>">
    <input type="submit" name="deletePost" value="Delete" style="padding:1rem 1.5rem;border:none;border-radius:10px;margin:0.5rem;cursor:pointer; color:white;background:#FE4233;margin:0 1rem;">
    <?php include "config.php";
 if(isset($_POST['deletePost'])){
    $id=$_POST['id'];
    $image="upload/".$_POST['image'];
    $delete="DELETE FROM blog WHERE blog_id='$id'";
    $run=mysqli_query($conn,$delete);
    if($run){
        unlink($image);
        $msg=['Blog has been successfully','alert-success'];
        $_SESSION['msg']=$msg;
        header('location:user.php');
    }
else{
    $msg=['Failed, please try again','alert-danger'];
    header("location:user.php");
}
 }
 ?>
    </form>
 
    <span style="width:100%" class="Span"></span>
        <?php
    }
}
else{
    ?>
    <tr><td colspan='7'>NO records here</td></tr>
<?php 
}
?>
         
         
        </div> 
    </div>

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
</html>