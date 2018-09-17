<?php
session_start();
require('includes/config.php');

//admin udah login? klo udah langsung ke index.php
if(isset($_SESSION['username'])){
 header("location:index.php");
}

//new login script
if(isset($_POST['submit'])){
//seperti biasa deklarasi variable dari $_POST
$username = $_POST['username'];
$password = $_POST['password'];
//anti sql injection
$username = mysqli_real_escape_string($connect, $username);
$username = stripslashes($username);
//anti sql end
//$query = "SELECT password
//        FROM admin
//        WHERE username = '$username' 
//        LIMIT 1
//        ";
 
//$result = $connect->query($query);
 
//if(mysqli_num_rows($result) == 0) // userr gak ada redirect ke login lagi 
//{
//    echo "user doesn't exist!";
//}
$sth = $dbh->prepare('
  SELECT
    hash
  FROM admin
  WHERE
    username = :username
  LIMIT 1
  ');

$sth->bindParam(':username', $username);

$sth->execute();

$user = $sth->fetch(PDO::FETCH_OBJ);
if(!function_exists('hash_equals'))
{
    function hash_equals($str1, $str2)
    {
        if(strlen($str1) != strlen($str2))
        {
            return false;
        }
        else
        {
            $res = $str1 ^ $str2;
            $ret = 0;
            for($i = strlen($res) - 1; $i >= 0; $i--)
            {
                $ret |= ord($res[$i]);
            }
            return !$ret;
        }
    }
}
//$userData = mysqli_fetch_array($result, MYSQL_ASSOC);
//$hash = hash('sha512', $userData['salt'] . hash('sha512', $password) );
 
if(hash_equals($user->hash, crypt($password, $user->hash)))                                 //($hash != $userData['password']) // password salah echo in
{
    header('Location: index.php');
    $_SESSION['username'] = $username;
    //echo "WRONG PASSWORD!"; 
}else{ // password bener, redirect ke index.php
  //header('Location: index.php');
  //$_SESSION['username'] = $username;
    echo "Wrong Password!";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title><?php echo $title; ?></title>
<link href="css/main.css" rel="stylesheet"/>
</head>

<body class="nobg login-page">




<!-- Main content wrapper -->
<div class="login-wrapper">
    
    <div class="widget">
        <div class="title"><img src="images/icons/light/user.png" alt="" class="title-icon" /><h6><?php echo $title; ?> Login Panel</h6></div>
        <form name="login" method="post" action="#logged-in?" id="validate" class="form">
            <fieldset>
                <div class="form-row">
                    <label for="login">Username:</label>
                    <div class="login-input"><input type="text" name="username" placeholder="Username" /></div>
                    <div class="clear"></div>
                </div>
                
                <div class="form-row">
                    <label for="pass">Password:</label>
                    <div class="login-input"><input type="password" name="password" placeholder="Password" /></div>
                    <div class="clear"></div>
                </div>
                
                <div class="login-controllers">
                    <input type="submit" name="submit" value="Login"/>
                    <div class="clear"></div>
                </div>
            </fieldset>
        </form>
    </div>
</div>    




</body>
</html>