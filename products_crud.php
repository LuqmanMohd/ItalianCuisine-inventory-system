<?php

include_once 'database.php';

// $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$extention = ['jpg', 'jpeg', 'gif'];
function uploadPhoto($file, $id)
{
  global $extention;
  $target_dir = "products/";
  $imageFileType = strtolower(pathinfo(basename($file["name"]), PATHINFO_EXTENSION));
  
  $newfilename = "{$id}.{$imageFileType}";

  if ($file['error'] == 4)
    return 4;
    // Check if image file is a actual image or fake image
  if (!getimagesize($file['tmp_name']))
    return 0;
    // Check file size
  if ($file["size"] > 10000000)
    return 1;
    // Allow certain file formats
  if (!in_array($imageFileType, $extention))
    return 2;

  if (!move_uploaded_file($file["tmp_name"], $target_dir.$newfilename))
    return 3;

  return array('status' => 200, 'name' => $newfilename, 'ext' => $imageFileType);
}

//Create
if (isset($_POST['create'])) {
  if ($_SESSION['role'] == 'admin') {
    $uploadStatus = uploadPhoto($_FILES['fileToUpload'], $_POST['pid']);
    if (isset($uploadStatus['status'])) {


try {

    $stmt = $conn->prepare("INSERT INTO tbl_products_a175128_pt2(FLD_PRD_ID,
      FLD_PRD_NAME, FLD_PRD_PRICE, FLD_PRD_TYPE, FLD_PRD_MENU,
      FLD_PRD_BRAND, FLD_PRD_DESCRIPTION, FLD_PRD_IMAGE) VALUES(:pid, :name, :price, :type,
      :menu, :brand, :desc, :image)");

    $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':price', $price, PDO::PARAM_INT);
    $stmt->bindParam(':type', $type, PDO::PARAM_STR);
    $stmt->bindParam(':menu', $menu, PDO::PARAM_STR);
    $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
    $stmt->bindParam(':desc', $desc, PDO::PARAM_STR);
    $stmt->bindParam(':image', $uploadStatus['name']);

    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $type =  $_POST['type'];
    $menu = $_POST['menu'];
    $brand = $_POST['brand'];
    $desc = $_POST['desc'];

    $stmt->execute();

  }
catch(PDOException $e){
        $_SESSION['error'] = "Error while Creating: " . $e->getMessage();
      }

    } else {
      if ($uploadStatus == 0)
        $_SESSION['error'] = "Please make sure the file uploaded is an image.";
      elseif ($uploadStatus == 1)
        $_SESSION['error'] = "Sorry, only file with below 10MB are allowed.";
      elseif ($uploadStatus == 2)
        $_SESSION['error'] = "Sorry, only ".join(", ",$extention)." files are allowed.";
      elseif ($uploadStatus == 3)
        $_SESSION['error'] = "Sorry, there was an error uploading your file.";
      elseif ($uploadStatus == 4)
        $_SESSION['error'] = 'Please upload an image.';
      elseif ($uploadStatus == 5)
        $_SESSION['error'] = 'File already exists. Please rename your file before upload.';
      else
        $_SESSION['error'] = "An unknown error has been occurred.";
    }
  } else {
    $_SESSION['error'] = "Sorry, but you don't have permission to create a new product.";
  }
  header("LOCATION: {$_SERVER['REQUEST_URI']}");
  exit();
}

