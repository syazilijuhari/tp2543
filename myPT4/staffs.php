<!--
Muhammad Syazili bin Juhari
A173630
-->

<?php
  include_once 'staffs_crud.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Rare Stamps: Staffs</title>
    <link rel="shortcut icon" type="image/x-icon" href="products/icon.png"/>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php include_once 'nav_bar.php'; ?>
<?php
if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
      <?php
      if (isset($editrow) && count($editrow) > 0) {
          echo "<h2>Edit Staff</h2>";
      } else {
          echo "<h2>Create New Staff</h2>";
      }
      ?>
      </div>
      <?php
      if (isset($_SESSION['error'])) {
          echo "<p class='text-danger text-center'>{$_SESSION['error']}</p>";
          unset($_SESSION['error']);
      }
      ?>

      <form action="staffs.php" method="post" class="form-horizontal">
        <div class="form-group">
          <label for="staffid" class="col-sm-3 control-label">ID</label>
          <div class="col-sm-9">
            <input class="form-control" type="text" id="sid" name="staff_id" readonly required value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_id']; else echo sprintf('SS%02d',$nid); ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="staffname" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
            <input class="form-control" type="text" placeholder="Staff Name" id="sname" name="staff_name" required value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_name']; ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="staffphone" class="col-sm-3 control-label">Phone No</label>
          <div class="col-sm-9">
            <input class="form-control" type="tel" placeholder="Staff Phone No (e.g. +6012-3456789)" id="sphone" name="staff_phone" pattern="^[+]601[0-9]{1}-([0-9]{8}|[0-9]{7})" required value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_phone']; ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="staffemail" class="col-sm-3 control-label">Email</label>
          <div class="col-sm-9">
            <input class="form-control" type="text" placeholder="Staff Email" id="sphone" name="staff_email" pattern="[a-zA-Z0-9-]+@gmail.com" required value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_email']; ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="staffrole" class="col-sm-3 control-label">Role</label>
          <div class="col-sm-9">
            <select class="form-control" id="role" name="staff_role" required>
              <option disabled selected value="">Select</option>
              <option value="Admin" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_role']=="Admin") echo "selected"; ?>>Admin</option>
              <option value="Staff" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_role']=="Staff") echo "selected"; ?>>Staff</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <?php if (isset($_GET['edit'])) { ?>
            <input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_id']; ?>">
            <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
            <?php } else { ?>
            <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
            <?php } ?>
            <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php
  }
  ?>

  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Staff List</h2>
      </div>
    <table class="table table-striped table-bordered">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Phone No</th>
      <th>Email</th>
      <th>Role</th>
      <?php
      if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
      ?>
      <th>Action</th>
      <?php
      }
      ?>
    </tr>

    <?php
    // Read
    $per_page = 5;
    if (isset($_GET["page"]))
      $page = $_GET["page"];
    else
      $page = 1;
    $start_from = ($page-1) * $per_page;
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a173630_pt2 LIMIT $start_from, $per_page");
      $stmt->execute();
      $result = $stmt->fetchAll();
    }
    catch(PDOException $e){
          echo "Error: " . $e->getMessage();
    }
    foreach($result as $readrow) {
    ?>
    <tr>
      <td><?php echo $readrow['fld_staff_id']; ?></td>
      <td><?php echo $readrow['fld_staff_name']; ?></td>
      <td><?php echo $readrow['fld_staff_phone']; ?></td>
      <td><?php echo $readrow['fld_staff_email']; ?></td>
      <td><?php echo $readrow['fld_staff_role']; ?></td>
      <?php
      if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
      ?>
      <td>
        <a href="staffs.php?edit=<?php echo $readrow['fld_staff_id']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
        <a href="staffs.php?delete=<?php echo $readrow['fld_staff_id']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
      </td>
      <?php
      }
      ?>
    </tr>
    <?php
    }
    $conn = null;
    ?>

  </table>
</div>
<div class="row">
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
    <nav>
        <ul class="pagination">
        <?php
        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a173630_pt2");
          $stmt->execute();
          $result = $stmt->fetchAll();
          $total_records = count($result);
        }
        catch(PDOException $e){
              echo "Error: " . $e->getMessage();
        }
        $total_pages = ceil($total_records / $per_page);
        ?>
        <?php if ($page==1) { ?>
          <li class="disabled"><span aria-hidden="true">«</span></li>
        <?php } else { ?>
          <li><a href="staffs.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
        <?php
        }
        for ($i=1; $i<=$total_pages; $i++)
          if ($i == $page)
            echo "<li class=\"active\"><a href=\"staffs.php?page=$i\">$i</a></li>";
          else
            echo "<li><a href=\"staffs.php?page=$i\">$i</a></li>";
        ?>
        <?php if ($page==$total_pages) { ?>
          <li class="disabled"><span aria-hidden="true">»</span></li>
        <?php } else { ?>
          <li><a href="staffs.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
        <?php } ?>
      </ul>
    </nav>
  </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>