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
    <title>Rare Stamps Ordering System</title>
    <link rel="shortcut icon" type="image/x-icon" href="products/icon.ico"/>
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

    input, select {
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
        <form action="products.php" method="post">
          <ul>
            <li>
              <label for="pid">Product ID</label>
              <input type="text" id="pid" name="product_id" required value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_id']; ?>">
            </li>
            <li>
              <label for="pname">Name</label>
              <input type="text" id="pname" name="product_name" required value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>">
            </li>
            <li>
              <label for="price">Price (RM)</label>
              <input type="number" id="price" name="product_price" min="0.00" max="1000000.00" step="0.01" required value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>">
            </li>
            <li>
              <label for="region">Region</label>
              <select id="region" name="product_region">
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
                  <option value="<?= $key ?>" title="<?= htmlspecialchars($value) ?>" <?php echo (isset($_GET['edit']) && $value == $editrow['fld_product_region']) ? "selected" : ""; ?>><?= htmlspecialchars($value) ?></option>
                  <?php
                  }
                ?>
              </select>
            </li>

            <li>
              <label for="year">Year</label>
              <select id="year" name="product_year">
                <option disabled selected value="">Select</option>
                <?php
                  $years = array_combine(range(date("Y"), 1800), range(date("Y"), 1800));
                  foreach ($years as $year) {
                    echo "<option value='$year'".((isset($_GET['edit']) && $year == $editrow['fld_product_year']) ? "selected" : "").">{$year}</option>";
                  }
                ?>
              </select>
            </li>

            <li>
              <label for="era">Era</label>
              <select id="era" name="product_era">
                <option disabled selected value="">Select</option>
                <option value="edward-vii" <?php if(isset($_GET['edit'])) if($editrow['fld_product_era']=="Edward VII") echo "selected"; ?>>Edward VII</option>
                <option value="george-v" <?php if(isset($_GET['edit'])) if($editrow['fld_product_era']=="George V") echo "selected"; ?>>George V</option>
                <option value="victoria" <?php if(isset($_GET['edit'])) if($editrow['fld_product_era']=="Victoria") echo "selected"; ?>>Victoria</option>
              </select>
            </li>

            <li>
              <label for="condition">Condition</label>
              <select id="condition" name="product_condition">
                <option disabled selected value="">Select</option>
                <option value="mint-no-gum" <?php if(isset($_GET['edit'])) if($editrow['fld_product_condition']=="Mint No Gum") echo "selected"; ?>>Mint No Gum</option>
                <option value="mint-hinged" <?php if(isset($_GET['edit'])) if($editrow['fld_product_condition']=="Mint Hinged") echo "selected"; ?>>Mint Hinged</option>
                <option value="used" <?php if(isset($_GET['edit'])) if($editrow['fld_product_condition']=="Used") echo "selected"; ?>>Used</option>
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
      <table border="1" style="width: 100%;">
        <tr>
          <td style="width: 4%;">ID</td>
          <td style="width: 50%;">Name</td>
          <td style="width: 8%;">Price (RM)</td>
          <td style="width: 8%;">Region</td>
          <td style="width: 4%;">Year</td>
          <td style="width: 8%">Era</td>
          <td style="width: 8%">Condition</td>
          <td style="width: 15%"></td>
        </tr>

        <?php
        // Read
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
            <a href="products_details.php?pid=<?php echo $readrow['fld_product_id']; ?>">Details</a>
            <a href="products.php?edit=<?php echo $readrow['fld_product_id']; ?>">Edit</a>
            <a href="products.php?delete=<?php echo $readrow['fld_product_id']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
          </td>
        </tr>

        <?php
        }
        if (!isset($_GET['edit'])){
          $id = ltrim($readrow['fld_product_id'], 'SID')+1;
          $id = 'SID'.str_pad($id,2,"0",STR_PAD_LEFT);
        }
        elseif(!isset($_GET['edit'])){
            $id = 'O'.str_pad(1,2,"0",STR_PAD_LEFT);
          }
        $conn = null;
        ?>
        <script type="text/javascript">
          if("<?php echo $id ?>" !== null && "<?php echo $id ?>" !== ""){
            var pid = document.getElementById("pid");
            pid.value = "<?php echo $id ?>";
            pid.readOnly = true;
          }

        </script>

      </table>
    </div>
</body>
</html>