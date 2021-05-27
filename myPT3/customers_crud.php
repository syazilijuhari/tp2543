<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
      $stmt = $conn->prepare("INSERT INTO tbl_customers_a173630_pt2(fld_customer_id, fld_customer_name, fld_customer_phone) VALUES(:customer_id, :customer_name, :customer_phone)");
     
      $stmt->bindParam(':customer_id', $cid, PDO::PARAM_STR);
      $stmt->bindParam(':customer_name', $cname, PDO::PARAM_STR);
      $stmt->bindParam(':customer_phone', $cphone, PDO::PARAM_STR);
         
      $cid = $_POST['customer_id'];
      $cname = $_POST['customer_name'];
      $cphone = $_POST['customer_phone'];

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
 
      $stmt = $conn->prepare("UPDATE tbl_customers_a173630_pt2 SET fld_customer_id = :customer_id, fld_customer_name = :customer_name, fld_customer_phone = :customer_phone WHERE fld_customer_id = :oldcid");
     
      $stmt->bindParam(':customer_id', $cid, PDO::PARAM_STR);
      $stmt->bindParam(':customer_name', $cname, PDO::PARAM_STR);
      $stmt->bindParam(':customer_phone', $cphone, PDO::PARAM_STR);
      $stmt->bindParam(':oldcid', $oldcid, PDO::PARAM_STR);
         
      $cid = $_POST['customer_id'];
      $cname = $_POST['customer_name'];
      $cphone = $_POST['customer_phone'];
      $oldcid = $_POST['oldcid'];
       
      $stmt->execute();
   
      header("Location: customers.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_customers_a173630_pt2 WHERE fld_customer_id = :customer_id");
   
    $stmt->bindParam(':customer_id', $cid, PDO::PARAM_STR);
       
    $cid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: customers.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
   
  try {
 
    $stmt = $conn->prepare("SELECT * FROM tbl_customers_a173630_pt2 WHERE fld_customer_id = :customer_id");
   
    $stmt->bindParam(':customer_id', $cid, PDO::PARAM_STR);
       
    $cid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
  $nid = $conn->query("SELECT MAX(fld_customer_id) AS LASTID FROM tbl_customers_a173630_pt2")->fetch()['LASTID'];
  $nid = ltrim($nid, 'SC')+1;
  $conn = null;
 
?>