<!--
Muhammad Syazili bin Juhari
A173630
-->
<?php
require 'database.php';

if (!isset($_SESSION['loggedin']))
    header("LOCATION: login.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Rare Stamps: Home</title>
    <link rel="shortcut icon" type="image/x-icon" href="products/icon.png"/>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<style>
    /* html {
        width:100%;
        height:100%;
        background:url(products/background.png) center center no-repeat;
        background-size: 100% 100%;
        background-color: #161616;
        min-height:100%;
    } */

    body {
        margin: 0;
        padding: 0;
        height: 100%;
        width: 100%;
        /* background-image: url(products/background.png); */
        background: #161616;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
    }

    input:focus {
        outline-offset: -2px;
    }
    #searchBar {
        position:absolute;
        top: 50%;
        left: 46%;
        width:100%;
    
        margin-top: -1em; /*set to a negative number 1/2 of your height*/
        margin-left: -15em; /*set to a negative number 1/2 of your width*/
    
    }

    #submitsearch{
        border: 1px solid rgb(138, 134, 134);
        margin-left: -86px;
        padding: 5px;
        border-radius: 19px;
        cursor: pointer;
        padding-left: 10px;
        padding-right: 8px; 
        padding-top: 6px;

        display: none;
        box-shadow: 0 0 1px black;     
        margin-right:110px;
    }

    #inputSearch {
        width: 30%;
        border: 1px solid #000;
        border-radius: 30px;
        font-size: 16px;
        background-color: white;
        background-image:url('https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/search-24.png');

        background-position: 10px 7px;
        background-repeat: no-repeat;
        padding: 8px 20px 8px 40px;
        -webkit-transition: width 0.8s ease-in-out;
        transition: width 0.8s ease-in-out;
        outline: none;
        opacity: 0.9;

        }
    button {
        background-color: Transparent;
        background-repeat:no-repeat;
        border: none;
        cursor:pointer;
        overflow: hidden;
        outline:none;
    }

</style>

<body style="overflow-x: hidden;">
    <?php include_once 'nav_bar.php'; ?>
    <div>
    <img src="products/logo.png" alt="rarestamplogo" width=20%" height="20%" style="display: block; margin:0 auto">
    </div>
    <div>
        <form action="#" method="POST" id="searchForm">
            <div class='container' id="searchBar">
                <input type="text" id="inputSearch"  placeholder="Search Products">
                <div id='submitsearch'>
                <span><button type="submit">Search</button></span>
                </div>
            </div>
        </form>
    </div>
        
    <!-- <section class="container resultList" style="padding-top: 10%;display: none;"> -->
        <div class="container resultList text-center" style="padding-top: 30px; display: none;">
            <h2 style="color: #fff;">Result</h2>
            <p style="color: #fff;">Found <span class="result-count">0</span> results.</p>
        </div>
    <!-- </section> -->
        <div class="row list-item" style="margin: 16px;"></div>
    <!-- </section> -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
        $("#inputSearch").focus(function () {
  
        $("#inputSearch").css({
            "display": "inline",
            "width": "32%",
            "border": "1px solid #40585d",
            "opacity": "1",
            "padding": "8px 20px 8px 20px",
            "background-image": "none",
            "box-shadow": "0 0 1px black"
        });
        $("#submitsearch").css("display", "inline");
        
        $("#inputSearch").prop("placeholder", "");
        }); 
        $("#searchForm").submit(function (e) {
        e.preventDefault();

        var input = $("#inputSearch");
        var val = input.val();

        input.parent().removeClass('has-error');
        input.parent().find("#helpBlock2").text("");

        if (val.length > 2) {
            $.get('ajax/search.php', {search: val}).done(function (res) {
                $('.list-item').empty();

                if (res.status == 200) {
                    $(".result-count").text(res.data.length);

                    $.each(res.data, function (idx, data) {
                        if (data.fld_product_image === '')
                            data.fld_product_image = data.fld_product_id + '.jpg';

                        $('.list-item').append(`
                        <div class="col-md-6">
                            <div class="thumbnail">
                                <img src="products/${data.fld_product_image}" alt="${data.fld_product_name}" style="height: 150px;">
                                <div class="caption text-center">
                                    <h3>${data.fld_product_name}</h3>
                                    <p>
                                        <a href="products_details.php?pid=${data.fld_product_id}" class="btn btn-primary" role="button">View</a>
                                    </p>
                                </div>
                            </div>
                        </div>`);
                    });
                }
            });

            $(".resultList").show("slow");
        } else {
            input.parent().addClass("has-error");
            input.parent().find("#helpBlock2").text("Please enter more than 2 characters.");

            $('.list-item').empty();
        }
    }); 
    </script>
</body>
</html>