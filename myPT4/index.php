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
    <link rel="stylesheet" href="css/background.css">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<style>
    body {
        margin: 0;
        padding: 0;
        height: 100%;
        width: 100%;
        /* background: #161616;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center; */
    }
    ::-webkit-input-placeholder {
        font-style: italic;
        }
        :-moz-placeholder {
        font-style: italic;  
        }
        ::-moz-placeholder {
        font-style: italic;  
        }
        :-ms-input-placeholder {  
        font-style: italic; 
        }
</style>

<body style="overflow-x: hidden;">
    <?php include_once 'nav_bar.php'; ?>
    <div>
    <img src="products/logo.png" alt="rarestamplogo" width=400px" height="400px" style="display: block; margin:0 auto">
    </div>
    <section>
        <div>
            <form action="#" method="POST" id="searchForm">
                <div class='container' id="searchBar">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8">
                            <div class="input-group">
                                <input type="text" id="inputSearch" name="search" class="form-control input-lg" placeholder="Enter search keywords (name, country, or condition)" required>
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-lg" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</button>
                                </span>
                            </div><!-- /input-group --> 
                             <!-- <span id="helpBlock2" class="help-block"></span> -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>  
    <section>
        <div class="container resultList text-center" style="padding-top: 30px; display: none;">
            <h2 style="color: #fff;">Result</h2>
            <p style="color: #fff;">Found <span class="result-count">0</span> results.</p>
        </div>
    <!-- </section> -->
        <div class="row list-item" style="margin: 16px;"></div>
    </section>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" integrity="sha256-qM7QTJSlvtPSxVRjVWNM2OfTAz/3k5ovHOKmKXuYMO4=" crossorigin="anonymous"></script>
    <script>
        $("#searchForm").submit(function (e) {
        e.preventDefault();

        var input = $("#inputSearch");
        var val = input.val();

        input.parent().removeClass('has-error');
        input.parent().find("#helpBlock2").text("");

        if (val.length > 2 /* && (val.split(" ").length==1 || val.split(" ").length==3)*/) {
            $.ajax({
                url: 'ajax/search.php',
                type: 'get',
                dataType: 'json',
                data: {
                    search: val
                },
                beforeSend: function () {
                    $("body").addClass('loading');
                    input.addClass('disabled');
                },
                success: function (res) {
                    $('.list-item').empty();

                    if (res.status == 200) {
                        console.log(res.data);
                        $(".result-count").text(res.data.length);

                        $.each(res.data, function (idx, data) {
                            if (data.fld_product_image === '')
                                data.fld_product_image = data.fld_product_id + '.jpg';

                            $('.list-item').append(`<div class="col-md-6">
                                <div class="thumbnail thumbnail-dark">
                                <img src="products/${data.fld_product_image}" alt="${data.fld_product_name}" style="height: 150px; margin-top: 20px">
                                <div class="caption text-center">
                                <h3>${data.fld_product_name}</h3>
                                <p>
                                <a href="products_details.php?pid=${data.fld_product_id}" class="btn btn-primary btn-lg active" role="button">View Details</a>
                                </p>
                                </div>
                                </div>
                                </div>`);
                        });

                        $(".resultList").show("slow", function () {
                            $("body").removeClass('loading');

                            $('html, body').animate({
                                scrollTop: $("#resultSection").offset().top
                            }, 500);
                        });
                    }
                    else {
                        console.log(res.data);
                    }
                },
                complete: function () {
                    input.removeClass('disabled');
                }
            });
        } else {
            input.parent().addClass("has-error");
            input.parent().find("#helpBlock2").text("Please enter more than 2 characters.");

            $('.list-item').empty();
        }
    });
    </script>
</body>
</html>