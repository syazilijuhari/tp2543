<!--
Muhammad Syazili bin Juhari
A173630
-->

<?php
  include_once 'products_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Rare Stamps: Products</title>
    <link rel="shortcut icon" type="image/x-icon" href="products/icon.png"/>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        input[type="file"] {
            display: none;
        }
    </style>
</head>
<body>
<?php include_once 'nav_bar.php'; ?>
<?php
if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
      <?php
      if (isset($editrow) && count($editrow) > 0) {
          echo "<h2>Edit Product</h2>";
      } else {
          echo "<h2>Create New Product</h2>";
      }
      ?>
      </div>
      <?php
      if (isset($_SESSION['error'])) {
          echo "<p class='text-danger text-center'>{$_SESSION['error']}</p>";
          unset($_SESSION['error']);
      }
      ?>

      <form action="products.php" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="form-group">
          <label for="productid" class="col-sm-3 control-label">ID</label>
          <div class="col-sm-9">
            <input class="form-control" type="text" id="pid" name="product_id" required readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_id']; else echo sprintf('SID%02d',$nid); ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="productname" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
            <input class="form-control" type="text" placeholder="Product Name" id="pname" name="product_name" required value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="productprice" class="col-sm-3 control-label">Price</label>
          <div class="col-sm-9">
            <input class="form-control" type="number" placeholder="Product Price" id="price" name="product_price" min="0.00" max="1000000.00" step="0.01" required value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="productregion" class="col-sm-3 control-label">Region</label>
          <div class="col-sm-9">
            <select class="form-control" id="region" name="product_region" required>
              <option disabled selected value="">Select</option>
              <?php
              $countries =
              array(
              "AF" => "Afghanistan",
              "AL" => "Albania",
              "DZ" => "Algeria",
              "AS" => "American Samoa",
              "AD" => "Andorra",
              "AO" => "Angola",
              "AI" => "Anguilla",
              "AQ" => "Antarctica",
              "AG" => "Antigua and Barbuda",
              "AR" => "Argentina",
              "AM" => "Armenia",
              "AW" => "Aruba",
              "AU" => "Australia",
              "AT" => "Austria",
              "AZ" => "Azerbaijan",
              "BS" => "Bahamas",
              "BH" => "Bahrain",
              "BD" => "Bangladesh",
              "BB" => "Barbados",
              "BY" => "Belarus",
              "BE" => "Belgium",
              "BZ" => "Belize",
              "BJ" => "Benin",
              "BM" => "Bermuda",
              "BT" => "Bhutan",
              "BO" => "Bolivia",
              "BA" => "Bosnia and Herzegovina",
              "BW" => "Botswana",
              "BV" => "Bouvet Island",
              "BR" => "Brazil",
              "IO" => "British Indian Ocean Territory",
              "BN" => "Brunei Darussalam",
              "BG" => "Bulgaria",
              "BF" => "Burkina Faso",
              "BI" => "Burundi",
              "KH" => "Cambodia",
              "CM" => "Cameroon",
              "CA" => "Canada",
              "CV" => "Cape Verde",
              "KY" => "Cayman Islands",
              "CF" => "Central African Republic",
              "TD" => "Chad",
              "CL" => "Chile",
              "CN" => "China",
              "CX" => "Christmas Island",
              "CC" => "Cocos (Keeling) Islands",
              "CO" => "Colombia",
              "KM" => "Comoros",
              "CG" => "Congo",
              "CD" => "Congo, the Democratic Republic of the",
              "CK" => "Cook Islands",
              "CR" => "Costa Rica",
              "CI" => "Cote D'Ivoire",
              "HR" => "Croatia",
              "CU" => "Cuba",
              "CY" => "Cyprus",
              "CZ" => "Czech Republic",
              "DK" => "Denmark",
              "DJ" => "Djibouti",
              "DM" => "Dominica",
              "DO" => "Dominican Republic",
              "EC" => "Ecuador",
              "EG" => "Egypt",
              "SV" => "El Salvador",
              "GQ" => "Equatorial Guinea",
              "ER" => "Eritrea",
              "EE" => "Estonia",
              "ET" => "Ethiopia",
              "FK" => "Falkland Islands (Malvinas)",
              "FO" => "Faroe Islands",
              "FJ" => "Fiji",
              "FI" => "Finland",
              "FR" => "France",
              "GF" => "French Guiana",
              "PF" => "French Polynesia",
              "TF" => "French Southern Territories",
              "GA" => "Gabon",
              "GM" => "Gambia",
              "GE" => "Georgia",
              "DE" => "Germany",
              "GH" => "Ghana",
              "GI" => "Gibraltar",
              "GR" => "Greece",
              "GL" => "Greenland",
              "GD" => "Grenada",
              "GP" => "Guadeloupe",
              "GU" => "Guam",
              "GT" => "Guatemala",
              "GN" => "Guinea",
              "GW" => "Guinea-Bissau",
              "GY" => "Guyana",
              "HT" => "Haiti",
              "HM" => "Heard Island and Mcdonald Islands",
              "VA" => "Holy See (Vatican City State)",
              "HN" => "Honduras",
              "HK" => "Hong Kong",
              "HU" => "Hungary",
              "IS" => "Iceland",
              "IN" => "India",
              "ID" => "Indonesia",
              "IR" => "Iran, Islamic Republic of",
              "IQ" => "Iraq",
              "IE" => "Ireland",
              "IL" => "Israel",
              "IT" => "Italy",
              "JM" => "Jamaica",
              "JP" => "Japan",
              "JO" => "Jordan",
              "KZ" => "Kazakhstan",
              "KE" => "Kenya",
              "KI" => "Kiribati",
              "KP" => "Korea, Democratic People's Republic of",
              "KR" => "Korea, Republic of",
              "KW" => "Kuwait",
              "KG" => "Kyrgyzstan",
              "LA" => "Lao People's Democratic Republic",
              "LV" => "Latvia",
              "LB" => "Lebanon",
              "LS" => "Lesotho",
              "LR" => "Liberia",
              "LY" => "Libyan Arab Jamahiriya",
              "LI" => "Liechtenstein",
              "LT" => "Lithuania",
              "LU" => "Luxembourg",
              "MO" => "Macao",
              "MK" => "Macedonia, the Former Yugoslav Republic of",
              "MG" => "Madagascar",
              "MW" => "Malawi",
              "MY" => "Malaysia",
              "MV" => "Maldives",
              "ML" => "Mali",
              "MT" => "Malta",
              "MH" => "Marshall Islands",
              "MQ" => "Martinique",
              "MR" => "Mauritania",
              "MU" => "Mauritius",
              "YT" => "Mayotte",
              "MX" => "Mexico",
              "FM" => "Micronesia, Federated States of",
              "MD" => "Moldova, Republic of",
              "MC" => "Monaco",
              "MN" => "Mongolia",
              "MS" => "Montserrat",
              "MA" => "Morocco",
              "MZ" => "Mozambique",
              "MM" => "Myanmar",
              "NA" => "Namibia",
              "NR" => "Nauru",
              "NP" => "Nepal",
              "NL" => "Netherlands",
              "AN" => "Netherlands Antilles",
              "NC" => "New Caledonia",
              "NZ" => "New Zealand",
              "NI" => "Nicaragua",
              "NE" => "Niger",
              "NG" => "Nigeria",
              "NU" => "Niue",
              "NF" => "Norfolk Island",
              "MP" => "Northern Mariana Islands",
              "NO" => "Norway",
              "OM" => "Oman",
              "PK" => "Pakistan",
              "PW" => "Palau",
              "PS" => "Palestinian Territory, Occupied",
              "PA" => "Panama",
              "PG" => "Papua New Guinea",
              "PY" => "Paraguay",
              "PE" => "Peru",
              "PH" => "Philippines",
              "PN" => "Pitcairn",
              "PL" => "Poland",
              "PT" => "Portugal",
              "PR" => "Puerto Rico",
              "QA" => "Qatar",
              "RE" => "Reunion",
              "RO" => "Romania",
              "RU" => "Russian Federation",
              "RW" => "Rwanda",
              "SH" => "Saint Helena",
              "KN" => "Saint Kitts and Nevis",
              "LC" => "Saint Lucia",
              "PM" => "Saint Pierre and Miquelon",
              "VC" => "Saint Vincent and the Grenadines",
              "WS" => "Samoa",
              "SM" => "San Marino",
              "ST" => "Sao Tome and Principe",
              "SA" => "Saudi Arabia",
              "SN" => "Senegal",
              "CS" => "Serbia and Montenegro",
              "SC" => "Seychelles",
              "SL" => "Sierra Leone",
              "SG" => "Singapore",
              "SK" => "Slovakia",
              "SI" => "Slovenia",
              "SB" => "Solomon Islands",
              "SO" => "Somalia",
              "ZA" => "South Africa",
              "GS" => "South Georgia and the South Sandwich Islands",
              "ES" => "Spain",
              "LK" => "Sri Lanka",
              "SD" => "Sudan",
              "SR" => "Suriname",
              "SJ" => "Svalbard and Jan Mayen",
              "SZ" => "Swaziland",
              "SE" => "Sweden",
              "CH" => "Switzerland",
              "SY" => "Syrian Arab Republic",
              "TW" => "Taiwan, Province of China",
              "TJ" => "Tajikistan",
              "TZ" => "Tanzania, United Republic of",
              "TH" => "Thailand",
              "TL" => "Timor-Leste",
              "TG" => "Togo",
              "TK" => "Tokelau",
              "TO" => "Tonga",
              "TT" => "Trinidad and Tobago",
              "TN" => "Tunisia",
              "TR" => "Turkey",
              "TM" => "Turkmenistan",
              "TC" => "Turks and Caicos Islands",
              "TV" => "Tuvalu",
              "UG" => "Uganda",
              "UA" => "Ukraine",
              "AE" => "United Arab Emirates",
              "GB" => "United Kingdom",
              "US" => "United States",
              "UM" => "United States Minor Outlying Islands",
              "UY" => "Uruguay",
              "UZ" => "Uzbekistan",
              "VU" => "Vanuatu",
              "VE" => "Venezuela",
              "VN" => "Viet Nam",
              "VG" => "Virgin Islands, British",
              "VI" => "Virgin Islands, U.s.",
              "WF" => "Wallis and Futuna",
              "EH" => "Western Sahara",
              "YE" => "Yemen",
              "ZM" => "Zambia",
              "ZW" => "Zimbabwe"
              );
              foreach($countries as $key => $value) {
              ?>
                <option value="<?= $value ?>" title="<?= htmlspecialchars($value) ?>" <?php echo (isset($_GET['edit']) && $value == $editrow['fld_product_region']) ? "selected" : ""; ?>><?= htmlspecialchars($value) ?></option>
                <?php
                }
              ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="productyear" class="col-sm-3 control-label">Year</label>
          <div class="col-sm-9">
            <select class="form-control" id="year" name="product_year" required>
              <option disabled selected value="">Select</option>
              <?php
                $years = array_combine(range(date("Y"), 1800), range(date("Y"), 1800));
                foreach ($years as $year) {
                  echo "<option value='$year'".((isset($_GET['edit']) && $year == $editrow['fld_product_year']) ? "selected" : "").">{$year}</option>";
                }
              ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="productera" class="col-sm-3 control-label">Era</label>
          <div class="col-sm-9">
            <select class="form-control" id="era" name="product_era" required>
              <option disabled selected value="">Select</option>
              <option value="Edward VII" <?php if(isset($_GET['edit'])) if($editrow['fld_product_era']=="Edward VII") echo "selected"; ?>>Edward VII</option>
              <option value="George V" <?php if(isset($_GET['edit'])) if($editrow['fld_product_era']=="George V") echo "selected"; ?>>George V</option>
              <option value="Victoria" <?php if(isset($_GET['edit'])) if($editrow['fld_product_era']=="Victoria") echo "selected"; ?>>Victoria</option>
            </select>
          </div>
        </div>
        
        <div class="form-group">
          <label for="productcondition" class="col-sm-3 control-label">Condition</label>
          <div class="col-sm-9">
            <select class="form-control" id="condition" name="product_condition" required>
              <option disabled selected value="">Select</option>
              <option value="Mint No Gum" <?php if(isset($_GET['edit'])) if($editrow['fld_product_condition']=="Mint No Gum") echo "selected"; ?>>Mint No Gum</option>
              <option value="Mint Hinged" <?php if(isset($_GET['edit'])) if($editrow['fld_product_condition']=="Mint Hinged") echo "selected"; ?>>Mint Hinged</option>
              <option value="Used" <?php if(isset($_GET['edit'])) if($editrow['fld_product_condition']=="Used") echo "selected"; ?>>Used</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="productimage" class="col-sm-3 control-label">Image</label>
          <div class="col-sm-5">
            <div class="input-group">
              <input type="text" class="form-control" id="inputFileName" placeholder="Image Files (*.jpg, *.gif) " readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_image']?>">
              <span class="input-group-btn">
              <label class="btn btn-primary">
                  <input type="file" accept="image/*" name="fileToUpload" id="inputImage" onchange="loadFile(event);" />
                  <i class="fa fa-cloud-upload"></i> Upload
              </label>
              </span>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <?php if (isset($_GET['edit'])) { ?>
            <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_id']; ?>">
            <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
            <?php } else { ?>
            <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
            <?php } ?>
            <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
          </div>
        </div>

      </form>
    </div>
  </div>
  <?php
  }
  ?>
  <div class="container-fluid" style="padding-bottom: 30px;">
    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        <div class="page-header">
          <h2>Products List</h2>
          <!-- <input type="search" id="searchProduct" value="" class="form-control" placeholder="Search Products"> -->
        </div>
      <table class="table table-striped table-bordered" id="dataTable">
      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Region</th>
        <th>Year</th>
        <th>Era</th>
        <th>Condition</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
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
      foreach($result as $readrow) {
      ?>  
    
      <tr>
        <td><?php echo $readrow['fld_product_id']; ?></td>
        <td><?php echo $readrow['fld_product_name']; ?></td>
        <td><?php echo $readrow['fld_product_price']; ?></td>
        <td><?php echo $readrow['fld_product_region']; ?></td>
        <td><?php echo $readrow['fld_product_year']; ?></td>
        <td><?php echo $readrow['fld_product_era']; ?></td>
        <td><?php echo $readrow['fld_product_condition']; ?></td>
        <td>
          <a href="products_details.php?pid=<?php echo $readrow['fld_product_id']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
          <?php
          if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
          ?>
          <a href="products.php?edit=<?php echo $readrow['fld_product_id']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
          <a href="products.php?delete=<?php echo $readrow['fld_product_id']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
          <?php
          }
          ?>
        </td>
      </tr>

      <?php
      }
      $conn = null;
      ?>
    </tbody>
    </table>
  </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-3.6.0.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="application/javascript">
    var loadFile = function (event) {
        document.getElementById('inputFileName').value = event.target.files[0]['name'];
    };

    // $(document).ready(function(){
    //   $("#searchProduct").on("keyup", function() {
    //     var value = $(this).val().toLowerCase();
    //     $("#dataTable tr").filter(function() {
    //       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    //     });
    //   });
    // });

    $(document).ready(function () {
        $("#dataTable").DataTable();
    });

</script>
</body>
</html>