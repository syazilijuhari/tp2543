<!--
Muhammad Syazili bin Juhari
A173630
-->
<?php
require_once 'database.php';

if (isset($_SESSION['loggedin']))
    header("LOCATION: index.php");

if (isset($_POST['userId'], $_POST['userPass'])) {
    $UserID = htmlspecialchars($_POST['userId']);
    $Pass = $_POST['userPass'];

    if (empty($UserID) || empty($Pass)) {
        $_SESSION['error'] = 'Please fill in the blanks.';
    } else {
        $stmt = $db->prepare("SELECT * FROM tbl_staffs_a173630_pt2 WHERE (fld_staff_email = :id) LIMIT 1");
        $stmt->bindParam(':id', $UserID);

        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (isset($user['fld_staff_email'])) {
            if ($user['fld_staff_password'] == $Pass) {
                unset($user['fld_staff_password']);
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $user;

                header("LOCATION: index.php");
                exit();
            } else {
                $_SESSION['error'] = 'Invalid login email or password. Please try again.';
            }
        } else {
            $_SESSION['error'] = 'Account does not exist.';
        }
    }

    header("LOCATION: " . $_SERVER['REQUEST_URI']);
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Rare Stamps: Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="products/icon.png"/>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="http://kendo.cdn.telerik.com/2016.1.226/js/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/bootstrap.min.js"></script>

</head>
<body>
<div>
    <img src="products/logo.png" alt="logo" width=20%" height="20%" style="display: block; margin:0 auto" >
</div>
<div class="login-box">
    <h2>Login</h2>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" class="form">
      <div class="user-box">
        <input class="input" type="text" id="userId" name="userId" required>
        <label class="label" for="email">Email</label>
      </div>
      <!-- /.user-box -->
      <div class="user-box">
        <input class="input" type="password" id="userPass" name="userPass" required>
        <label class="label" for="password">Password</label>
      </div>

        <?php
        if (isset($_SESSION['error'])) {
            echo "<p class='text-danger text-center'>{$_SESSION['error']}</p>";
            unset($_SESSION['error']);
        }
        ?>
      <!-- /.user-box -->
      <button type="submit">
      <a>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Sign In
      </a>
      </button>
    </form>
    <!-- /form -->
  </div>
  <!-- /.login-box -->
</body>
</html>