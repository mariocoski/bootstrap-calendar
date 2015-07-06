<?php
/*
calendar_id
number_of_weeks

0. Wrapper with calendar-data with calendar id

1. horizontal-calendar-mobile
  - visible-xs
    - col-xs-12
    - extra data
	- day calendar

2. horizontal-calendar-desktop
  - hidden-xs
  - cols-sm-8 
    week calendar
	
  - cols-sm-4 
    extra data
	
3. vertical-calendar-responsive
  - css override
  - cols-sm-8
  
*/
?>
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

    <title>Mariocoski Bootstrap Calendar</title>

    <!-- Bootstrap core CSS -->
    <link href='<?php echo BOOTSTRAP_CSS; ?>bootstrap.css' rel='stylesheet'>
    <link href='<?php echo BOOTSTRAP_CSS; ?>calendar.css' rel='stylesheet'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
 <body>
   <!--navigation-->  
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
              <li class="active"><a href="demo.php">Demo</a></li>
            <li><a href="#about">Documentation</a></li>
            <li><a href="#contact">Download</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div><!--end of container-->
    </nav>
    
   
   <!-- jumbotron-->
  <div class="jumbotron">
    <div class="container">
        <h1>Mariocoski Bootstrap Calendar</h1>
        <h2>Demo</h2>
      </div>
  </div>
  <!--container--> 
   <div class="container">
      
       <!--horizontal calendar 1-->
       <div class="row">
        <!-- small horizontal calendar 1-->
        <div class="col-sm-12 visible-xs">
          <div class="horizontal-calendar-small-wrapper">
            Small calendar 1
          </div><!--end of horizontal-calendar-small-wrapper-->  
        </div><!--end of col-sm-12-->
       
        <!-- big horizontal calendar 1-->
        <div class="col-sm-4 hidden-xs">
          <div class="panel panel-default panel-address">
              <div class="company-tag label label-primary">Company details</div>
            <div class='panel-body'>
              <h4>Location 1</h4>  
              <iframe class="company-map" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10005.987536989032!2d-0.17200722065429716!3d51.17306419433358!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4875f009c1687cbd%3A0x9eff037ed990331d!2s60+Hevers+Ave%2C+Horley%2C+Surrey+RH6!5e0!3m2!1sen!2suk!4v1424272017224"></iframe>
              <h4>Address</h4>
              <p>Street Name</p>
                  <p>Postcode Location</p>
                  <p>Country</p>
                <p><a href='#'>www.example.com</a><p>
            </div><!--end of panel-body-->        
          </div><!--end of panel-->    
        </div><!--end of col-sm-4-->
        
        <div class='col-sm-8 hidden-xs'>
          <div id="334455" data-calendar-id="334455" class="horizontal-calendar-big-wrapper carousel slide" data-wrap="false" data-ride="carousel" data-interval="false">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" id="carousel_inner_334455" role="listbox">
              <div class="item active">
                <?php require 'calendar_json.php'; ?>
                <div class="horizontal-calendar-big-background"></div>
                <div class="horizontal-calendar-big-background"></div>
                <div class="horizontal-calendar-big-background"></div>
              </div>
              <div class="item">
                 <?php require 'calendar_json.php'; ?>
                <div class="horizontal-calendar-big-background"></div>
                <div class="horizontal-calendar-big-background"></div>
                <div class="horizontal-calendar-big-background"></div>
              </div>
              <div class="item">
                 <?php require 'calendar_json.php'; ?>
                <div class="horizontal-calendar-big-background"></div>
                <div class="horizontal-calendar-big-background"></div>
                <div class="horizontal-calendar-big-background"></div>
              </div>
              <div class="item">
                 <?php require 'calendar_json.php'; ?>
                <div class="horizontal-calendar-big-background"></div>
                <div class="horizontal-calendar-big-background"></div>
                <div class="horizontal-calendar-big-background"></div>
              </div>
                
            </div><!--end of carousel-inner-->  
            <!-- Left and right controls -->
            <a class="left horizontal-calendar-big-left carousel-control"  id="left_334455" href="#334455" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right horizontal-calendar-big-right carousel-control" id="right_334455" href="#334455" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div><!--end of horizontal-calendar-big-->
        </div><!--end of col-sm-8-->
        
        
      </div><!--end of row-->
      
       <div class="row">
        <!-- small horizontal calendar 1-->
        <div class="col-sm-12 visible-xs">
          <div class="horizontal-calendar-small-wrapper">
            Small calendar 2
          </div><!--end of horizontal-calendar-small-wrapper-->  
        </div><!--end of col-sm-12-->
       
        <!-- big horizontal calendar 1-->
        <div class="col-sm-4 hidden-xs">
          <div class="panel panel-default panel-address">
              <div class="company-tag label label-primary">Company details</div>
            <div class='panel-body'>
              <h4>Location 2</h4>  
              <iframe class="company-map" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10005.987536989032!2d-0.17200722065429716!3d51.17306419433358!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4875f009c1687cbd%3A0x9eff037ed990331d!2s60+Hevers+Ave%2C+Horley%2C+Surrey+RH6!5e0!3m2!1sen!2suk!4v1424272017224"></iframe>
              <h4>Address</h4>
              <p>Street Name</p>
                  <p>Postcode Location</p>
                  <p>Country</p>
                <p><a href='#'>www.example.com</a><p>
            </div><!--end of panel-body-->        
          </div><!--end of panel-->    
        </div><!--end of col-sm-4-->
        
        <div class='col-sm-8 hidden-xs'>
          <div id="667788" data-calendar-id="667788" class="horizontal-calendar-big-wrapper carousel slide" data-wrap="false" data-ride="carousel" data-interval="false">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" id="carousel_inner_667788" role="listbox">
              <div class="item active">
                <?php require 'calendar_json.php'; ?>
                <div class="horizontal-calendar-big-background"></div>
                <div class="horizontal-calendar-big-background"></div>
                <div class="horizontal-calendar-big-background"></div>
              </div>
              <div class="item">
                 <?php require 'calendar_json.php'; ?>
                <div class="horizontal-calendar-big-background"></div>
                <div class="horizontal-calendar-big-background"></div>
                <div class="horizontal-calendar-big-background"></div>
              </div>
              <div class="item">
                 <?php require 'calendar_json.php'; ?>
                <div class="horizontal-calendar-big-background"></div>
                <div class="horizontal-calendar-big-background"></div>
                <div class="horizontal-calendar-big-background"></div>
              </div>
              <div class="item">
                 <?php require 'calendar_json.php'; ?>
                <div class="horizontal-calendar-big-background"></div>
                <div class="horizontal-calendar-big-background"></div>
                <div class="horizontal-calendar-big-background"></div>
              </div>
                
            </div><!--end of carousel-inner-->  
            <!-- Left and right controls -->
            <a class="left horizontal-calendar-big-left carousel-control"  id="left_667788" href="#667788" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right horizontal-calendar-big-right carousel-control" id="right_667788" href="#667788" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div><!--end of horizontal-calendar-big-->
        </div><!--end of col-sm-8-->
        
        
      </div><!--end of row-->
      
      
      </div><!--container -->
      
    <div class="container-fluid container-footer">
      <div class="container calendar-footer">
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
    <script src='<?php echo BOOSTRAP_JS; ?>calendar.js'></script>
    
  </body>
  
</html>

