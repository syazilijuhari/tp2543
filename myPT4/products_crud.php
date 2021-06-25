<?php
 
include_once 'database.php';

if (!isset($_SESSION['loggedin']))
    header("LOCATION: login.php");
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
function uploadPhoto($file)
{
    $target_dir = "products/";
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    /*
     * 0 = image file is a fake image
     * 1 = file is too large.
     * 2 = PNG & GIF files are allowed
     * 3 = Server error
     * 4 = No file were uploaded
     */

    if ($file['error'] == 4)
        return 4;

    // Check if image file is a actual image or fake image
    if (!getimagesize($file['tmp_name']))
        return 0;

    // Check file size
    if ($file["size"] > 10000000)
        return 1;

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "gif")
        return 2;

    if (!move_uploaded_file($file["tmp_name"], $target_file))
        return 3;

    return array('status' => 200, 'name' => basename($file["name"]));
}


//Create
if (isset($_POST['create'])) {
  $flag = uploadPhoto($_FILES['fileToUpload']);
 
  if (isset($flag['status'])) {
    try {
  
        $stmt = $conn->prepare("INSERT INTO tbl_products_a173630_pt2(fld_product_id,
          fld_product_name, fld_product_price, fld_product_region, fld_product_year, fld_product_era, fld_product_condition, fld_product_image) VALUES(:product_id, :product_name, :product_price, :product_region, :product_year, :product_era, :product_condition, :image)");
        
        $stmt->bindParam(':product_id', $pid, PDO::PARAM_STR);
        $stmt->bindParam(':product_name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':product_price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':product_region', $region, PDO::PARAM_STR);
        $stmt->bindParam(':product_year', $year, PDO::PARAM_INT);
        $stmt->bindParam(':product_era', $era, PDO::PARAM_STR);
        $stmt->bindParam(':product_condition', $condition, PDO::PARAM_STR);
        $stmt->bindParam(':image', $flag['name']);
        
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
  else {
    if ($flag == 0)
            $_SESSION['error'] = "Please make sure the file uploaded is an image.";
        elseif ($flag == 1)
            $_SESSION['error'] = "Sorry, only file with below 10MB are allowed.";
        elseif ($flag == 2)
            $_SESSION['error'] = "Sorry, only PNG & GIF files are allowed.";
        elseif ($flag == 3)
            $_SESSION['error'] = "Sorry, there was an error uploading your file.";
        elseif ($flag == 4)
            $_SESSION['error'] = 'Please upload an image.';
        else
            $_SESSION['error'] = "An unknown error has been occurred.";
  }

  header("LOCATION: {$_SERVER['REQUEST_URI']}");
  exit();
  
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
   
      // Image Upload
      $flag = uploadPhoto($_FILES['fileToUpload']);
      if (isset($flag['status']) || $flag == 4) {
          $stmt = $conn->prepare("UPDATE tbl_products_a173630_pt2 SET fld_product_image = :image WHERE fld_product_id = :oldpid LIMIT 1");

          $stmt->bindParam(':image', $flag['name']);
          $stmt->bindParam(':oldpid', $oldpid);
          $stmt->execute();
      } 
      else {
          if ($flag == 0)
              $_SESSION['error'] = "Please make sure the file uploaded is an image.";
          elseif ($flag == 1)
              $_SESSION['error'] = "Sorry, only file with below 10MB are allowed.";
          elseif ($flag == 2)
              $_SESSION['error'] = "Sorry, only PNG & GIF files are allowed.";
          elseif ($flag == 3)
              $_SESSION['error'] = "Sorry, there was an error uploading your file.";
          else
              $_SESSION['error'] = "An unknown error has been occurred.";
      }
  } 
  catch (PDOException $e) {
      $_SESSION['error'] = $e->getMessage();
  }

  if (isset($_SESSION['error']))
      header("LOCATION: {$_SERVER['REQUEST_URI']}");
  else
      header("Location: products.php");

  exit();
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

        if (empty($editrow['fld_product_image']))
            $editrow['fld_product_image'] = $editrow['fld_product_id'] . '.jpg';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
 
 //New ID
  $nid = $conn->query("SELECT MAX(fld_product_id) AS LASTID FROM tbl_products_a173630_pt2")->fetch()['LASTID'];
  $nid = ltrim($nid, 'SID')+1;
  $conn = null;
?>