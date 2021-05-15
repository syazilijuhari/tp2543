<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
   
      $stmt = $conn->prepare("INSERT INTO tbl_orders_a173630(fld_order_id, fld_staff_id, fld_customer_id) VALUES(:order_id, :sid, :cid)");
     
      $stmt->bindParam(':order_id', $oid, PDO::PARAM_STR);
      $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
      $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
         
      //$oid = uniqid('O', true);
      $oid = $_POST['order_id'];
      $sid = $_POST['sid'];
      $cid = $_POST['cid'];
       
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
 
      $stmt = $conn->prepare("UPDATE tbl_orders_a173630 SET fld_staff_id = :sid, fld_customer_id = :cid WHERE fld_order_id = :order_id");
     
      $stmt->bindParam(':order_id', $oid, PDO::PARAM_STR);
      $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
      $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
         
      $oid = $_POST['order_id'];
      $sid = $_POST['sid'];
      $cid = $_POST['cid'];
       
      $stmt->execute();
   
      header("Location: orders.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
      $stmt = $conn->prepare("DELETE FROM tbl_orders_a173630 WHERE fld_order_id = :order_id");
     
      $stmt->bindParam(':order_id', $oid, PDO::PARAM_STR);
         
      $oid = $_GET['delete'];
       
      $stmt->execute();
   
      header("Location: orders.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
   
    try {
 
      $stmt = $conn->prepare("SELECT * FROM tbl_orders_a173630 WHERE fld_order_id = :order_id");
     
      $stmt->bindParam(':order_id', $oid, PDO::PARAM_STR);
         
      $oid = $_GET['edit'];
       
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