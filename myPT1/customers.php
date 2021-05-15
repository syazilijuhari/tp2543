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
    <div class="form" style="margin: 0 10%">
        <form action="customers.php" method="post">
          <ul>
            <li>
              <label for="cid">ID</label>
              <input type="text" id="cid" name="customer_id">
            </li>
            <li>
              <label for="cname">Name</label>
              <input type="text" id="cname" name="customer_name">
            </li>
            <li>
              <label for="cphone">Phone No</label>
              <input type="tel" id="cphone" name="customer_phone" pattern="^[+]601[0-9]{1}-([0-9]{8}|[0-9]{7})" placeholder="+60##-#######">
            </li>
          <hr style="margin: 20px 0;">
          <div style="margin: auto; display: flex; align-items: center; justify-content: center;">
            <button type="submit" name="create">Create</button>
            <button type="reset">Clear</button>
          </div>
        </form>
    </div>
    <hr>
    <div style="display: flex; align-items: center; justify-content: center;">
      <table border="1" style="width: 40%;">
        <tr>
          <td style="width: 4%;">ID</td>
          <td style="width: 10%;">Name</td>
          <td style="width: 10%;">Phone No</td>
          <td style="width: 10%"></td>
        </tr>
        <tr>
          <td>SC01</td>
          <td>Ahmad Albab</td>
          <td>0173312344</td>
          <td>
            <a href="customers.php">Edit</a>
            <a href="customers.php">Delete</a>
          </td>
        </tr>
        <tr>
          <td>SC02</td>
          <td>Maznah</td>
          <td>0129876123</td>
          <td>
            <a href="customers.php">Edit</a>
            <a href="customers.php">Delete</a>
          </td>
        </tr>
      </table>
    </div>
</body>
</html>