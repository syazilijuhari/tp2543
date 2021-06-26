<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
      $stmt = $conn->prepare("INSERT INTO tbl_staffs_a173630_pt2(fld_staff_id, fld_staff_name, fld_staff_phone, fld_staff_email, fld_staff_role) VALUES(:staff_id, :staff_name, :staff_phone, :staff_email, :staff_role)");
     
      $stmt->bindParam(':staff_id', $sid, PDO::PARAM_STR);
      $stmt->bindParam(':staff_name', $sname, PDO::PARAM_STR);
      $stmt->bindParam(':staff_phone', $sphone, PDO::PARAM_STR);
      $stmt->bindParam(':staff_email', $semail, PDO::PARAM_STR);
      $stmt->bindParam(':staff_role', $srole, PDO::PARAM_STR);
         
      $sid = $_POST['staff_id'];
      $sname = $_POST['staff_name'];
      $sphone = $_POST['staff_phone'];
      $semail = $_POST['staff_email'];
      $srole = $_POST['staff_role'];
           
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
 
      $stmt = $conn->prepare("UPDATE tbl_staffs_a173630_pt2 SET fld_staff_id = :staff_id, fld_staff_name = :staff_name, fld_staff_phone = :staff_phone, fld_staff_email = :staff_email, fld_staff_role = :staff_role WHERE fld_staff_id = :oldsid");
     
      $stmt->bindParam(':staff_id', $sid, PDO::PARAM_STR);
      $stmt->bindParam(':staff_name', $sname, PDO::PARAM_STR);
      $stmt->bindParam(':staff_phone', $sphone, PDO::PARAM_STR);
      $stmt->bindParam(':staff_email', $semail, PDO::PARAM_STR);
      $stmt->bindParam(':staff_role', $srole, PDO::PARAM_STR);
      $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);
  
      $sid = $_POST['staff_id'];
      $sname = $_POST['staff_name'];
      $sphone = $_POST['staff_phone'];
      $semail = $_POST['staff_email'];
      $srole = $_POST['staff_role'];
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
  $nid = $conn->query("SELECT MAX(fld_staff_id) AS LASTID FROM tbl_staffs_a173630_pt2")->fetch()['LASTID'];
  $nid = ltrim($nid, 'SS')+1;
  $conn = null;
 
?>