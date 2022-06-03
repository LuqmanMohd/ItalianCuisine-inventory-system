<?php
include_once 'customers_crud.php';
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
  
  <title>Italian Cuisine : Customers</title>

  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&display=swap" rel="stylesheet">
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
  <div class="container-fluid">
    <div id="form" class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="page-header">
          <h2>Create New Customer</h2>
        </div>
        <form action="customers.php" method="post" class="form-horizontal">
          <div class="form-group">
          <label for="customerid" class="col-sm-3 control-label">ID</label>
          <div class="col-sm-9">
          <input name="cid" type="text" class="form-control" id="customerid" placeholder="Customer ID" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_CUST_ID']; ?>" required>
        </div>
        </div>

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-9">
              <input name="name" type="text" class="form-control" id="name" placeholder="Name" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_CUST_NAME']; ?>" required />
            </div>
          </div>

          <div class="form-group">
            <label for="phone" class="col-sm-3 control-label">Phone Number</label>
            <div class="col-sm-9">
              <input name="phone" type="text" class="form-control" id="phone" placeholder="Phone Number" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_CUST_PHONE']; ?>" required />
            </div>
          </div>

          <div class="form-group">
            <label for="address" class="col-sm-3 control-label">Address</label>
            <div class="col-sm-9">
              <textarea name="address" type="text" class="form-control" id="address" placeholder="Address" rows="5" style="resize:none;" required><?php if(isset($_GET['edit'])) echo $editrow['FLD_CUST_ADDRESS']; ?></textarea>
            </div>
          </div>


          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              <?php if (isset($_GET['edit'])) { ?>
                <input type="hidden" name="oldcid" value="<?php echo $editrow['FLD_CUST_ID']; ?>">
                <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
              <?php } else { ?>
                <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
              <?php } ?>
              <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
            </div>
          </div>
        </form>
      </div>
    </div>

      <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        <div class="page-header">
          <h2>Customer List</h2>
        </div>
        <table class="table table-striped table-bordered">
          <tr>
            <th>Customer ID</th>
            <th>Full Name</th>
            <th>Phone Number</th>
            <th>Adress</th>
            <?php
              if($_SESSION['role'] == 'admin') echo '<th>MANAGE</th>'
            ?>
          </tr>
          <?php
          // Read
          $per_page = 5;
          if (isset($_GET["page"]))
            $page = $_GET["page"];
          else
            $page = 1;
          $start_from = ($page-1) * $per_page;
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("select * from tbl_customers_a175128_pt2 LIMIT {$start_from}, {$per_page}");
            $stmt->execute();
            $result = $stmt->fetchAll();
          }
          catch(PDOException $e){
            echo "Error: " . $e->getMessage();
          }
          foreach($result as $readrow) {
            ?>   
            <tr>
              <td><?php echo $readrow['FLD_CUST_ID']; ?></td>
              <td><?php echo $readrow['FLD_CUST_NAME']; ?></td>
              <td><?php echo $readrow['FLD_CUST_PHONE']; ?></td>
              <td><?php echo $readrow['FLD_CUST_ADDRESS']; ?></td>
              <?php
                if($_SESSION['role'] == 'admin'){ ?>
                  <td>
                    <a href="customers.php?edit=<?php echo $readrow['FLD_CUST_ID']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
                <a href="customers.php?delete=<?php echo $readrow['FLD_CUST_ID']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
                  </td>
              <?php } ?>
            </tr>
            <?php
          }
          ?>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        <nav>
          <ul class="pagination">
            <?php
            try {
              $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $stmt = $conn->prepare("SELECT * FROM tbl_customers_a175128_pt2");
              $stmt->execute();
              $result = $stmt->fetchAll();
              $total_records = count($result);
            }
            catch(PDOException $e){
              echo "Error: " . $e->getMessage();
            }
            $total_pages = ceil($total_records / $per_page);
            ?>
            <?php if ($page==1) { ?>
              <li class="disabled"><span aria-hidden="true">«</span></li>
            <?php } else { ?>
              <li><a href="customers.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
              <?php
            }
            for ($i=1; $i<=$total_pages; $i++)
              if ($i == $page)
                echo "<li class=\"active\"><a href=\"customers.php?page=$i\">$i</a></li>";
              else
                echo "<li><a href=\"customers.php?page=$i\">$i</a></li>";
              ?>
              <?php if ($page==$total_pages) { ?>
                <li class="disabled"><span aria-hidden="true">»</span></li>
              <?php } else { ?>
                <li><a href="customers.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
              <?php } ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <?php 
        if($_SESSION['role'] == 'staff'){
          //kalo nk disable form je
          //echo '<script>$("form :input").prop("disabled", true);</script>';

          //kalo nk remove terus form
          echo '<script>$("#form").remove();</script>';
        }
      ?>
  </body>
</html>