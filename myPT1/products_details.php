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
    </div>
    <div id="pdetails" class="pdetails">
        <h1 align="center">Product Details</h1>
    </div>
    <div style="display: flex; align-items: center; justify-content: center;">
        <table border="1" style="width: 70%;">
            <tr>
                <td style="width: 40%; vertical-align: top; text-align: left;">
                    <img src="products/SID41.jpg" alt="sid41" width="100%" height="auto">
                </td>
                <td>
                    <form action="products_details.php" method="post">
                        <ul>
                            <li>
                                <label>Product ID</label>
                                <label>SID41</label>
                            </li>
                            <li>
                                <label>Name</label>
                                <labe>GB 1915 10s Deep Blue SG411 D.L.R</label>
                            </li>
                            <li>
                                <label>Price (RM)</label>
                                <label>7290.24</label>
                            </li>
                            <li>
                                <label>Region</label>
                                <label>United Kingdom</label>
                            </li>
                            <li>
                                <label>Year</label>
                                <label>1915</label>
                            </li>

                            <li>
                                <label>Era</label>
                                <label>George V</label>
                            </li>

                            <li>
                                <label>Condition</label>
                                <label>Mint Hinged</label>
                            </li>
                        </ul>
                    </form>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>