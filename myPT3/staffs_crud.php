<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
      $stmt = $conn->prepare("INSERT INTO tbl_staffs_a173630_pt2(fld_staff_id, fld_staff_name, fld_staff_phone) VALUES(:staff_id, :staff_name, :staff_phone)");
     
      $stmt->bindParam(':staff_id', $sid, PDO::PARAM_STR);
      $stmt->bindParam(':staff_name', $sname, PDO::PARAM_STR);
      $stmt->bindParam(':staff_phone', $sphone, PDO::PARAM_STR);
         
      $sid = $_POST['staff_id'];
      $sname = $_POST['staff_name'];
      $sphone = $_POST['staff_phone'];
           
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
 
      $stmt = $conn->prepare("UPDATE tbl_staffs_a173630_pt2 SET fld_staff_id = :staff_id, fld_staff_name = :staff_name, fld_staff_phone = :staff_phone WHERE fld_staff_id = :oldsid");
     
      $stmt->bindParam(':staff_id', $sid, PDO::PARAM_STR);
      $stmt->bindParam(':staff_name', $sname, PDO::PARAM_STR);
      $stmt->bindParam(':staff_phone', $sphone, PDO::PARAM_STR);
      $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);
  
      $sid = $_POST['staff_id'];
      $sname = $_POST['staff_name'];
      $sphone = $_POST['staff_phone'];
      $oldsid = $_POST['oldsid']; 
           
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
 
      $stmt = $conn->prepare("DELETE FROM tbl_staffs_a173630_pt2 WHERE fld_staff_id = :staff_id");
     
      $stmt->bindParam(':staff_id', $sid, PDO::PARAM_STR);
         
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
 
      $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a173630_pt2 WHERE fld_staff_id = :staff_id");
     
      $stmt->bindParam(':staff_id', $sid, PDO::PARAM_STR);
         
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