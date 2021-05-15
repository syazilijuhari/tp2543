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
        /* margin: 0 auto; */
        width: 500px;
        /* Form outline */
        padding: 1em;
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

        <?php
        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a173630_pt2 WHERE fld_product_id = :pid");
          $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
          $pid = $_GET['pid'];
          $stmt->execute();
          $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
          }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        ?>

    </div>
    <div id="pdetails" class="pdetails">
        <h1 align="center">Product Details</h1>
    </div>
    <div style="display: flex; align-items: center; justify-content: center;">
        <table border="1" style="width: 70%;">
            <tr>
                <td style="width: 40%; vertical-align: top; text-align: left;">
                    <img src="products/<?php echo $readrow['fld_product_image'] ?>" width="100%" height="auto">
                </td>
                <td>
                    <form action="products_details.php" method="post">
                        <ul>
                            <li>
                                <label>Product ID</label>
                                <label><?php echo $readrow['fld_product_id'] ?></label>
                            </li>
                            <li>
                                <label>Name</label>
                                <label><?php echo $readrow['fld_product_name'] ?></label>
                            </li>
                            <li>
                                <label>Price (RM)</label>
                                <label><?php echo $readrow['fld_product_price'] ?></label>
                            </li>
                            <li>
                                <label>Region</label>
                                <label><?php echo $readrow['fld_product_region'] ?></label>
                            </li>
                            <li>
                                <label>Year</label>
                                <label><?php echo $readrow['fld_product_year'] ?></label>
                            </li>

                            <li>
                                <label>Era</label>
                                <label><?php echo $readrow['fld_product_era'] ?></label>
                            </li>

                            <li>
                                <label>Condition</label>
                                <label><?php echo $readrow['fld_product_condition'] ?></label>
                            </li>
                        </ul>
                    </form>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>