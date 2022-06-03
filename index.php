
 <?php
// session_start();
require 'database.php';
if(!$_SESSION["login"]){
   header("location:login.php");
   die;
}?>

<!--
  Matric Number: A175128
  Name: NIK MUHAMMAD LUQMAN HAKIM BIN MOHD ROZAKI
-->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  
  <title>Italian Cuisine : Products</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php include_once 'nav_bar.php'; ?>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&display=swap" rel="stylesheet">
   <link href="css/bootstrap.min.css" rel="stylesheet">
 
 <style type="text/css">

 html {
        width:100%;
        height:100%;
        background:url(logo.png) center center no-repeat;
        min-height:100%;
      }
      
    body{
      margin: 0;
    font-family: 'Roboto Mono', monospace;
  }
    header{
      text-align: center;
      padding-top: 8px;
      padding-bottom: 8px;
      font-weight: 500;
    }
    header a{
      text-decoration: none;
    }
    #products-form{
      margin: 64px auto;
    }
    input{
      margin-bottom: 8px;
    }
    select{
      margin-bottom: 8px;
    }
    .table-product, th, td{
      margin: 48px auto;
      border: 1px solid black;
    }
    th, td{
      padding: 8px;
    }
    caption{
      font-size: 24px;
    }

  </style>
</head>
<body>

<section class="container-fluid">
    <div class="container content" id="searchbox">
      <div class="text-center" style="margin-bottom: 3rem;">
        <div class="row">
          <div class="col-md-12">
            <h1>Italian Cuisine : Products</h1>
            <hr style="border-top: 1px solid transparent;"/>
            <p class="text-muted">Search product by name, price, type or all three.</p>
          </div>
          <div class="col-md-12">
            <form action="#" method="POST" id="searchForm">
              <div class="form-group">
                <input type="text" class="form-control text-center input-lg" id="inputSearch" name="search"
                placeholder="Smoked 35.00 Main" autocomplete="off" required>
                <span id="helpBlock2" class="help-block"></span>
              </div>

              <button type="submit" class="btn btn-lg btn-primary">Search</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="resultSection" class="container resultList" style="padding: 20px;display: none;">
    <div class="text-center">
      <h2>Result</h2>
      <p>Found <span class="result-count">0</span> results.</p>
    </div>
      <div class="row list-item"></div>
  </div>

</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
  $("#searchForm").submit(function (e) {
    e.preventDefault();

    var input = $("#inputSearch");
    var val = input.val();

    input.parent().removeClass('has-error');
    input.parent().find("#helpBlock2").text("");

    if (val.length > 2) {
      $.ajax({
        url: 'search.php',
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
              if (data.FLD_PRD_IMAGE === '')
                data.FLD_PRD_IMAGE = data.FLD_PRD_ID + '.png';

             
              $('.list-item').append(`<div class="col-md-4">
                <div class="thumbnail thumbnail-dark">
                <img src="products/${data.FLD_PRD_IMAGE}" alt="${data.FLD_PRD_NAME}" style="height: 345px;">
                <div class="caption text-center">
                <h3>${data.FLD_PRD_NAME}</h3>
                <p>
                <a href="products_details.php?pid=${data.FLD_PRD_ID}" class="btn btn-primary" role="button">View</a>
                </p>
                </div>
                </div>
                </div>`);
            });
           
            

              $(".resultList").show("slow", function () {
                $("body").removeClass('loading');
              });
              $('html, body').animate({
                scrollTop: $("#resultSection").offset().top
              }, 500);
            }else{
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
      $('.splide__list').empty();
    }
  });

</script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- <script src="js/bootstrap.min.js"></script> -->


</body>
</html>