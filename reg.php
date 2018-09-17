<?php
session_start();
require_once('includes/config.php'); 

/* new registration script */
if(isset($_POST['submit'])){
// mengambil data dari $_POST
$username = $_POST['username']; //data dari input username
$password1 = $_POST['password1']; //data dari input password
$password2 = $_POST['password2']; //data dari input confirm password
$email = $_POST['email']; //data dari input email
//selesai mengambil data 
// mengecek apakah password sudah sama 
 if($password1 != $password2){
  echo 'password do not match!';
 }
// pengecekan password selesai
// mengecek apakah username lebih dari batas max
  if(strlen($username > 30)){
    echo 'username too long! max 30 char!';
  }
// pengecekan username selesai
// mengecek apakah semua sudah disisi 
  if($username == "" || $password1 == "" || $password2 == "" || $email == ""){
    echo 'Fill in all the information!';
  }
// pengecekan selesai

//trying new store password system
// A higher "cost" is more secure but consumes more processing power
$cost = 10;

// Prefix information about the hash so PHP knows how to verify it later.
// "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
$salt = sprintf("$2a$%02d$", $cost) . $salt;
// Value:
// $2a$10$eImiTXuWVxfM37uY4JANjQ==

//hash the password with salt
$hash = crypt($password1, $salt);



/* memulai secure password hashing dengan salt */
//$hash = hash('sha512', $password1); //menghash password dengan enkripsi sha512
//membuat fungsi createsalt 
//function createSalt(){ 
// $text = sha1(uniqid(rand(), true));
// return substr($text, 0, 3);
//}
// var salt
//$salt = createSalt();
// password 
// $password = hash('sha512', $salt . $hash);
//memasukkan value ke database 
//sanitize username dulu untuk anti MYSQL INJECT
$username = mysqli_real_escape_string($connect, $username);
$username = stripslashes($username);
//cek apakah user sudah ada
$sql = $connect->query("SELECT * FROM admin WHERE username = '$username'");
$row = mysqli_num_rows($sql); 
if($row == 1){
  echo 'User already exist!';
} else {
//masukkan ke database
$query = "INSERT INTO admin ( username, password, email, salt) VALUES ('$username','$hash','$email','$salt')";
$connect->query($query);
echo 'Registration Success!';
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <title><?php echo $title; ?></title> 
 <link rel="stylesheet" href="css/foundation.css" media="screen" />
 <link rel="stylesheet" href="css/normalize.css" />
  <style>
  /* custom style */
 .panel {
  border-radius: 5px;
 }
 .side-nav {
  border: 1px solid #d9d9d9;
  border-radius: 5px;
  background-color: #f2f2f2;
  padding-left: 20px;
  margin-bottom: 10px;
 }
 .side-nav a:hover {
  background-color: white;
  border-radius: 5px;
  width: 100px;
  padding-left: 5px;
 }
 /* Table custom handling */
 .wdtb1 {
  width: 20px;
 }
 .wdtb2 { width:400px; }
 .wdtb3 { width:80px; }
 .wdtb4 { width:200px; }
 .maintable {
 width: 700px;
 }
 /* end Table custom handling */
 </style>
 
 <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>

<!-- Nav Bar --> 
  <div class="row">
    <div class="large-12 columns">
      <div class="nav-bar right">
       <!-- <ul class="button-group">
         <li><a href="#" class="button">Link 1</a></li>
         <li><a href="#" class="button">Link 2</a></li>
         <li><a href="#" class="button">Link 3</a></li>
         <li><a href="#" class="button">Link 4</a></li>
        </ul> -->
      </div>
      <h1><?php echo $title; ?> <small>Register Area</small></h1>
      <hr />
    </div>
  </div> 
  <!-- End Nav -->
 
  <!-- Main Page Content and Sidebar -->
  <div class="row"> 
    <!-- Main Blog Content -->
    <div class="large-9 columns"> 
      <article>
        <h3>Register for New Admin</h3>
		<hr/>
        <div class="row">
          <div class="large-6 columns">
			<form name="register" method="post" action="#register">
			<tbody>
			 <tr>
			  <td><label>Username:</label></td>
			  <td><input name="username" type="text" placeholder="Username" id="username"></input></td>
			 </tr>
			 <tr>
			  <td><label>Password:</label></td>
			  <td><input name="password1" type="password" placeholder="Password" id="password1" ></input></td>
			 </tr>
			 <tr>
			  <td><label>Confirm Password:</label></td>
			  <td><input name="password2" type="password" placeholder="Confirm Password" id="password2" ></input></td>
			 </tr>
       <tr>
        <td><label>Email:</label></td>
        <td><input name="email" type="text" placeholder="Email" id="email" ></input></td>
       </tr>
			 <tr>
			  <input type="submit" class="button" name="submit" value="Register"></input>
			 </tr>
			</tbody>
			</form>
          </div>
        </div> 
        <p></p>
      </article>
    </div> 
    <!-- End Main Content -->
 
    <!-- Sidebar --> 
    <aside class="large-3 columns"> 
      <h5></h5>
      <ul class="side-nav">
        <li><a href="masuk.php">Login</a></li>
      </ul> 
     
    </aside> 
    <!-- End Sidebar -->
  </div> 
  <!-- End Main Content and Sidebar -->
 
 
  <!-- Footer --> 
  <footer class="row">
    <div class="large-12 columns">
      <hr />
      <div class="row">
        <div class="large-6 columns">
          <p>&copy; 2013. All right reserved.</p>
        </div>
        <div class="large-6 columns">
          <ul class="inline-list right">
            <li><a href="#">Mangaruz</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>