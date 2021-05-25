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
    <title>Rare Stamps Ordering System</title>
    <link rel="shortcut icon" type="image/x-icon" href="products/icon.png"/>
    <meta charset="UTF-8">
</head>

<style>

    .navbar {
        font-size: 24px
    }

    .nav-link {
        background-color: Transparent;
        background-repeat:no-repeat;
        border: none;
        cursor:pointer;
        overflow: hidden;
        outline:none;
    }

    form {
      /* Center the form on the page */
      margin: 0 auto;
      width: 500px;
      /* Form outline */
      padding: 1em;
      border: 1px solid #CCC;
      border-radius: 1em;
    }

    ul {
      list-style: none;
      padding: 0;
      margin: 0 12px;
    }

    form li+li {
      margin-top: 1em;
    }

    label {
      /* Uniform size & alignment */
      display: inline-block;
      width: 160px;
      text-align: left;
    }

    input,
    select {
      /* To make sure that all text fields have the same font settings
     By default, textareas have a monospace font */
      /* font: 1em sans-serif; */

      /* Uniform text field size */
      width: 300px;
      box-sizing: border-box;

      /* Match form field borders */
      border: 1px solid #999;
    }

    input:focus {
      /* Additional highlight for focused elements */
      border-color: #000;
    }

    .button {
      /* Align buttons with the text fields */
      padding-left: 90px;
      /* same size as the label elements */
    }

    button {
      /* This extra margin represent roughly the same space as the space
     between the labels and their text fields */
      margin-left: .5em;
    }
</style>

<body>
    <div id="nav" class="navbar">
        <center>
            <button class="nav-link">
                <a href="index.php">Home</a> |
            </button>
            <button class="nav-link">
                <a href="products.php">Products</a> |
            </button>
            <button class="nav-link">
                <a href="customers.php">Customers</a> |
            </button>
            <button class="nav-link">
                <a href="staffs.php">Staffs</a> |
            </button>
            <button class="nav-link">
                <a href="orders.php">Orders</a>
            </button>
            <hr>
        </center>
    </div>
    <div class="form" style="margin: 0 10%">
        <form action="orders.php" method="post">
          <ul>
            <li>
              <label for="oid">Order ID</label>
              <input type="text" id="oid" name="order_id" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_id']; ?>">
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
          if (!isset($_GET['edit']) && $stmt->rowCount()>0){
            $id = ltrim($orderrow['fld_order_id'], 'O')+1;
            $id = 'O'.str_pad($id,4,"0",STR_PAD_LEFT);
          }
          elseif(!isset($_GET['edit'])){
            $id = 'O'.str_pad(1,4,"0",STR_PAD_LEFT);
          }
          $conn = null;
          ?> 
          <script type="text/javascript">

            if("<?php echo $id ?>" !== null && "<?php echo $id ?>" !== ""){
            var oid = document.getElementById("oid");
            oid.value = "<?php echo $id ?>";
            oid.readOnly = true;
            }
          </script>
      </table>
    </div>
</body>
</html>