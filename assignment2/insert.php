<?php
 
if (isset($_POST['add_form'])) {
 
  include "db.php";
 
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO myguestbook(user, email, postdate, posttime, find, like_fp, like_form, like_ui, comment) VALUES (:user, :email, :pdate, :ptime, :find, :like_fp, :like_form, :like_ui, :comment)");
   
    // Bind the parameters
    $stmt->bindParam(':user', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':pdate', $postdate, PDO::PARAM_STR);
    $stmt->bindParam(':ptime', $posttime, PDO::PARAM_STR);
    $stmt->bindParam(':find', $find, PDO::PARAM_STR);
    $stmt->bindParam(':like_fp', $like_fp, PDO::PARAM_STR);
    $stmt->bindParam(':like_form', $like_form, PDO::PARAM_STR);
    $stmt->bindParam(':like_ui', $like_ui, PDO::PARAM_STR);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
     
    // Give value to the variables
    $name = $_POST['name'];
    $email = $_POST['email'];
    $postdate = date("Y-m-d",time());
    $posttime = date("H:i:s",time());
    $find = $_POST['find'];
    $like_fp = $_POST['like_fp'];
    $like_form = $_POST['like_form'];
    $like_ui = $_POST['like_ui'];
    $comment = $_POST['comment'];
   
  $stmt->execute();

    header("Location:list.php");
    // echo "New records created successfully";

  }
 
  catch(PDOException $e)
  {
    echo "Error: " . $e->getMessage();
  }

  $conn = null;
}
else {
  echo "Error: You have execute a wrong PHP. Please contact the web administrator.";
  die();
}
 
 ?>