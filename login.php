  <?php
  include_once 'database.php';

  try{

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    if (isset($_POST['login'])) {

     if(empty($_POST["staffemail"]) || empty($_POST["staffpassword"])){
      $e = '<label>Fill All</label>';
    }else{
      $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a175128_pt2 WHERE FLD_STF_EMAIL = :staffemail AND FLD_STF_PASS = :staffpassword");

      $stmt->bindParam(':staffemail', $staffemail, PDO::PARAM_STR);
      $stmt->bindParam(':staffpassword', $staffpassword, PDO::PARAM_STR);
      $staffemail = $_POST['staffemail'];
      $staffpassword = $_POST['staffpassword'];
      $stmt->execute();
      $count = $stmt->rowCount();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if($count > 0){
       session_start();
       $_SESSION["login"]=true;
       $_SESSION["role"] = $result['FLD_STF_ROLE'];
       $_SESSION["name"]=$result['FLD_STF_NAME'];
       $_SESSION["user"]=$result;
       header("location:index.php");

     }else{

       echo "<script>
       alert('wrong email or password');
       window.location.href='index1.php';
       </script>";
     }
   }
 }
}
catch(PDOException $e)
{
 echo "Error: " . $e->getMessage();
}


?>


<?php
   //session_start();
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
        /*body{
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
          }*/

        </style>
        <link href="login.css" rel="stylesheet">

      </head>
      <body>

        <div class="form-structor">
          <div class="signup">
            <h2 class="form-title" id="signup"><span>or</span>Hint</h2>
            <div style="text-align:center;" class="form-holder">
             <h4>Admin user:</h4>
             <h4>hakim@bok.com</h4>
             <h4>admin123</h4>
             <h4>.</h4>
             <h4>Staff user:</h4>
             <h4>muhammad@bok.com</h4>
             <h4>123</h4>           
           </div>
           </div>
           <form  action="login.php" method="post"  class="login slide-up">
            <div class="center">
              <!-- <form action="login.php" method="post" > -->
                <h2 class="form-title" id="login"><span>or</span>Log in</h2>
                <div class="form-holder">
                  <input name="staffemail" type="email" class="input" placeholder="Email" />
                  <input name="staffpassword" type="password" class="input" placeholder="Password" />
                </div>
                <button class="submit-btn" name="login" >Log in</button>
              </form>

            </div>
          </div>

          <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
          <!-- Include all compiled plugins (below), or include individual files as needed -->
          <script src="js/bootstrap.min.js"></script>
          <script src="login.js"></script>
        </body>
        </html>
