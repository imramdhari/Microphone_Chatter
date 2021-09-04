<?php 
  
// include database and object files

include_once 'server.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>
  <div class="header">
  	<h2>Microphone Chatter Opinions</h2>
  </div>
	 
  <form method="post" action= "">
  	
  	<div class="input-group">
  		<label>User Name</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
		  <p>
  		Dashboard <a href="../../index.php">Click Here To Back On Home Page</a></p>
  	</p>
  </form>
</body>
</html>
 