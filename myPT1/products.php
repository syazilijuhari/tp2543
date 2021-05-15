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
              <input type="text" id="pid" name="product_id">
            </li>
            <li>
              <label for="pname">Name</label>
              <input type="text" id="pname" name="product_name">
            </li>
            <li>
              <label for="price">Price (RM)</label>
              <input type="number" id="price" name="product_price" min="0.00" max="1000000.00" step="0.01">
            </li>
            <li>
              <label for="region">Region</label>
              <select id="region" name="product_region">
                <option disabled selected>Select</option>
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
                  <option value="<?= $key ?>" title="<?= htmlspecialchars($value) ?>"><?= htmlspecialchars($value) ?></option>
                  <?php
                  }
                ?>
              </select>
            </li>

            <li>
              <label for="year">Year</label>
              <select id="year" name="product_year">
                <option disabled selected>Select</option>
                <?php
                  $years = array_combine(range(date("Y"), 1800), range(date("Y"), 1800));
                  foreach ($years as $year) {
                      echo "<option value='$year'>{$year}</option>";
                  }
                ?>
              </select>
            </li>

            <li>
              <label for="era">Era</label>
              <select id="era" name="product_era">
                <option disabled selected>Select</option>
                <option value="edward-vii">Edward VII</option>
                <option value="george-v">George V</option>
                <option value="victoria">Victoria</option>
              </select>
            </li>

            <li>
              <label for="condition">Condition</label>
              <select id="condition" name="product_condition">
                <option disabled selected>Select</option>
                <option value="mint-no-gum">Mint No Gum</option>
                <option value="mint-hinged">Mint Hinged</option>
                <option value="used">Used</option>
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
      <table border="1" style="width: 90%;">
        <tr>
          <td style="width: 4%;">ID</td>
          <td style="width: 40%;">Name</td>
          <td style="width: 10%;">Price (RM)</td>
          <td style="width: 10%;">Region</td>
          <td style="width: 6%;">Year</td>
          <td style="width: 10%">Era</td>
          <td style="width: 10%">Condition</td>
          <td style="width: 20%"></td>
        </tr>
        <tr>
          <td>SID01</td>
          <td>Fed Malay States 1900 $1 Green & Pale Green SG23</td>
          <td>489.35</td>
          <td>Malaysia</td>
          <td>1900</td>
          <td>Victoria</td>
          <td>Mint Hinged</td>
          <td>
            <a href="products_details.php">Details</a>
            <a href="products.php">Edit</a>
            <a href="products.php">Delete</a>
          </td>
        </tr>
        <tr>
          <td>SID02</td>
          <td>Fed of Malay States 1904 10c Grey-Brown & Claret SG43</td>
          <td>462.16</td>
          <td>Malaysia</td>
          <td>1904</td>
          <td>Edward VII</td>
          <td>Mint Hinged</td>
          <td>
            <a href="products_details.php">Details</a>
            <a href="products.php">Edit</a>
            <a href="products.php">Delete</a>
          </td>
        </tr>
        <tr>
          <td>SID06</td>
          <td>Hawaii 1863 1c Black-Greyish SG12 Sc15</td>
          <td>1631.17</td>
          <td>United States</td>
          <td>1863</td>
          <td>Victoria</td>
          <td>Mint No Gum</td>
          <td>
            <a href="products_details.php">Details</a>
            <a href="products.php">Edit</a>
            <a href="products.php">Delete</a>
          </td>
        </tr>
        <tr>
          <td>SID38</td>
          <td>Newfoundland 1857 2d Scarlet-Vermilion SG2</td>
          <td>6796.54</td>
          <td>Canada</td>
          <td>1857</td>
          <td>Victoria</td>
          <td>Used</td>
          <td>
            <a href="products_details.php">Details</a>
            <a href="products.php">Edit</a>
            <a href="products.php">Delete</a>
          </td>
        </tr>
        <tr>
          <td>SID14</td>
          <td>Hawaii 1863 2c Pale Rose SG20 Sc27 Litho Horiz Laid Paper</td>
          <td>951.52</td>
          <td>United States</td>
          <td>1863</td>
          <td>Victoria</td>
          <td>Mint Hinged</td>
          <td>
            <a href="products_details.php">Details</a>
            <a href="products.php">Edit</a>
            <a href="products.php">Delete</a>
          </td>
        </tr>
        <tr>
          <td>SID22</td>
          <td>Australia 1914 5d Chestnut SG022</td>
          <td>206.61</td>
          <td>Australia</td>
          <td>1914</td>
          <td>George V</td>
          <td>Used</td>
          <td>
            <a href="products_details.php">Details</a>
            <a href="products.php">Edit</a>
            <a href="products.php">Delete</a>
          </td>
        </tr>
        <tr>
          <td>SID17</td>
          <td>China Shanghai 1866 6ca Red-Brown SG18</td>
          <td>1495.24</td>
          <td>China</td>
          <td>1866</td>
          <td>Victoria</td>
          <td>Mint No Gum</td>
          <td>
            <a href="products_details.php">Details</a>
            <a href="products.php">Edit</a>
            <a href="products.php">Delete</a>
          </td>
        </tr>
        <tr>
          <td>SID29</td>
          <td>Queensland 1860 1d Carmine-Rose SG1</td>
          <td>788.4</td>
          <td>Australia</td>
          <td>1860</td>
          <td>Victoria</td>
          <td>Used</td>
          <td>
            <a href="products_details.php">Details</a>
            <a href="products.php">Edit</a>
            <a href="products.php">Delete</a>
          </td>
        </tr>
        <tr>
          <td>SID41</td>
          <td>GB 1915 10s Deep Blue SG411 D.L.R</td>
          <td>7290.24</td>
          <td>United Kingdom</td>
          <td>1915</td>
          <td>George V</td>
          <td>Mint Hinged</td>
          <td>
            <a href="products_details.php">Details</a>
            <a href="products.php">Edit</a>
            <a href="products.php">Delete</a>
          </td>
        </tr>
        <tr>
          <td>SID42</td>
          <td>India 1855 4d Blue & Red SG21 Head III Frame I V.F.U 4</td>
          <td>8100.26</td>
          <td>India</td>
          <td>1855</td>
          <td>Victoria</td>
          <td>Used</td>
          <td>
            <a href="products_details.php">Details</a>
            <a href="products.php">Edit</a>
            <a href="products.php">Delete</a>
          </td>
        </tr>
      </table>
    </div>
</body>
</html>