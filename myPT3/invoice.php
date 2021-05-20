<!--
Muhammad Syazili bin Juhari
A173630
-->

<?php
  include_once 'database.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Rare Stamps Ordering System</title>
    <link rel="shortcut icon" type="image/x-icon" href="products/icon.ico"/>
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
        margin-left: .5em;
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

    label {
      display: inline-block;
      width: 160px;
      text-align: left;
    }

    ul {
      list-style: none;
      padding: 0;
      margin: 0 12px;
    }

    form li+li {
      margin-top: 1em;
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
    <div id="header" class="header">
        <h1 align="center">INVOICE</h1>
        <h3 align="center">CHICKY STAMPS STORE</h3>
        <h4 align="center">Universiti Kebangsaan Malaysia<br>43600 UKM<br>Bangi, Selangor</h4>
    </div>
    <hr>
    <?php
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM tbl_orders_a173630, tbl_staffs_a173630_pt2, tbl_customers_a173630_pt2, tbl_orders_details_a173630 WHERE tbl_orders_a173630.fld_staff_id = tbl_staffs_a173630_pt2.fld_staff_id AND tbl_orders_a173630.fld_customer_id = tbl_customers_a173630_pt2.fld_customer_id AND tbl_orders_a173630.fld_order_id = tbl_orders_details_a173630.fld_order_id AND tbl_orders_a173630.fld_order_id = :order_id");
      $stmt->bindParam(':order_id', $oid, PDO::PARAM_STR);
      $oid = $_GET['order_id'];
      $stmt->execute();
      $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>
    <div class="order" style="margin: 0 10%">
        <form action="invoice.php" method="post">
          <ul>
              <li>
                  <label>Order ID</label>
                  <label><?php echo $readrow['fld_order_id'] ?></label>
              </li>
              <li>
                  <label>Order Date</label>
                  <label><?php echo $readrow['fld_order_date'] ?></label>
              </li>
          </ul>
        <!-- <hr style="margin: 20px 0;"> -->
        </form>
    </div>
    <hr>
    <div class="person" style="margin: 0 10%">
      <form action="invoice.php" method="post">
          <ul>
              <li>
                  <label>Staff</label>
                  <label><?php echo $readrow['fld_staff_name'] ?></label>
              </li>
              <li>
                  <label>Customer</label>
                  <label><?php echo $readrow['fld_customer_name'] ?></label>
              </li>
              <li>
                  <label>Date</label>
                  <label><?php echo date("d M Y"); ?></label>
              </li>
          </ul>
        </form>
    </div>
    <hr>
    <div style="display: flex; align-items: center; justify-content: center;">
      <table border="1" style="width: 60%;">
        <tr>
          <td style="width: 2%;">No</td>
          <td style="width: 5%;">Order ID</td>
          <td style="width: 7%;">Product ID</td>
          <td style="width: 40%;">Name</td>
          <td style="width: 5%;">Quantity</td>
          <td style="width: 10%;">Price (RM)</td>
        </tr>
         <?php
          $grandtotal = 0;
          $counter = 1;
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $stmt = $conn->prepare("SELECT * FROM tbl_orders_details_a173630, tbl_products_a173630_pt2 WHERE tbl_orders_details_a173630.fld_product_id = tbl_products_a173630_pt2.fld_product_id AND fld_order_id = :order_id");
            $stmt->bindParam(':order_id', $oid, PDO::PARAM_STR);
            $oid = $_GET['order_id'];
            $stmt->execute();
            $result = $stmt->fetchAll();
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          foreach($result as $detailrow) {
          ?>
        <tr>
          <td><?php echo $counter; ?></td>
          <td><?php echo $detailrow['fld_order_id']; ?></td>
          <td><?php echo $detailrow['fld_product_id']; ?></td>
          <td><?php echo $detailrow['fld_product_name']; ?></td>
          <td><?php echo $detailrow['fld_product_qty']; ?></td>
          <td><?php echo $detailrow['fld_product_price']*$detailrow['fld_product_qty']; ?></td>
        </tr>
        <?php
          $grandtotal = $grandtotal + $detailrow['fld_product_price']*$detailrow['fld_product_qty'];
          $counter++;
        } // while
        $conn = null;
        ?>
        <tr>
          <td colspan="5" align="right">Total Price (RM)</td>
           <td><?php echo $grandtotal ?></td>
        </tr>
      </table>
    </div>
</body>
</html>