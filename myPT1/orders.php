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
              <input type="text" id="oid" name="order_id" disabled>
            </li>
            <li>
              <label for="odate">Order Date</label>
              <input type="date" id="odate" name="order_date" disabled>
            </li>
            <li>
              <label for="sid">Staff ID</label>
              <select name="sid">
                <option disabled selected>Select</option>
              </select>
            </li>
            <li>
              <label for="cid">Customer ID</label>
              <select name="cid">
                <option disabled selected>Select</option>
              </select>
            </li>
          </ul>
          <hr style="margin: 20px 0;">
          <div style="margin: auto; display: flex; align-items: center; justify-content: center;">
            <button type="submit" name="create">Create</button>
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
        <tr>
          <td>OID01</td>
          <td>04//04/2021</td>
          <td>SC01</td>
          <td>CC02</td>
          <td>
            <a href="orders_details.php">Details</a>
            <a href="orders.php">Edit</a>
            <a href="orders.php">Delete</a>
          </td>
        </tr>
        <tr>
          <td>OID02</td>
          <td>05//04/2021</td>
          <td>SC02</td>
          <td>CC01</td>
          <td>
            <a href="orders_details.php">Details</a>
            <a href="orders.php">Edit</a>
            <a href="orders.php">Delete</a>
          </td>
        </tr>
      </table>
    </div>
</body>
</html>