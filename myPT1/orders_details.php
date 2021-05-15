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
    <div class="order-details" style="margin: 0 10%">
        <form action="orders_details.php" method="post">
          <ul>
              <li>
                  <label>Order ID</label>
                  <label>OID01</label>
              </li>
              <li>
                  <label>Order Date</label>
                  <label>04//04/2021</label>
              </li>
              <li>
                  <label>Staff ID</label>
                  <label>SC01</label>
              </li>
              <li>
                  <label>Customer ID</label>
                  <label>CC02</label>
              </li>
          </ul>
        </form>
    </div>
    <hr>
    <div class="form-qty">
      <form action="orders_details.php" method="post">
        <label>Product</label>
          <select style="margin-left: 16px " name="pid">
              <option disabled selected>Select</option>
              <option value="SID01">Fed Malay States 1900 $1 Green & Pale Green SG23</option>
              <option value="SID02">Fed of Malay States 1904 10c Grey-Brown & Claret SG43</option>
              <option value="SID06">Hawaii 1863 1c Black-Greyish SG12 Sc15</option>
              <option value="SID38">Newfoundland 1857 2d Scarlet-Vermilion SG2</option>
              <option value="SID14">Hawaii 1863 2c Pale Rose SG20 Sc27 Litho Horiz Laid Paper</option>
              <option value="SID22">Australia 1914 5d Chestnut SG022</option>
              <option value="SID17">China Shanghai 1866 6ca Red-Brown SG18</option>
              <option value="SID29">Queensland 1860 1d Carmine-Rose SG1</option>
              <option value="SID41">GB 1915 10s Deep Blue SG411 D.L.R</option>
              <option value="SID42">India 1855 4d Blue & Red SG21 Head III Frame I V.F.U 4</option>
          </select>
          <label>Quantity</label>
          <input style="margin-left: 16px" name="quantity" type="number">
          <div style="margin: auto; display: flex; align-items: center; justify-content: center;">
            <button type="submit" name="add">Add</button>
            <button type="reset">Clear</button>
          </div>
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
          <td style="width: 10%"></td>
        </tr>
        <tr>
          <td>OID01</td>
          <td>SID41</td>
          <td>GB 1915 10s Deep Blue SG411 D.L.R</td>
          <td>1</td>
          <td align="right">1915.00</td>
          <td>
            <a href="orders_details.php">Delete</a>
          </td>
        </tr>
        <tr>
          <td>OID02</td>
          <td>SID22</td>
          <td>Australia 1914 5d Chestnut SG022</td>
          <td>2</td>
          <td align="right">206.61</td>
          <td>
            <a href="orders_details.php">Delete</a>
          </td>
        </tr>
      </table>
    </div>
    <div class="invoice" style="margin: auto; display: flex; align-items: center; justify-content: center;">
      <button onclick="document.location='invoice.php'" name="generate-invoice">Generate Invoice</button>
    </div>
</body>
</html>