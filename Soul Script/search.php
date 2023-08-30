<?php
include 'config.php';
$keyword=$_GET['keyword'];
if(empty($keyword)){
    header("location:index.php");
}
// Pagination
if(!isset($_GET['page'])){
    $page=1;
}
else{
    $page=$_GET['page'];
}
$limit=4;
$offset=($page-1)*$limit;


$sql="SELECT * FROM blog LEFT JOIN user ON blog.authod_id=user.user_id WHERE title like '%$keyword%' OR blog_blog like '%$keyword%' ORDER BY blog.publish_date ASC";
$sql2="SELECT * FROM blog WHERE title like '%$keyword%' OR blog_blog like '%$keyword%' ORDER BY blog.publish_date DESC limit $offset,$limit";
$run2=mysqli_query($conn,$sql2);
$run=mysqli_query($conn,$sql);
$row=mysqli_num_rows($run);   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soul Scripter</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2&display=swap" rel="stylesheet">
<link href="./css/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
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

    <h1 style="text-align:center;color:white;font-size:2.4rem;">Search Result for: <span><?= $keyword?></span> </h1>
    <div style="display: flex;
    justify-content: center;
    padding: 5rem;" class="card">
    <?php
    if($row){ 
    while($posts=mysqli_fetch_assoc($run2)){ ?>
            <?php $img=$posts['blog_image'];?>
            <div style="padding: 1rem 1rem;
    margin: 1rem 0.6rem;
    border-radius: 15px;
    width: 100%;
    text-align: center;
    background: #0B0B0B;" class="card_main">
             <a style="text-decoration:none;background:#0B0B0B0B;" href="blog.php?id=<?=$posts['blog_id'] ?>" ><img style="text-align: center;
    background:#0b0b0b0b;
    width: 12rem;
    border-radius: 15px;" src="upload/<?= $img ?>" alt=""></a>
                <h1 style="text-align:center;background:#0b0b0b0b;padding:1rem;font-size:1.2rem;"><a style="text-decoration:none;background:#0B0B0B0B;" href="blog.php?id=<?=$posts['blog_id'] ?>" ><?= strip_tags(substr(($posts['title']),0,15))?></a></h1>
                <p style="text-align:center;background:#0b0b0b0b;"><a style="text-decoration:none;background:#0B0B0B0B;" href="blog.php?id=<?=$posts['blog_id'] ?>" ><?= strip_tags(substr($posts['blog_blog'],0,100))?></a></p>

            </div>
            <?php } 
            }else{
                echo '<h5>No record Found</h5>
                <b>Suggestions:</b>
                <li>Make sure that words are spelled correctly.</li>';

            }  
            ?>
        </div>
    <?php 
        $pagination="SELECT * FROM blog WHERE title like '%$keyword%' OR blog_blog like '%$keyword%'";
        $run_q=mysqli_query($conn,$pagination);
        $total_post=mysqli_num_rows($run_q);
        $pages=ceil($total_post/$limit);
        ?>
        <ul style='    display: flex;
    padding: 1rem;
    justify-content: center;
    margin: 1rem;'>
            <?php for ($i=1;$i<=$pages;$i++){?>
        <li style='padding: 0.5rem 1.5rem;
    text-decoration: none;
    list-style: none;
    background: #FE4233;
    cursor:pointer;
    margin: 0 1rem;
    border: #FE4233;
    border-radius: 10px;
    color: black;
    font-size: 1.4rem;
    font-weight: 500;'><a style="text-decoration: none;
    background: #FE4233;
    cursor: pointer;" href="search.php?keyword=<?=$keyword?>&page=<?=$i?>">
        <?=$i?>
    </a>
    </li>
        <?php } ?>
        </ul>
    <!-- <div class="recent">
        <div class="recent_main">
            <h1>Recent Posts</h1>
            <div class="recent_main_boxes">
                <div class="recent_main_box1">
                    <img src="./img/recent_main_box1.png" alt="">
                    <h3>Space is incomprehensibly vast</h3>
                    <p>The observable universe is estimated to be around 93 billion light-years in diameter. It contains billions of galaxies, each with billions of stars and possibly even more planets.</p>
                </div>
                <div class="recent_main_box2">
                    <div class="recent_main_box2_1">
                        <img src="./img/recent_main_box2_1.png" alt="">
                        <div class="recent_main_box2_1_text">
                            <h2>Cosmic Microwave Background:</h2>
                            <p>The cosmic microwave background (CMB) is the faint radiation that fills the entire universe. It is residual heat from the Big Bang, and its discovery in 1965 provided strong evidence for the Big Bang</p>
                        </div>
                    </div>
                    <div class="recent_main_box2_2">
                        <img src="./img/recent_main_box2_2.png" alt="">
                        <div class="recent_main_box2_1_text">
                            <h2>Cosmic Microwave Background:</h2>
                            <p>The cosmic microwave background (CMB) is the faint radiation that fills the entire universe. It is residual heat from the Big Bang, and its discovery in 1965 provided strong evidence for the Big Bang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
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
    </div>
</body>
</html>