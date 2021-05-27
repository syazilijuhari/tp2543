<!--
Muhammad Syazili bin Juhari
A173630
-->

<?php
  include_once 'orders_crud.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Rare Stamps Ordering System</title>
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
    <div class="form" style="margin: 0 10%">
        <form action="orders.php" method="post">
          <ul>
            <li>
              <label for="oid">Order ID</label>
              <input type="text" id="oid" name="order_id" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_id']; else echo sprintf('OID%02d',$nid); ?>">
            </li>
            <li>
              <label for="odate">Order Date</label>
              <input type="date" id="odate" name="order_date" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_date']; ?>">
            </li>
            <li>
              <label for="sid">Staff</label>
              <select name="sid" required>
                <option disabled selected value="">Select</option>
                <?php
                try {
                  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a173630_pt2");
                  $stmt->execute();
                  $result = $stmt->fetchAll();
                }
                catch(PDOException $e){
                      echo "Error: " . $e->getMessage();
                }
                foreach($result as $staffrow) {
                ?>
                  <?php if((isset($_GET['edit'])) && ($editrow['fld_staff_id']==$staffrow['fld_staff_id'])) { ?>
                    <option value="<?php echo $staffrow['fld_staff_id']; ?>" selected><?php echo $staffrow['fld_staff_name'];?></option>
                  <?php } else { ?>
                    <option value="<?php echo $staffrow['fld_staff_id']; ?>"><?php echo $staffrow['fld_staff_name'];?></option>
                  <?php } ?>
                <?php
                } // while
                $conn = null;
                ?> 
              </select>
            </li>
            <li>
              <label for="cid">Customer</label>
              <select name="cid" required>
                <option disabled selected value="">Select</option>
                <?php
                try {
                  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $conn->prepare("SELECT * FROM tbl_customers_a173630_pt2");
                  $stmt->execute();
                  $result = $stmt->fetchAll();
                }
                catch(PDOException $e){
                     echo "Error: " . $e->getMessage();
                }
                foreach($result as $custrow) {
                ?>
                  <?php if((isset($_GET['edit'])) && ($editrow['fld_customer_id']==$custrow['fld_customer_id'])) { ?>
                    <option value="<?php echo $custrow['fld_customer_id']; ?>" selected><?php echo $custrow['fld_customer_name'];?></option>
                  <?php } else { ?>
                    <option value="<?php echo $custrow['fld_customer_id']; ?>"><?php echo $custrow['fld_customer_name'];?></option>
                  <?php } ?>
                <?php
                } // while
                $conn = null;
                ?> 
              </select>
            </li>
          </ul>
          <hr style="margin: 20px 0;">
          <div style="margin: auto; display: flex; align-items: center; justify-content: center;">
            <?php if (isset($_GET['edit'])) { ?>
            <button type="submit" name="update">Update</button>
            <?php } else { ?>
            <button type="submit" name="create">Create</button>
            <?php } ?>
            <button type="reset">Clear</button>
          </div>
        </form>
    </div>
    <hr>
    <div style="display: flex; align-items: center; justify-content: center;">
      <table border="1" style="width: 50%;">
        <tr>
          <td style="width: 4%;">Order ID</td>
          <td style="width: 10%;">Order Date</td>
          <td style="width: 10%;">Staff ID</td>
          <td style="width: 10%;">Customer ID</td>
          <td style="width: 10%"></td>
        </tr>
         <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM tbl_orders_a173630, tbl_staffs_a173630_pt2, tbl_customers_a173630_pt2 WHERE ";
            $sql = $sql."tbl_orders_a173630.fld_staff_id = tbl_staffs_a173630_pt2.fld_staff_id and ";
            $sql = $sql."tbl_orders_a173630.fld_customer_id = tbl_customers_a173630_pt2.fld_customer_id ORDER BY fld_order_id ASC" ;
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          foreach($result as $orderrow) {
          ?>
          <tr>
            <td><?php echo $orderrow['fld_order_id']; ?></td>
            <td><?php echo $orderrow['fld_order_date']; ?></td>
            <td><?php echo $orderrow['fld_staff_name']; ?></td>
            <td><?php echo $orderrow['fld_customer_name']; ?></td>
            <td>
              <a href="orders_details.php?order_id=<?php echo $orderrow['fld_order_id']; ?>">Details</a>
              <a href="orders.php?edit=<?php echo $orderrow['fld_order_id']; ?>">Edit</a>
              <a href="orders.php?delete=<?php echo $orderrow['fld_order_id']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
            </td>
          </tr>

          <?php
          }
          $conn = null;
          ?> 
          
      </table>
    </div>
</body>
</html>