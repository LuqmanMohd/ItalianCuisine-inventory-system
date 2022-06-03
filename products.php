<?php
include_once 'products_crud.php';
// echo $_SESSION['role'];
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
  
  <title>Italian Cuisine : Products</title>
  
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
      input[type="file"] {
        display: none;
      }
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
        <div  class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
          
          <div class="page-header">
            <h2>Create New Product</h2>
          </div>
          <?php
          if (isset($_SESSION['error'])) {
            echo "<p class='text-danger text-center'>{$_SESSION['error']}</p>";
            unset($_SESSION['error']);
          }
          ?>
          <form action="products.php" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="row">
              <div class="form-group">
                <label for="productid" class="col-sm-3 control-label">ID</label>
                <div class="col-sm-9">
                  <input name="pid" type="text" class="form-control" id="productid" placeholder="Product ID" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRD_ID']; ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="productname" class="col-sm-3 control-label">Name</label>
                <div class="col-sm-9">
                  <input name="name" type="text" class="form-control" id="productname" placeholder="Product Name" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRD_NAME']; ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="productprice" class="col-sm-3 control-label">Price</label>
                <div class="col-sm-9">
                 <input name="price" type="number" class="form-control" id="productprice" placeholder="Product Price" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRD_PRICE']; ?>" min="0.0" step="0.01" required>
               </div>
             </div>
             <div class="form-group">
              <label for="producttype" class="col-sm-3 control-label">Type</label>
              <div class="col-sm-9">


               <select name="type" class="form-control" id="producttype" required>
                <option value="">Please select</option>
                
                <option value="Antipasti Starters" <?php if (isset($_GET['edit'])) if ($editrow['FLD_PRD_TYPE'] == "Antipasti Starters" ) echo "selected"; ?> >Antipasti Starters</option>
                <option value="Zuppe Soups" <?php if (isset($_GET['edit'])) if ($editrow['FLD_PRD_TYPE'] == "Zuppe Soups" ) echo "selected"; ?> >Zuppe Soups</option>
                <option value="Pasta e Risotto" <?php if (isset($_GET['edit'])) if ($editrow['FLD_PRD_TYPE'] == "Pasta e Risotto" ) echo "selected"; ?> >Pasta e Risotto</option>
                <option value="Side orders" <?php if (isset($_GET['edit'])) if ($editrow['FLD_PRD_TYPE'] == "Side orders" ) echo "selected"; ?> >Side order</option>
                <option value="Pesce e Crostacei Fish" <?php if (isset($_GET['edit'])) if ($editrow['FLD_PRD_TYPE'] == "Pesce e Crostacei Fish" ) echo "selected"; ?> >Pesce e Crostacei Fish</option>
                <option value="Carne Meat" <?php if (isset($_GET['edit'])) if ($editrow['FLD_PRD_TYPE'] == "Carne Meat" ) echo "selected"; ?> >Carne Meat</option>
                <option value="Pizza" <?php if (isset($_GET['edit'])) if ($editrow['FLD_PRD_TYPE'] == "Pizza" ) echo "selected"; ?> >Pizza</option>
                <option value="Starters" <?php if (isset($_GET['edit'])) if ($editrow['FLD_PRD_TYPE'] == "Starters" ) echo "selected"; ?> >Starters</option>
                <option value="Main Courses" <?php if (isset($_GET['edit'])) if ($editrow['FLD_PRD_TYPE'] == "Main Courses" ) echo "selected"; ?> >Main Courses</option>
                <option value="Main" <?php if (isset($_GET['edit'])) if ($editrow['FLD_PRD_TYPE'] == "Main" ) echo "selected"; ?> >Main</option>
                <option value="GRAPPA" <?php if (isset($_GET['edit'])) if ($editrow['FLD_PRD_TYPE'] == "GRAPPA" ) echo "selected"; ?> >GRAPPA</option>
                <option value="House White Wines" <?php if (isset($_GET['edit'])) if ($editrow['FLD_PRD_TYPE'] == "House White Wines" ) echo "selected"; ?> >House White Wines</option>
                <option value="Red Wines" <?php if (isset($_GET['edit'])) if ($editrow['FLD_PRD_TYPE'] == "Red Wines" ) echo "selected"; ?> >Red Wines</option>
              </select> <br>

            </div>
          </div>  




          <div class="form-group">
            <label for="productmenu" class="col-sm-3 control-label">Menu</label>
            <div class="col-sm-9">


             <select name="menu" class="form-control" id="productmenu" required>

              <option value="">Please select</option>
              
              <option value="Main Menu" <?php if (isset($_GET['edit'])) if ($editrow['FLD_PRD_MENU'] == "Main Menu" ) echo "selected"; ?> >Main Menu</option>
              <option value="SPECIALS" <?php if (isset($_GET['edit'])) if ($editrow['FLD_PRD_MENU'] == "SPECIALS" ) echo "selected"; ?> >SPECIALS</option>
              <option value="Desserts" <?php if (isset($_GET['edit'])) if ($editrow['FLD_PRD_MENU'] == "Desserts" ) echo "selected"; ?> >Desserts</option>
              <option value="Wine" <?php if (isset($_GET['edit'])) if ($editrow['FLD_PRD_MENU'] == "Wine" ) echo "selected"; ?> >Wine</option>
            </select> <br>

          </div>
        </div>   





        <div class="form-group">
          <label for="productdesc" class="col-sm-3 control-label">Description</label>
          <div class="col-sm-9">
            <textarea rows="3" cols="83" name="desc" type="text" class="text-input" required><?php if (isset($_GET['edit'])) echo $editrow['FLD_PRD_DESCRIPTION']?> </textarea> 
          </div>
        </div>





        <div class="form-group">
          <label for="productbrand" class="col-sm-3 control-label">Brand</label>
          <div class="col-sm-9">
            <input name="brand" type="text" class="form-control" id="productbrand" placeholder="Product Brand" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRD_BRAND']; ?>" required>
          </div>
        </div>



        <div class="col-sm-offset-3 col-sm-9" >
          <div class="thumbnail dark-1">
            <img src="products/<?php echo(isset($_GET['edit']) ? $editrow['FLD_PRD_IMAGE'] : '') ?>"
            onerror="this.onerror=null;this.src='products/nophoto.jpg';" id="productPhoto"
            alt="Product Image" style="width: 180px;">
            <div class="caption text-center">
              <h4 id="productImageTitle" style="word-break: break-all;">Product Image</h4>
              <p>
                <label class="btn btn-primary">
                  <input type="file" accept="image/*" name="fileToUpload" id="inputImage"
                  onchange="loadFile(event);"/>
                  <input type="hidden" name="filename" value="<?php echo $editrow['FLD_PRD_IMAGE']; ?>">
                  <span class="glyphicon glyphicon-cloud" aria-hidden="true"></span> Browse
                </label>
                <?php
                if (isset($_GET['edit']) && $editrow['FLD_PRD_IMAGE'] != '') {
                  echo '<a href="#" class="btn btn-danger disabled" role="button">Delete</a>';
                }
                ?>
              </p>
            </div>
          </div>
        </div>

        
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <?php if (isset($_GET['edit'])) { ?>
              
              <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
            <?php } else { ?>
              <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
            <?php } ?>
            <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
          </div>
        </div>
      </div>
    </form>
  </div>
  
