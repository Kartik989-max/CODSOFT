<?php 
include "config.php";
$id=$_GET['id'];
if(empty($id)){
    header("location:index.php");
}


// $sql3="SELECT * FROM comment LEFT JOIN blog ON comment.blog_id=blog.blog_id;
// $run3=mysqli_query($conn,$sql3);
// $row3=mysqli_num_rows($run3);   

$sql="SELECT * FROM blog WHERE blog_id=$id";
$run=mysqli_query($conn,$sql);
$post=mysqli_fetch_assoc($run);
?>
<?php
session_start();
$_SESSION['idd']=$id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2&display=swap" rel="stylesheet">
    
    <link href="./css/blog.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="nav">
        <div class="logo">
            <p class="Soul"><a href="./index.php" style="text-decoration: none; cursor: pointer; background: transparent; color: #FE4233;">Soul</a></p>
            <p><a href="./index.php" style="text-decoration: none; cursor: pointer; background: transparent; color: white;">Scripter</a></p>
        </div>
        <div class="nav_feature">
            <ul>
                <li>
                  <?php if(isset($_GET['keyword'])){
                    $keyword=$_GET['keyword'];}
                    else{
                        $keyword='';
                    }
                    ?>  
                
                <form style='display:flex' action="search.php" method='GET'>
                    <li><input name='keyword' type='text' required maxlength='70' style=' background:transparent;border:none;border-bottom:2px white solid;color:white;' type="text" placeholder="Search"></li>
                    <li><button>Search</button></li>
                </form></li>
               
                <button id='btn_login'><a href="./registration.html">Login/Register</a></button>
            </ul>
        </div>
    </div>
    </div>
    </div>
    <div class="blog main_head">
        <?php $img=$post['blog_image']?>
        <img src="upload/<?= $img?>" alt="">
        
        <h1 style="font-size:2rem;"><?= strip_tags($post['title'])?></h1>
        <p style="font-size:1rem; margin:0 25rem;"><?= ($post['blog_blog'])?></p>
    </div>
    <div class="comment">
<h1>Comments</h1>




        <div class="comment_form">
            
            <form action="comment_form.php">
                <div class="form_txt">
                    <h2>Name :</h2>
                    <input name="name" type="text" placeholder="Enter your name">
                    
                    <h2>Comment:</h2>
                    
                    <textarea name='comment' cols="20" rows="1" type="text" placeholder="Message"></textarea>
                </div>
                    
                <button name='submit'>Submit</button>
            </form>
            <div class="user_comments">
                    <h1>Blog Comments</h1>
                <?php 
                // $sql4="SELECT * from comment where blog_id = '$id'";
                $sql4="SELECT * FROM comment where comment.blog_id='$id'";
                $result4=mysqli_query($conn,$sql4);
                $row4=mysqli_num_rows($result4);
                if($row4){
                    $count=0;
                    while($post4=mysqli_fetch_assoc($result4) ){
                        ?>
                        <div class="user_comment">
                            <div class="user_comments_flex" style="display: flex;">
                                <h3 for="">Name: </h3><h3><?= $post4['name']?></h3>
                            </div>
                            <div class="user_comments_flex" style="display: flex;">
                            <p>Comment: </p>
                            <p><?= $post4['comment']?></p>
                            </div>
                        </div>
                        <?php

}


}
?>  
</div>

        </div>
   
    </div>

    <div class="fotter">
        <div class="fotter_main">
            <div class="fotter_main_box1">
                <h1><a style="text-decoration: none;" class="Soul">Soul</a>Scripter </h1>
                <p>Step into the boundless cosmos of written artistry. <a style="text-decoration: none;" class="Soul">Soul</a> Scripter weaves ethereal tales, poetic verses, and insightful musings, inviting you on a journey through the depths of the human <a style="text-decoration: none;" class="Soul">soul</a>.</p>
                <h3>Mobile: 9XXXXXXX</h3>
                <h3>soulscripter@gmail.com</h3>
            </div>
            <div class="fotter_main_box2">
                <h1>Contact Us</h1>
                <form action="comment_form.php">
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
    </div>
</body>
</html>