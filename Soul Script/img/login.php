<?php 
    session_start();
    if (isset($_SESSION['user_data'])){
        header('location: ./user.php');
    }  
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="./css/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="./css/registration.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2&display=swap" rel="stylesheet">
 
   
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
    <div class="registration">
    <form class="card"  method="post">

        <h1>Login</h1>
            <input name="dmail" type="text" placeholder="Email" required>
            <input name="dpass" type="password" placeholder="Password" required>
    
        <button id="dbtn">Login</button>
    <p>Don't have account <a href="./registration.html">Sign Up</a> now</p>
    </form>
    </div>
    
    <?php
    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Establish database connection
    $dbHost = "localhost";
    $dbUser = "root";
    $Password = '';
    $dbName = "blog";
    


    $conn = mysqli_connect($dbHost, $dbUser, $Password, $dbName);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $username = mysqli_real_escape_string($conn,$_POST['dmail']);
    $password = mysqli_real_escape_string($conn,sha1($_POST['dpass']));
    
    
    if(isset($_SESSION['error'])){
        $error=$_SESSION['error'];
        echo $error;
        unset($_SESSION['error']);
    }

    // Perform authentication
    $query = "SELECT * FROM `user` WHERE  email='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $user=mysqli_fetch_assoc($result);
        $user_data = array($user['user_id'],$user['username'],$user['email'],$user['password']);
        $_SESSION['user_data']=$user_data;
        header("Location: ./user.php");
        echo 'login';
    } else {
        // $_SESSION['error']= "Login failed. Please try again.";
        // header('location: ./login.php');
        echo '<p style="background:red;margin:0 30rem; border:none;color:white;">"Invalid Login/Password"</p>';
    }

    
    mysqli_close($conn);
}
?>





</body>

</html>