</div>


<div class="row">
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
    <div class="page-header">
      <h2>Products List</h2>
    </div>
    <table class="table table-striped table-bordered">
      <tr>
        <th>Product ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Type</th>
        <th>Menu</th>
        <th>Brand</th>
        <th>Description</th>
        <th>Image</th>
        <th></th>
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
        $stmt = $conn->prepare("select * from tbl_products_a175128_pt2 LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
        echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
        ?>   
        <tr>
          <td><?php echo $readrow['FLD_PRD_ID']; ?></td>
          <td><?php echo $readrow['FLD_PRD_NAME']; ?></td>
          <td><?php echo $readrow['FLD_PRD_PRICE']; ?></td>
          <td><?php echo $readrow['FLD_PRD_TYPE']; ?></td>
          <td><?php echo $readrow['FLD_PRD_MENU']; ?></td>
          <td><?php echo $readrow['FLD_PRD_BRAND']; ?></td>
          <td><?php echo $readrow['FLD_PRD_DESCRIPTION']; ?></td>
          <?php if(file_exists('products/'. $readrow['FLD_PRD_IMAGE'])){
            $img = 'products/'.$readrow['FLD_PRD_IMAGE'];
            echo '<td><img data-toggle="modal" data-target="#'.$readrow['FLD_PRD_ID'].'" width=150px; src="products/'.$readrow['FLD_PRD_IMAGE'].'"></td>';
          }
          else{
            $img = 'products/nophoto.jpg';
            echo '<td><img width=70%; data-toggle="modal" data-target="#'.$readrow['FLD_PRD_ID'].'" src="products/nophoto.jpg"'.'></td>';
          }?>

          <div id="<?php echo $readrow['FLD_PRD_ID']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-body">
              <img src="<?php echo $img ?>" class="img-responsive">
            </div>
          </div>


          <td>

            <a href="products_details.php?pid=<?php echo $readrow['FLD_PRD_ID']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>

            <?php
            if($_SESSION['role'] == 'admin'){ ?>
              <a href="products.php?edit=<?php echo $readrow['FLD_PRD_ID']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
              <a href="products.php?delete=<?php echo $readrow['FLD_PRD_ID']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
            <?php } ?>



            
          </td>
        </tr>
        <?php
      }
      $conn = null;
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
          $stmt = $conn->prepare("SELECT * FROM tbl_products_a175128_pt2");
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
          <li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
        }
        for ($i=1; $i<=$total_pages; $i++)
          if ($i == $page)
            echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
          else
            echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
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
<script type="application/javascript">
  var loadFile = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
      var output = document.getElementById('productPhoto');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
    document.getElementById('productImageTitle').innerText = event.target.files[0]['name'];
  };

</script>
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