<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_staffs_a175128_pt2(FLD_STF_ID, FLD_STF_NAME, FLD_STF_PHONE, FLD_STF_ACC, FLD_STF_STATUS, FLD_STF_ROLE, FLD_STF_EMAIL, FLD_STF_PASS) VALUES(:sid, :name, :phone, :acc, :status, :role, :email, :pass)");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':acc', $acc, PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':role', $role, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);

    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $phone =  $_POST['phone'];
    $acc = $_POST['acc'];
    $status = $_POST['status'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Update
if (isset($_POST['update'])) {
   
  try {
 
    $stmt = $conn->prepare("UPDATE tbl_staffs_a175128_pt2 SET
      FLD_STF_ID = :sid, FLD_STF_NAME = :name,
      FLD_STF_PHONE = :phone, FLD_STF_ACC = :acc, FLD_STF_STATUS = :status, FLD_STF_ROLE = :role, FLD_STF_EMAIL = :email, FLD_STF_PASS = :pass
      WHERE FLD_STF_ID = :oldsid");
   
   $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':acc', $acc, PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':role', $role, PDO::PARAM_STR);
    $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);

        
    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $phone =  $_POST['phone'];
    $acc = $_POST['acc'];
    $status = $_POST['status'];
    $oldsid = $_POST['oldsid'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $stmt->execute();
 
    header("Location: staffs.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_staffs_a175128_pt2 where FLD_STF_ID = :sid");
   
    $stmt->bindParam(':sid', $sid);
       
    $sid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: staffs.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
   
  try {
 
    $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a175128_pt2 where FLD_STF_ID = :sid");
   
    $stmt->bindParam(':sid', $sid);
       
    $sid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
  $conn = null;
 
?>