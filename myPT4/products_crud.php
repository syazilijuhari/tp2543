<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
      $stmt = $conn->prepare("INSERT INTO tbl_products_a173630_pt2(fld_product_id,
        fld_product_name, fld_product_price, fld_product_region, fld_product_year, fld_product_era, fld_product_condition) VALUES(:product_id, :product_name, :product_price, :product_region, :product_year, :product_era, :product_condition)");
      
      $stmt->bindParam(':product_id', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':product_name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':product_price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':product_region', $region, PDO::PARAM_STR);
      $stmt->bindParam(':product_year', $year, PDO::PARAM_INT);
      $stmt->bindParam(':product_era', $era, PDO::PARAM_STR);
      $stmt->bindParam(':product_condition', $condition, PDO::PARAM_STR);
       
      $pid = $_POST['product_id'];
      $name = $_POST['product_name'];
      $price = $_POST['product_price'];
      $region =  $_POST['product_region'];
      $year = $_POST['product_year'];
      $era = $_POST['product_era'];
      $condition = $_POST['product_condition'];
       
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
 
      $stmt = $conn->prepare("UPDATE tbl_products_a173630_pt2 SET fld_product_id = :product_id,
        fld_product_name = :product_name, fld_product_price = :product_price, fld_product_region = :product_region, fld_product_year = :product_year, fld_product_era = :product_era, fld_product_condition = :product_condition WHERE fld_product_id = :oldpid");
     
      $stmt->bindParam(':product_id', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':product_name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':product_price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':product_region', $region, PDO::PARAM_STR);
      $stmt->bindParam(':product_year', $year, PDO::PARAM_INT);
      $stmt->bindParam(':product_era', $era, PDO::PARAM_STR);
      $stmt->bindParam(':product_condition', $condition, PDO::PARAM_STR);
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);
       
      $pid = $_POST['product_id'];
      $name = $_POST['product_name'];
      $price = $_POST['product_price'];
      $region =  $_POST['product_region'];
      $year = $_POST['product_year'];
      $era = $_POST['product_era'];
      $condition = $_POST['product_condition'];
      $oldpid = $_POST['oldpid'];
       
      $stmt->execute();
   
      header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
      $stmt = $conn->prepare("DELETE FROM tbl_products_a173630_pt2 WHERE fld_product_id = :product_id");
     
      $stmt->bindParam(':product_id', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
 
  try {
 
      $stmt = $conn->prepare("SELECT * FROM tbl_products_a173630_pt2 WHERE fld_product_id = :product_id");
     
      $stmt->bindParam(':product_id', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
  $nid = $conn->query("SELECT MAX(fld_product_id) AS LASTID FROM tbl_products_a173630_pt2")->fetch()['LASTID'];
  $nid = ltrim($nid, 'SID')+1;
  $conn = null;
?>