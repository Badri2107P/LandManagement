<?php  //Start the Session
session_start();
 require('connect.php');
//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['username']) and isset($_POST['password'])){
//3.1.1 Assigning posted values to variables.
$username = $_POST['username'];
$password = $_POST['password'];
//3.1.2 Checking the values are existing in the database or not
$query = "SELECT * FROM public.user WHERE username='$username' and password='$password'";
$result = pg_query($connection, $query) or die("Error".pg_last_error());

$count = pg_num_rows($result);
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
if ($count == 1){
$_SESSION['username'] = $username;
}else{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
$fmsg = "Invalid Login Credentials.";
}
}
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['username'])){
$username = $_SESSION['username'];
	header("Location: home.php");
   exit;
 
}else{
//3.2 When the user visits the page first time, simple login form will be displayed.
?>
<html>
<head>
	<title>User Login Using PHP & MySQL</title>
	
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="styles.css" >
 
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Login</title>
</head>
<body>
 <div class="header">
  <a href="index.php" class="logo">CompanyLogo</a>
  </div>
<div class="topnav">
  
    <div class="dropdown ">
   <a href="#" id="Login" class="active">Login</a>
   <a href="/c/usermap.php" id="usermap" >view gis map</a>
   </div>
   </div>
<div class="container">
      <form class="form-signin" method="POST">
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
        <h2 class="form-signin-heading" style="text-align: center;
"> Login</h2>
			<br/>
        <div class="input-group">
	  <input type="text" name="username" class="form-control" placeholder="Username" required style="width:300px;">
	</div>
	<br/>
<label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
       <div class="wrapper"> <button class="btn btn-lg btn-primary btn-block" type="submit" style="width:80px;">Login</button></div>
      </form>
</div>
 
</body>
 
</html>
<?php } ?>