//Update
if (isset($_POST['update'])) {
  if ($_SESSION['role'] == 'admin')  {
    try {
      $stmt = $conn->prepare("UPDATE tbl_products_a175128_pt2 SET FLD_PRD_ID = :pid,
      FLD_PRD_NAME = :name, FLD_PRD_PRICE = :price, FLD_PRD_TYPE = :type,
      FLD_PRD_MENU = :menu, FLD_PRD_BRAND = :brand, FLD_PRD_DESCRIPTION = :desc
      WHERE FLD_PRD_ID = :oldpid LIMIT 1");

   $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':price', $price, PDO::PARAM_INT);
    $stmt->bindParam(':type', $type, PDO::PARAM_STR);
    $stmt->bindParam(':menu', $menu, PDO::PARAM_STR);
    $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
    $stmt->bindParam(':desc', $desc, PDO::PARAM_STR);
    $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);

    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $type =  $_POST['type'];
    $menu = $_POST['menu'];
    $brand = $_POST['brand'];
    $desc = $_POST['desc'];
    $oldpid = $_POST['oldpid'];

    $stmt->execute();

    // header("Location: products.php");

      $flag  = uploadPhoto($_FILES['fileToUpload'], $_POST['pid']);

      if (isset($flag['status'])){
        $stmt = $conn->prepare("UPDATE tbl_products_a175128_pt2 SET FLD_PRD_IMAGE = :image WHERE FLD_PRD_ID = :pid LIMIT 1");
        $stmt->bindParam(':image', $flag['name']);
        $stmt->bindParam(':pid', $pid);
        $stmt->execute();
        //kt product.php line 138
        if(pathinfo(basename($_POST['filename']), PATHINFO_EXTENSION)!=$flag['ext'])
          unlink("products/{$_POST['filename']}");
      } elseif ($flag != 4) {
        if ($flag == 0)
          $_SESSION['error'] = "Please make sure the file uploaded is an image.";
        elseif ($flag == 1)
          $_SESSION['error'] = "Sorry, only file with below 10MB are allowed.";
        elseif ($flag == 2)
          $_SESSION['error'] = "Sorry, only ".join(", ",$extention)." files are allowed.";
        elseif ($flag == 3)
          $_SESSION['error'] = "Sorry, there was an error uploading your file.";
        else
          $_SESSION['error'] = "An unknown error has been occurred.";
      }
      clearstatcache();//saja sebab kadang2 tk clear cache
    }
    catch(Exception $e){
      $_SESSION['error'] = "Error while Updating: " . $e->getMessage();
    }
  }
  else {
    $_SESSION['error'] = "Sorry, but you don't have permission to update this product.";
    header("LOCATION: {$_SERVER['PHP_SELF']}");
    exit();
  }

  if (isset($_SESSION['error']))
    header("LOCATION: {$_SERVER['REQUEST_URI']}");
  else
    header("Location: {$_SERVER['PHP_SELF']}");
  exit();
}


//Delete

if (isset($_GET['delete'])) {
  if ($_SESSION['role'] == 'admin') {
    try {
      $pid = $_GET['delete'];
      $query = $conn->query("SELECT FLD_PRD_IMAGE FROM tbl_products_a175128_pt2 WHERE FLD_PRD_ID = '{$pid}' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
      if (isset($query['FLD_PRD_IMAGE'])) {
      // Delete Query
        $stmt = $conn->prepare("DELETE FROM tbl_products_a175128_pt2 WHERE FLD_PRD_ID = :pid");
    $stmt->bindParam(':pid', $pid);
    $pid = $_GET['delete'];
    $stmt->execute();
      // Delete Image
        unlink("products/{$query['FLD_PRD_IMAGE']}");
      }
    }
    catch(PDOException $e)
    {
      $_SESSION['error'] = "Error while Deleting: " . $e->getMessage();
    }
  } else {
    $_SESSION['error'] = "Sorry, but you don't have permission to delete this product.";
  }
  header("LOCATION: {$_SERVER['PHP_SELF']}");
  exit();
}


//Edit
if (isset($_GET['edit'])) {
  if ($_SESSION['role'] == 'admin')  {
    try {
      $stmt = $conn->prepare("SELECT * FROM tbl_products_a175128_pt2 WHERE FLD_PRD_ID = :pid");

    $stmt->bindParam(':pid', $pid);

    $pid = $_GET['edit'];

    $stmt->execute();

    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e){
      $_SESSION['error'] = "Error while Editing: " . $e->getMessage();
    }
  } else {
    $_SESSION['error'] = "Sorry, but you don't have permission to edit a product.";
  }
  if (isset($_SESSION['error'])) {
    header("LOCATION: {$_SERVER['PHP_SELF']}");
    exit();
  }
}
?>