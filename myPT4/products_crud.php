<?php
 
include_once 'database.php';

if (!isset($_SESSION['loggedin']))
    header("LOCATION: login.php");
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
$extention = ['jpg', 'jpeg', 'gif'];
function uploadPhoto($file, $id)
{
    global $extention;
    //array_push($extention, 'jpg', 'jpeg');
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
    $uploadStatus = uploadPhoto($_FILES['fileToUpload'], $_POST['product_id']);
 
    if (isset($uploadStatus['status'])) {
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
            $stmt->bindParam(':image', $uploadStatus['name']);
            
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
            $_SESSION['error']=$e->getMessage();
        }
    }
    else {
        if ($uploadStatus == 0)
            $_SESSION['error'] = "Please make sure the file uploaded is an image.";
        elseif ($uploadStatus == 1)
            $_SESSION['error'] = "Sorry, only file below 10MB are allowed.";
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
    header("LOCATION: {$_SERVER['REQUEST_URI']}");
    exit();
    
}
 
//Update
if (isset($_POST['update'])) {
 
  try {
 
        $stmt = $conn->prepare("UPDATE tbl_products_a173630_pt2 SET fld_product_id = :product_id,
            fld_product_name = :product_name, fld_product_price = :product_price, fld_product_region = :product_region, fld_product_year = :product_year, fld_product_era = :product_era, fld_product_condition = :product_condition WHERE fld_product_id = :product_id");
        
        $stmt->bindParam(':product_id', $pid, PDO::PARAM_STR);
        $stmt->bindParam(':product_name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':product_price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':product_region', $region, PDO::PARAM_STR);
        $stmt->bindParam(':product_year', $year, PDO::PARAM_INT);
        $stmt->bindParam(':product_era', $era, PDO::PARAM_STR);
        $stmt->bindParam(':product_condition', $condition, PDO::PARAM_STR);
        // $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);
        
        $pid = $_POST['product_id'];
        $name = $_POST['product_name'];
        $price = $_POST['product_price'];
        $region =  $_POST['product_region'];
        $year = $_POST['product_year'];
        $era = $_POST['product_era'];
        $condition = $_POST['product_condition'];
        // $oldpid = $_POST['oldpid'];
        
        $stmt->execute();
    
        // Image Upload
        $flag  = uploadPhoto($_FILES['fileToUpload'], $_POST['product_id']);

        if (isset($flag['status'])) {
            $stmt = $conn->prepare("UPDATE tbl_products_a173630_pt2 SET fld_product_image = :image WHERE fld_product_id = :product_id LIMIT 1");

            $stmt->bindParam(':image', $flag['name']);
            $stmt->bindParam(':product_id', $pid);
            $stmt->execute();

            if(pathinfo(basename($_POST['filename']), PATHINFO_EXTENSION)!=$flag['ext'])
				unlink("products/{$_POST['filename']}");
        } 
        elseif ($flag != 4) {
			if ($flag == 0)
				$_SESSION['error'] = "Please make sure the file uploaded is an image.";
			elseif ($flag == 1)
				$_SESSION['error'] = "Sorry, only file below 10MB are allowed.";
			elseif ($flag == 2)
				$_SESSION['error'] = "Sorry, only ".join(", ",$extention)." files are allowed.";
			elseif ($flag == 3)
				$_SESSION['error'] = "Sorry, there was an error uploading your file.";
			else
				$_SESSION['error'] = "An unknown error has been occurred.";
		}
    } 
    catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }

    clearstatcache();
    if (isset($_SESSION['error']))
        header("LOCATION: {$_SERVER['REQUEST_URI']}");
    else
        header("Location: products.php");

    exit();
}
 
//Delete
if (isset($_GET['delete'])) {
 
    try {
		$pid = $_GET['delete'];
		$query = $conn->query("SELECT fld_product_image FROM tbl_products_a173630_pt2 WHERE fld_product_id = '{$pid}' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
		if (isset($query['fld_product_image'])) {
			// Delete Query
			$stmt = $conn->prepare("DELETE FROM tbl_products_a173630_pt2 WHERE fld_product_id = :product_id");
			$stmt->bindParam(':product_id', $pid);
			$stmt->execute();
			// Delete Image
			unlink("products/{$query['fld_product_image']}");
		}
	}
	catch(PDOException $e)
	{
        $_SESSION['error'] = $e->getMessage();
	}
	header("LOCATION: {$_SERVER['PHP_SELF']}");
    exit();
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