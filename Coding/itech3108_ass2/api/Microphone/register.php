<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration</title>
  <link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>
  <div class="header">
  	<h2>Microphone Chatter Opinions</h2>
  </div>
	
  <form method="post" action="register.php">
  	
	<div class="input-group">
  	  <label>User ID</label>
  	  <input type="text" name="userid" >
  	</div>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username">
  	</div>

  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
	  <p>
  		Dashboard <a href="../../index.php">Click Here To Back On Home Page</a>
  	</p>
  </form>
</body>
</html>


