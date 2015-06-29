<!DOCTYPE html>
<?php
  //path to config file
  //REMEMBER: set the correct path to init.php 
  require 'config/init.php';

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Bootstrap Calendar by Mariocoski">
    <meta name="author" content="Mariocoski">

    <title>Maricoski Bootstrap Calendar</title>

    <!-- Bootstrap core CSS -->
    <link href='<?php echo BOOTSTRAP_CSS; ?>bootstrap.css' rel='stylesheet'>
    <link href='<?php echo BOOTSTRAP_CSS; ?>style.css' rel='stylesheet'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
 
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Mariocoski Calendar</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
              <li class="active"><a href="#">Demo</a></li>
            <li><a href="#about">Documentation</a></li>
            <li><a href="#contact">Download</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
        
     
        
      </div>
    </nav>
      
    <div class="container">

      <div class="starter-template">
        <h1>Mariocoski Bootstrap Calendar</h1>
        <p class="lead">This is a bootstrap plugin which allow user to make an appointment<br> All you need is simply download the project and change the paths and credentials</p>
      </div>
      <div class="row">  
          <div class='col-sm-8'>
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
        <h2>Week 1</h2>
    </div>

    <div class="item">
      <h2>Week 2</h2>
    </div>

    <div class="item">
      <h2>Week 3</h2>
    </div>

    <div class="item">
      <h2>Week 4</h2>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
          </div>  
      </div><!--end of row-->
      </div><!-- /.container -->
    <div class="container-fluid container-footer">
      <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <h6>Features</h6>  
        </div>
        <div class="col-sm-4">
          <h6>Social Media</h6>  
        </div>  
        <div class="col-sm-4">
          <h6>Contact us</h6>  
        </div>  
            
      </div><!--end of row-->
      </div>
    </div><!--end of container-footer-->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script  src='<?php echo BOOSTRAP_JS; ?>jquery.js'></script>
    <script src='<?php echo BOOSTRAP_JS; ?>bootstrap.js'></script>
    <script src='<?php echo BOOSTRAP_JS; ?>custom.js'></script>
    
  </body>
  
</html>
