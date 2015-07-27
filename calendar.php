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
    <script src="https://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
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
              <li class="active"><a href="calendar.php">Demo</a></li>
            <li><a href="#about">Documentation</a></li>
        <!--    <li><a href="#contact">Download</a></li>
            <li><a href="#contact">Contact</a></li>-->
          </ul>
        </div><!--/.nav-collapse -->
      </div><!--end of container-->
    </nav>
   <!-- jumbotron-->
  <div class="jumbotron">
    <div class="container starter-template">
        <h1>Mariocoski Bootstrap Calendar</h1>
        <h2>Demo</h2>
      </div>
  </div>
  <!--container--> 
   <div class="container">
      <?php
      try{
         $db = new DB();
         $query_calendar1 = "SELECT * FROM `mariocoski_calendar` WHERE calendar_id=:calendar_id";
         $run_calendar1 = $db->prepare($query_calendar1);
         $run_calendar1->execute(array(":calendar_id"=>334455));
         $calendar_details1 = $run_calendar1->fetchAll(PDO::FETCH_ASSOC); 
         
          $company_name1 = (isset($calendar_details1[0]['company_name']))?  $calendar_details1[0]['company_name']:"Company Name";
          $company_address1 = (isset($calendar_details1[0]['address']))?  $calendar_details1[0]['address']:"Street Name";
          $company_postcode1 = (isset($calendar_details1[0]['postcode']))?  $calendar_details1[0]['postcode']:"Postcode";
          $company_city1 = (isset($calendar_details1[0]['city']))?  $calendar_details1[0]['city']:"City";
          $company_country1 = (isset($calendar_details1[0]['country']))?  $calendar_details1[0]['country']:"Country";
          $company_website1 = (isset($calendar_details1[0]['website']))?  $calendar_details1[0]['website']:"www.example.com";
        }catch(PDOException $e){
         
        }catch(Exception $e){
       
        }
      ?>
       <!--horizontal calendar 1-->
     <div class="row">
        <div class="col-sm-12">
          <h3><span class="glyphicon glyphicon-calendar"></span> Make your appointments easily!</h3>
        </div>   
        <!-- small horizontal calendar 1-->
        <div class="col-sm-12 visible-xs">
          <div class="horizontal-calendar-small-wrapper" data-calendar-id="334455" id="horizontal-calendar-small-wrapper-334455">
            <div class='preloader2'></div>
          </div><!--end of horizontal-calendar-small-wrapper-->  
        </div><!--end of col-sm-12-->
     </div><!--end of row-->   
     <div class="row marg-top "> 
        <!-- big horizontal calendar 1-->
        <div class="col-sm-4 hidden-xs">
          <div class="panel panel-default panel-address panel-calendar-height">
              <div class="company-tag label label-primary">Company details</div>
            <div class='panel-body'>
                <h4><?php echo Helper::sanitize($company_name1); ?></h4>  
              <iframe class="company-map" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10005.987536989032!2d-0.17200722065429716!3d51.17306419433358!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4875f009c1687cbd%3A0x9eff037ed990331d!2s60+Hevers+Ave%2C+Horley%2C+Surrey+RH6!5e0!3m2!1sen!2suk!4v1424272017224"></iframe>
              <h4><?php echo Helper::sanitize($company_address1); ?></h4>
              <p><?php echo Helper::sanitize($company_address1); ?></p>
              <p><?php echo Helper::sanitize($company_postcode1)." ".Helper::sanitize($company_city1) ; ?></p>
                  <p>Country</p>
                <p><a href='#'><?php echo Helper::sanitize($company_website1); ?></a><p>
            </div><!--end of panel-body-->        
          </div><!--end of panel-->    
        </div><!--end of col-sm-4-->
        
        <div class='col-sm-8 hidden-xs'>
          <div id="horizontal-calendar-big-wrapper-334455" data-calendar-id="334455" class="horizontal-calendar-big-wrapper carousel slide" data-wrap="false" data-ride="carousel" data-interval="false">
           <div class='preloader'></div>
          </div><!--end of horizontal-calendar-big-->
        </div><!--end of col-sm-8-->
        </div><!--end of row-->
     <?php
      try{
         $db = new DB();
         $query_calendar2 = "SELECT * FROM `mariocoski_calendar` WHERE calendar_id=:calendar_id";
         $run_calendar2 = $db->prepare($query_calendar2);
         $run_calendar2->execute(array(":calendar_id"=>667788));
         $calendar_details2 = $run_calendar2->fetchAll(PDO::FETCH_ASSOC); 
          $company_name2 = (isset($calendar_details2[0]['company_name']))?  $calendar_details2[0]['company_name']:"Company Name";
          $company_address2 = (isset($calendar_details2[0]['address']))?  $calendar_details2[0]['address']:"Street Name";
          $company_postcode2 = (isset($calendar_details2[0]['postcode']))?  $calendar_details2[0]['postcode']:"Postcode";
          $company_city2 = (isset($calendar_details2[0]['city']))?  $calendar_details2[0]['city']:"City";
          $company_country2 = (isset($calendar_details2[0]['country']))?  $calendar_details2[0]['country']:"Country";
          $company_website2 = (isset($calendar_details2[0]['website']))?  $calendar_details2[0]['website']:"www.example.com";
        
          
        }catch(PDOException $e){
         
       }catch(Exception $e){
       
       }
      ?>   
        <div class="row">  
        <!-- small horizontal calendar 2-->
        <div class="col-sm-12 visible-xs">
          <div class="horizontal-calendar-small-wrapper" data-calendar-id="667788" id="horizontal-calendar-small-wrapper-667788">
              <div class='preloader2'></div>
          </div><!--end of horizontal-calendar-small-wrapper-->  
        </div><!--end of col-sm-12-->
     </div><!--end of row-->   
        <div class="row marg-top">
        <!-- big horizontal calendar 1-->
        <div class="col-sm-4 hidden-xs">
          <div class="panel panel-default panel-address">
              <div class="company-tag label label-primary">Company details</div>
            <div class='panel-body'>
              <h4><?php echo Helper::sanitize($company_name2); ?></h4>  
              <iframe class="company-map" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10005.987536989032!2d-0.17200722065429716!3d51.17306419433358!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4875f009c1687cbd%3A0x9eff037ed990331d!2s60+Hevers+Ave%2C+Horley%2C+Surrey+RH6!5e0!3m2!1sen!2suk!4v1424272017224"></iframe>
              <h4>Address</h4>
              <p><?php echo Helper::sanitize($company_address2);?></p>
                  <p><?php echo Helper::sanitize($company_postcode2)." ".Helper::sanitize($company_city2);  ?></p>
                  <p><?php echo Helper::sanitize($company_country2); ?></p>
                <p><a href='#'><?php echo Helper::sanitize($company_website2); ?></a><p>
            </div><!--end of panel-body-->        
          </div><!--end of panel-->    
        </div><!--end of col-sm-4-->
        
        <div class='col-sm-8 hidden-xs'>
          <div id="horizontal-calendar-big-wrapper-667788" data-calendar-id="667788" class="horizontal-calendar-big-wrapper carousel slide" data-wrap="false" data-ride="carousel" data-interval="false">
            <div class='preloader'></div>
          </div><!--end of horizontal-calendar-big-->
        </div><!--end of col-sm-8-->
      </div><!--end of row-->
    </div><!--container -->
    <div class="container-fluid container-footer">
      <div class="container calendar-footer">
      <div class="row">
           
        <div class="col-sm-6">
            <h6>Copyright &copy; <?php echo date("Y"); ?> Mariocoski</h6>  
        </div>  
        <div class="col-sm-6">
            <h6>Coded with <span class="glyphicon glyphicon-heart"></span> by Mariocoski</h6>  
        </div>
      </div><!--end of row-->
      </div>
    </div><!--end of container-footer-->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src='<?php echo BOOSTRAP_JS; ?>jquery.js'></script>
    <script type="text/javascript" src='<?php echo BOOSTRAP_JS; ?>bootstrap.js'></script>
    <script type="text/javascript" src='<?php echo BOOSTRAP_JS; ?>cors.js'></script>
    <script type="text/javascript" src='<?php echo BOOSTRAP_JS; ?>bootstrap-calendar.js'></script>
    <script type="text/javascript" src='<?php echo BOOSTRAP_JS; ?>calendar.js'></script>
    
  </body>
  
</html>

