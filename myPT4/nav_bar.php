<nav class="navbar navbar-default" style="background-color: #ffffff;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php" style="color: #2a2317;">Rare Stamps</a>
    </div>
 
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li><a href="index.php" style="color: #2a2317;">Home</a></li>
    </ul>
    <ul class="nav navbar-nav">
      <li>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['user']['fld_staff_name']. " | ". $_SESSION['user']['fld_staff_role']; ?> <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="logout.php">Logout</a></li>
        </ul>
    </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: #2a2317;">Menu <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="products.php">Products</a></li>
            <li><a href="customers.php">Customers</a></li>
            <li><a href="staffs.php">Staffs</a></li>
            <li><a href="orders.php">Orders</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>