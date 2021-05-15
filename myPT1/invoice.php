<!--
Muhammad Syazili bin Juhari
A173630
-->

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
    <div class="order" style="margin: 0 10%">
        <form action="invoice.php" method="post">
          <ul>
              <li>
                  <label>Order ID</label>
                  <label>OID01</label>
              </li>
              <li>
                  <label>Order Date</label>
                  <label>04//04/2021</label>
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
                  <label>Ali</label>
              </li>
              <li>
                  <label>Customer</label>
                  <label>Ahmad Albab</label>
              </li>
              <li>
                  <label>Date</label>
                  <label>Today</label>
              </li>
          </ul>
        </form>
    </div>
    <hr>
    <div style="display: flex; align-items: center; justify-content: center;">
      <table border="1" style="width: 60%;">
        <tr>
          <td style="width: 4%;">Order ID</td>
          <td style="width: 7%;">Product ID</td>
          <td style="width: 40%;">Name</td>
          <td style="width: 5%;">Quantity</td>
          <td style="width: 10%;">Price (RM)</td>
        </tr>
        <tr>
          <td>OID01</td>
          <td>SID41</td>
          <td>GB 1915 10s Deep Blue SG411 D.L.R</td>
          <td>1</td>
          <td align="right">1915.00</td>
        </tr>
        <tr>
          <td>OID02</td>
          <td>SID22</td>
          <td>Australia 1914 5d Chestnut SG022</td>
          <td>2</td>
          <td align="right">206.61</td>
        </tr>
        <tr>
          <td colspan="4" align="right">Total Price (RM)</td>
          <td align="right">2328.22</td>
        </tr>
      </table>
    </div>
</body>
</html>