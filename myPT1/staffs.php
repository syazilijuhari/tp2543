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
        <form action="staffs.php" method="post">
          <ul>
            <li>
              <label for="sid">ID</label>
              <input type="text" id="sid" name="staff_id">
            </li>
            <li>
              <label for="cname">Name</label>
              <input type="text" id="sname" name="staff_name">
            </li>
            <li>
              <label for="sphone">Phone No</label>
              <input type="tel" id="sphone" name="staff_phone" pattern="^[+]601[0-9]{1}-([0-9]{8}|[0-9]{7})" placeholder="+60##-#######">
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
          <td>SS01</td>
          <td>Ali</td>
          <td>0134446563</td>
          <td>
            <a href="staffs.php">Edit</a>
            <a href="staffs.php">Delete</a>
          </td>
        </tr>
        <tr>
          <td>SS02</td>
          <td>Abu</td>
          <td>0191237654</td>
          <td>
            <a href="staffs.php">Edit</a>
            <a href="staffs.php">Delete</a>
          </td>
        </tr>
      </table>
    </div>
</body>
</html>