<?php
include_once 'database.php';
?>

 <?php
// session_start();
if(!$_SESSION["login"]){
   header("location:login.php");
   die;
}?>

<!--
  Matric Number: A175128
  Name: NIK MUHAMMAD LUQMAN HAKIM BIN MOHD ROZAKI
-->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Italian Cuisine : Products Details</title>
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
      margin: 0;
    font-family: 'Roboto Mono', monospace;
  }
    header{
      text-align: center;
      padding-top: 8px;
      padding-bottom: 8px;
      font-weight: 500;
    }
    header a{
      text-decoration: none;
    }
    #products-form{
      margin: 64px auto;
    }
    input{
      margin-bottom: 8px;
    }
    select{
      margin-bottom: 8px;
    }
    .table-product, th, td{
      margin: 48px auto;
      border: 1px solid black;
    }
    th, td{
      padding: 8px;
    }
    caption{
      font-size: 24px;
    }

  </style>
</head>
<body>
 
<?php include_once 'nav_bar.php'; ?>
 
<?php
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM tbl_products_a175128_pt2  WHERE FLD_PRD_ID  = :pid");
  $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
    $pid = $_GET['pid'];
  $stmt->execute();
  $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
  }
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
 
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 well well-sm text-center">
        <?php if(file_exists('products/'. $readrow['FLD_PRD_IMAGE'])){
          echo '<img style="width:100%" src="products/'.$readrow['FLD_PRD_IMAGE'].'" class="img-responsive">';
        }
        else{
          echo '<img src="products/nophoto.jpg"'.' class="img-responsive">';
        }?>
      </div>
    <div class="col-xs-12 col-sm-5 col-md-4">
      <div class="panel panel-default">
      <div class="panel-heading"><strong>Product Details</strong></div>
      <div class="panel-body">
          Below are specifications of the product.
      </div>
      <table class="table">
        <tr>
          <td class="col-xs-4 col-sm-4 col-md-4"><strong>Product ID</strong></td>
          <td><?php echo $readrow['FLD_PRD_ID'] ?></td>
        </tr>
        <tr>
          <td><strong>Name</strong></td>
          <td><?php echo $readrow['FLD_PRD_NAME'] ?></td>
        </tr>
        <tr>
          <td><strong>Price</strong></td>
          <td>RM <?php echo $readrow['FLD_PRD_PRICE'] ?></td>
        </tr>
        <tr>
          <td><strong>Type</strong></td>
          <td><?php echo $readrow['FLD_PRD_TYPE'] ?></td>
        </tr>
        <tr>
          <td><strong>Menu</strong></td>
          <td><?php echo $readrow['FLD_PRD_MENU'] ?></td>
        </tr>
        <tr>
          <td><strong>Brand</strong></td>
          <td><?php echo $readrow['FLD_PRD_BRAND'] ?></td>
        </tr>
        <tr>
          <td><strong>Description</strong></td>
          <td><?php echo $readrow['FLD_PRD_DESCRIPTION'] ?></td>
        </tr>
      </table>
      </div>
    </div>
  </div>
</div>
 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
 
</body>
</html>