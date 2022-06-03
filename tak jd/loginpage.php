<?php
 //session_start();
include ('login.php');
if(isset($_SESSION['login_user'])){
  header("location: index.php");
  }

 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Italian Cuisine : Login</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      body{
      width:100%;
        height:100%;
        background: url(background1.jpg)no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
      }

      table{
        background-color: white;
      }

      h2{
        font-size: 40px; 
        color: white;
      }

      .page-header{
        background-color: crimson;
        text-align: center; 
      }

      .form-horizontal{
        background: white;        
        padding: 35px;
      }

    </style>
</head>
<body>
  
  <script>alert('Administrator: \nUsername: hakim@bok.com \npassword:admin123 \n\nStaff:\nUsername: luqman@bok.com \npassword:123 ')</script>
  <div class="container-fluid">

    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>LOGIN</h2>
      </div>

  <form action="login.php" method="post" class="form-horizontal">

  <div class="form-group">
          <label for="username" class="col-sm-3 control-label">Email address</label>
          <div class="col-sm-9">
  <input name="staffemail" type="text "placeholder="Email address" required> 
  </div>
    </div>

  <div class="form-group">
          <label for="password" class="col-sm-3 control-label">Password</label>
          <div class="col-sm-9">
  <input name="staffpassword" type="Password" placeholder="Password" required> 
  </div>
    </div>

  <div class="form-group">
         <div class="col-sm-offset-3 col-sm-9">
  <input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_id']; ?>">
  
  <button type="submit" name="login"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Login</button>
  
  <button type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
  </div>
    </div>
    </div>
  </form>
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>