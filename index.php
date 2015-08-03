<!DOCTYPE html>
<?php
 /* 
 * @author Mariocoski
 * @email mariuszrajczakowski@gmail.com 
 * @github https://github.com/mariocoski/Bootstrap-calendar
 * Copyright (c) 2015 Mariocoski
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
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
    <title>Mariocoski Bootstrap Calendar DEMO</title>
    <!-- Bootstrap core CSS -->
    <link href='<?php echo BOOTSTRAP_CSS; ?>bootstrap.css' rel='stylesheet'>
    <link href='<?php echo CSS; ?>calendar.css' rel='stylesheet'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
 <body>
  <!--container--> 
  
  
   <!--DEMO CONTENT-->
   <div class="container">
    <!--CALENDAR 1-->   
    <?php
    //COMPANY1 DETAILS FROM DATABASE
    $calendar_details1 = Helper::getCompanyDetails(334455);
    $company_name1 = (isset($calendar_details1[0]['company_name']))?  $calendar_details1[0]['company_name']:"Company Name";
    $company_address1 = (isset($calendar_details1[0]['address']))?  $calendar_details1[0]['address']:"Street Name";
    $company_postcode1 = (isset($calendar_details1[0]['postcode']))?  $calendar_details1[0]['postcode']:"Postcode";
    $company_city1 = (isset($calendar_details1[0]['city']))?  $calendar_details1[0]['city']:"City";
    $company_country1 = (isset($calendar_details1[0]['country']))?  $calendar_details1[0]['country']:"Country";
    $company_website1 = (isset($calendar_details1[0]['website']))?  $calendar_details1[0]['website']:"www.example.com";
    ?>
    
    <!--HORIZONTAL CALENDAR 1-->
    <div class="row">
      <div class="col-sm-12">
        <h3><span class="glyphicon glyphicon-calendar"></span> Try the demo!</h3>
      </div>
    <!-- SMALL CALENDAR 1-->
    <!-- you could use this i.e. on mobile version of your website 
         or make it visible when resized to small if you have only responsive desktop version -->
      <div class="col-sm-12 visible-xs">
        <div class="horizontal-calendar-small-wrapper" data-calendar-id="334455" id="horizontal-calendar-small-wrapper-334455">
          <div class='preloader2'></div>
        </div><!--end of horizontal-calendar-small-wrapper-->  
      </div><!--end of col-sm-12-->
    <!--end of SMALL CALENDAR 1-->  
    </div><!--end of row-->   
     
    <div class="row marg-top "> 
      <!-- BIG CALENDAR 1-->
      <!-- left column with company 1 details-->
      <div class="col-sm-4 hidden-xs">
        <div class="panel panel-default panel-address panel-calendar-height">
          <div class="company-tag label label-primary">Company details</div>
            <div class='panel-body'>
              <h4><?php echo Helper::sanitize($company_name1); ?></h4>  
              <!-- google maps src could be also added to database calendar details-->
              <iframe class="company-map" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10005.987536989032!2d-0.17200722065429716!3d51.17306419433358!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4875f009c1687cbd%3A0x9eff037ed990331d!2s60+Hevers+Ave%2C+Horley%2C+Surrey+RH6!5e0!3m2!1sen!2suk!4v1424272017224"></iframe>
              <h4><?php echo Helper::sanitize($company_address1); ?></h4>
              <p><?php echo Helper::sanitize($company_address1); ?></p>
              <p><?php echo Helper::sanitize($company_postcode1)." ".Helper::sanitize($company_city1) ; ?></p>
              <p>Country</p>
              <p><a href='#'><?php echo Helper::sanitize($company_website1); ?></a><p>
            </div><!--end of panel-body-->        
        </div><!--end of panel-->    
      </div><!--end of col-sm-4-->
      
      <!-- right column with big calendar 1 -->
      <div class='col-sm-8 hidden-xs'>
        <div id="horizontal-calendar-big-wrapper-334455" data-calendar-id="334455" class="horizontal-calendar-big-wrapper carousel slide" data-wrap="false" data-ride="carousel" data-interval="false">
          <div class='preloader'></div>
        </div><!--end of horizontal-calendar-big-->
      </div><!--end of col-sm-8-->
      <!--end of BIG CALENDAR 1-->
    </div><!--end of row-->
      
    <!--end of CALENDAR 1 -->
    
    <!--CALENDAR 2-->
    <?php
    //COMPANY2 DETAILS FROM DATABASE
     $calendar_details2 = Helper::getCompanyDetails(667788); 
     $company_name2 = (isset($calendar_details2[0]['company_name']))?  $calendar_details2[0]['company_name']:"Company Name";
     $company_address2 = (isset($calendar_details2[0]['address']))?  $calendar_details2[0]['address']:"Street Name";
     $company_postcode2 = (isset($calendar_details2[0]['postcode']))?  $calendar_details2[0]['postcode']:"Postcode";
     $company_city2 = (isset($calendar_details2[0]['city']))?  $calendar_details2[0]['city']:"City";
     $company_country2 = (isset($calendar_details2[0]['country']))?  $calendar_details2[0]['country']:"Country";
     $company_website2 = (isset($calendar_details2[0]['website']))?  $calendar_details2[0]['website']:"www.example.com";
     ?>
    <!--HORIZONTAL CALENDAR 2-->
    <div class="row">  
    <!-- SMALL CALENDAR 2-->
    <!-- you could use this i.e. on mobile version of your website 
         or make it visible when resized to small if you have only responsive desktop version -->  
    <div class="col-sm-12 visible-xs">
      <div class="horizontal-calendar-small-wrapper" data-calendar-id="667788" id="horizontal-calendar-small-wrapper-667788">
        <div class='preloader2'></div>
      </div><!--end of horizontal-calendar-small-wrapper-->  
    </div><!--end of col-sm-12-->
     <!--end of SMALL CALENDAR 2-->
    </div><!--end of row-->   
    
    <div class="row marg-top">
    <!-- BIG CALENDAR 2-->
    <!-- left column with company 2 details-->
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
    <!-- right column with big calendar 2 -->    
      <div class='col-sm-8 hidden-xs'>
        <div id="horizontal-calendar-big-wrapper-667788" data-calendar-id="667788" class="horizontal-calendar-big-wrapper carousel slide" data-wrap="false" data-ride="carousel" data-interval="false">
          <div class='preloader'></div>
        </div><!--end of horizontal-calendar-big-->
      </div><!--end of col-sm-8-->
    <!--end of BIG CALENDAR2 -->  
    </div><!--end of row-->
    </div><!--container -->
    
    <!--END OF DEMO CONTENT-->
    
    <div class="container-fluid container-footer">
      <div class="container">
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
    <script type="text/javascript" src='<?php echo JS; ?>jquery.js'></script>
    <script type="text/javascript" src='<?php echo BOOSTRAP_JS; ?>bootstrap.js'></script>
    <script type="text/javascript" src='<?php echo JS; ?>cors.js'></script>
    <script type="text/javascript" src='<?php echo JS; ?>bootstrap-calendar.js'></script>
    <script type="text/javascript" src='<?php echo JS; ?>calendar.js'></script>
    
  </body>
  
</html>

