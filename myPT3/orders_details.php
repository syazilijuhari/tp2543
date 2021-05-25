<!--
Muhammad Syazili bin Juhari
A173630
-->

<?php
  include_once 'orders_details_crud.php';
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

    .order-details form {
      /* Center the form on the page */
      margin: 0 auto;
      width: 500px;
      /* Form outline */
      padding: 1em;
      border: 1px solid #CCC;
      border-radius: 1em;
    }

    .form-qty form {
      /* Center the form on the page */
      margin: 0 auto;
      width: 500px;
    }

    .form-qty label {
      display: inline-block;
      width: 100px;
      text-align: center;
      margin-top: 16px;
    }

    .form-qty button {
      margin-top: 16px;
    }

    .invoice button {
      margin-top: 16px;
    }

    ul {
      list-style: none;
      padding: 0;
      margin: 0 12px;
    }

    .order-details form li+li {
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

    button {
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
    <div id="header" class="header">
        <h1 align="center">Order Details</h1>
    </div>

     <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_orders_a173630, tbl_staffs_a173630_pt2, tbl_customers_a173630_pt2 WHERE tbl_orders_a173630.fld_staff_id = tbl_staffs_a173630_pt2.fld_staff_id AND tbl_orders_a173630.fld_customer_id = tbl_customers_a173630_pt2.fld_customer_id AND fld_order_id = :order_id");
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

    <div class="order-details" style="margin: 0 10%">
        <form action="orders_details.php" method="post">
          <ul>
              <li>
                  <label>Order ID</label>
                  <label><?php echo $readrow['fld_order_id'] ?></label>
              </li>
              <li>
                  <label>Order Date</label>
                  <label><?php echo $readrow['fld_order_date'] ?></label>
              </li>
              <li>
                  <label>Staff</label>
                  <label><?php echo $readrow['fld_staff_name'] ?></label>
              </li>
              <li>
                  <label>Customer</label>
                  <label><?php echo $readrow['fld_customer_name'] ?></label>
              </li>
          </ul>
        </form>
    </div>
    <hr>
    <div class="form-qty">
      <form action="orders_details.php" method="post">
        <label>Product</label>
          <select style="margin-left: 16px " name="product_id">
              <option disabled selected value="">Select</option>
              <?php
              try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM tbl_products_a173630_pt2");
                $stmt->execute();
                $result = $stmt->fetchAll();
              }
              catch(PDOException $e){
                    echo "Error: " . $e->getMessage();
              }
              foreach($result as $productrow) {
              ?>
                <option value="<?php echo $productrow['fld_product_id']; ?>"><?php echo $productrow['fld_product_name']; ?></option>
              <?php
              }
              $conn = null;

              ?>
          </select>
          <label>Quantity</label>
          <input style="margin-left: 16px" name="quantity" type="number" min="1" required>
          <div style="margin: auto; display: flex; align-items: center; justify-content: center;">
            <input name="order_id" type="hidden" value="<?php echo $readrow['fld_order_id'] ?>">
            <button type="submit" name="addproduct">Add</button>
            <button type="reset">Clear</button>
          </div>
      </form>
    </div>
    <hr>
    <div style="display: flex; align-items: center; justify-content: center;">
      <table border="1" style="width: 60%;">
        <tr>
           <td style="width: 9%;">Order Detail ID</td>
          <td style="width: 5%;">Order ID</td>
          <td style="width: 7%;">Product ID</td>
          <td style="width: 40%;">Name</td>
          <td style="width: 5%;">Quantity</td>
          <td style="width: 10%"></td>
        </tr>
         <?php
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
            <td><?php echo $detailrow['fld_order_detail_id']; ?></td>
            <td><?php echo $detailrow['fld_order_id']; ?></td>
            <td><?php echo $detailrow['fld_product_id']; ?></td>
            <td><?php echo $detailrow['fld_product_name']; ?></td>
            <td><?php echo $detailrow['fld_product_qty']; ?></td>
            <td>
              <a href="orders_details.php?delete=<?php echo $detailrow['fld_order_detail_id']; ?>&order_id=<?php echo $_GET['order_id']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
            </td>
          </tr>
          <?php
          }
          $conn = null;
          ?>
          
      </table>
    </div>
    <div class="invoice" style="margin: auto; display: flex; align-items: center; justify-content: center;">
      <button onclick="document.location='invoice.php?order_id=<?php echo $_GET['order_id']; ?>'" name="generate-invoice">Generate Invoice</button>
    </div>
</body>
</html>