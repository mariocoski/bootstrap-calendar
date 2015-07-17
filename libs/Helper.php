<?php
/*
 *
 */
class Helper{
  public function __construct() {
    
  }
  
  /**
* sanitize return sanitized strings
* $param $string - string to sanitize
* @return String 
*/  
  public static function sanitize($string){
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
  }
  
/**
* getMonthsCount checks if certain yeat has 53 or 52 weeks
* @return Integer
*/ 
 public function getMonthsCount($year){
  $date = new DateTime();
  $date->setISODate($year, 53);
  return ($date->format("W") === "53" ? 53 : 52);
}

public function prepareBigOutput($results=array(),$calendar_id,$first_day=0,$number_of_weeks=4, $booking_url="", $max_display){

  $output = "<div class='carousel-inner' id='carousel_inner_$calendar_id' role='listbox'>";
  //preparing datetime variables
  $current_week = date('W'); // i.e. 14
  $current_year = date('o'); //iso format
    
  //creating carousel-inner items
  for($i = 0; $i<$number_of_weeks; $i++){
       
    if($current_week < 10){
      $week_number = "0".$current_week;
    }else{
      $week_number = $current_week;
    }
    $year_number = $current_year;
    
    //item heading
    if($i == 0){
      $output .= "<div class='item active'>";
    }else{
      $output .= "<div class='item'>"; 
    }
    //item content
    $output .= "<div class='horizontal-calendar-big-content'><table class='table'>";  
    //prepareDayNamesHeading i.e. Sunday, Monday, Tuesday etc; OR Monday, Tuesday, Wednesday etc. 
    //this method return table row
    $output .= $this->prepareDayNamesHeadings($first_day,$week_number,$year_number);
    //prepareDayNumbersHeading i.e. 12 July, 13 July, 14 July
    //this method return table row
    $output .= $this->prepareDayNumbersHeadings($first_day,$week_number,$year_number);
    
    //prepareDayContent i.e. 12.00, 13.00. 14.00 etc.
    //this method return table row
    $output .= $this->prepareDayContent($results,$first_day,$week_number,$year_number,$booking_url ,$max_display,$calendar_id);
    //horizontal-calendar-big-content and table ending
    $output .= "</table></div><!--end of horizontal-calendar-bit-content-->";
    
    //item background 
    $output .= "<div class='horizontal-calendar-big-background'></div>
                <div class='horizontal-calendar-big-background'></div>
                <div class='horizontal-calendar-big-background'></div>";
    
    //item ending
    $output .= "</div><!--end of item-->";
    $current_week++;
    $weeks_in_current_year = $this->getMonthsCount($current_year);
    if($current_week > $weeks_in_current_year && $weeks_in_current_year==52){
      ++$current_year;
      $current_week = 1;
    }else if($current_week>$weeks_in_current_year&& $weeks_in_current_year==53){
      ++$current_year;
      $current_week = 1;
    } 
  }        
   
  $output .= "</div><!--end of carousel-inner-->";
  $output .= "<a class='left horizontal-calendar-big-left carousel-control'  id='left_$calendar_id' href='#horizontal-calendar-big-wrapper-$calendar_id' role='button' data-slide='prev'>
              <span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>
              <span class='sr-only'>Previous</span>
            </a>
            <a class='right horizontal-calendar-big-right carousel-control' id='right_$calendar_id' href='#horizontal-calendar-big-wrapper-$calendar_id' role='button' data-slide='next'>
              <span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>
              <span class='sr-only'>Next</span>
            </a>";

  return $output;
}
 
 public function prepareSmallOutput($day_results=array(),$calendar_id, $booking_url="", $max_in_row=4,$calendar_details=array(), $arrow_prev=true,$arrow_next=true){
   // calendar_id 	company_name 	address 	postcode 	city 	country 	website 
   $company_name = (isset($calendar_details[0]['company_name']))?  $calendar_details[0]['company_name']:"Company Name";
   $company_address = (isset($calendar_details[0]['address']))?  $calendar_details[0]['address']:"Street Name";
   $company_postcode = (isset($calendar_details[0]['postcode']))?  $calendar_details[0]['postcode']:"Postcode";
   $company_city = (isset($calendar_details[0]['city']))?  $calendar_details[0]['city']:"City";
   $company_country = (isset($calendar_details[0]['country']))?  $calendar_details[0]['country']:"Country";
   $company_website = (isset($calendar_details[0]['website']))?  $calendar_details[0]['website']:"www.example.com";
   
   $output = "<div class='panel panel-default'>";
   $output .= $this->preparePanelHeading($arrow_prev, $arrow_next,$calendar_id);
   $output .= "<div class='panel-body'>
                <div class='horizontal-calendar-small-location' id='horizontal-calendar-small-location-$calendar_id'>
                  <p><strong> $company_name</strong></p> 
                  <p><span class='glyphicon glyphicon-map-marker'></span> Location </p>
                  <p> $company_address, $company_postcode, $company_city </p>
                  <p> $company_country </p>  
                  <p> $company_website </p>  
                </div>
                <table class='table table-responsive horizontal-calendar-small-hours' id='horizontal-calendar-small-hours-$calendar_id'>";
  if(count($day_results)>0){
    $output .= "<tr>";
    $counter = 0;
      for($i=0; $i < count($day_results);$i++,$counter++){
         if($i % ($max_in_row) == 0){
           $output .= "</tr><tr>";
           $counter = 0;
        }
        if($day_results[$i]['deleted']==0){
          if($day_results[$i]['booked']){
            $output .= " <td style='width:25%'><span class='horizontal-calendar-small-booked'>".date('H:i',strtotime($day_results[$i]['timestamp']))."</span></td>";
          }else{
            $output .= " <td style='width:25%'><a href='".$booking_url."?calendar_id=".$calendar_id."&timestamp=".strtotime($day_results[$i]['timestamp'])."' class='btn btn-primary btn-xs'>".date('H:i',strtotime($day_results[$i]['timestamp']))."</a></td>";
          }
        }
        if($i == (count($day_results)-1)){
          $diff = ($max_in_row-1) - $counter;
          for($j=0; $j<$diff;$j++){
            $output .= "<td style='width:25%'></td>";
          }
        }

      }  
    $output .= "</tr>";
  }else{
    $output .= "<tr><td><p class='alert alert-warning'>You don't have any visits available in this calendar</p></td></tr>";
  }
  $output .= "</table><div><!--end of panel-body--></div><!--end of panel-->";               
   return $output;
 }

 private function preparePanelHeading($arrow_prev = true, $arrow_next = true, $calendar_id){
   $timestamp = (isset($_SESSION['timestamp_'.$calendar_id]))? (int)$_SESSION['timestamp_'.$calendar_id] : time();
   $output = "<div class='panel-heading'>
                  <table class='table'>  
                  <tr class='text-center'>";
   if($arrow_prev){
     $output .= "<td ><a href='#'class='horizontal-calendar-small-left btn btn-primary btn-lg' data-calendar-id='$calendar_id' id='horizontal-calendar-small-left-$calendar_id'><span class='glyphicon glyphicon-chevron-left'></span> </a></td>";
   }else{
     $output .= "<td></td>";
   }
   // horizontal-calendar-small-center - day details
   $output .= " <td class='horizontal-calendar-small-center' id='horizontal-calendar-small-center-$calendar_id'><strong>".date('l',$timestamp)."</strong>, ".date("d F",$timestamp)."</td>";
   
   if($arrow_next){
     $output .= "<td ><a href='#' class='horizontal-calendar-small-right btn btn-primary btn-lg' data-calendar-id='$calendar_id' id='horizontal-calendar-small-right-$calendar_id' > <span class='glyphicon glyphicon-chevron-right'></span></a></td>";
   }else{
     $output .= "<td></td>";
   }
   $output .= " </tr></table>
              </div><!--end of panel-heading-->";
   return $output;        
 }

 private function prepareDayNamesHeadings($first_day = 0, $week_number, $year_number){
   if($first_day == 0){
    $day = 0; //first day is sunday
  }else{
    $day = 1; //first day is monday
  }
  $output = "<tr class='horizontal-calendar-big-day-names'>";  
  for($i=$day; $i<(7+$day); $i++){
    $timestamp = strtotime($year_number."W".$week_number.$i."12:00:00");
    $output .= "<td>".date("l",$timestamp)."</td>";
  }
  $output .= "</tr>";
  return $output;
 }
 private function prepareDayNumbersHeadings($first_day = 0,$week_number,$year_number){
  if($first_day == 0){
    $day = 0; //first day is sunday
  }else{
    $day = 1; //first day is monday
  }
  $output = "<tr class='horizontal-calendar-day-numbers'>";  
  for($i=$day; $i<(7+$day); $i++){
    $timestamp = strtotime($year_number."W".$week_number.$i);
    $output .= "<td>". date("d F",$timestamp) ."</td>";
  }
  $output .= "</tr>"; 
  return $output;
 }
 
 
 private function prepareDayContent($results,$first_day,$week_number,$year_number,$booking_url ,$max_display,$calendar_id){
   if($first_day == 0){
    $day = 0; //first day is sunday
  }else{
    $day = 1; //first day is monday
  }
  $output = "<tr class='horizontal-calendary-day-hours'>";  
  for($i=$day; $i<(7+$day); $i++){
    $output .="<td>";
    $output .= "<ul class='list-unstyled'>";
    $timestamp = strtotime($year_number."W".$week_number.$i."12:00:00");
    $date_to_compare = date("Y-m-d",$timestamp);
    //looping through day results
    $day_visits = array();
    $counter = 0;
    for($j=0; $j<count($results);$j++){
      //checking if there are any visits in this day
       $timestamp_to_compare = strtotime($results[$j]['timestamp']);
      if(date("Y-m-d",$timestamp_to_compare) == $date_to_compare){
        $day_visits[$counter] = $results[$j];
        $counter++;
      }
    }  
    for($l=0; $l<count($day_visits);$l++){
        //checking if record is not marked as deleted
     $visit_timestamp = strtotime($day_visits[$l]['timestamp']);
    
        if($day_visits[$l]['deleted'] !=1 ){
          //checking if calendar call to action is modal or link redirection
          if($l < $max_display){
              if($day_visits[$l]['booked']==1 || $visit_timestamp < time()){
              //if the visit is booked
                $output .= "<li class='horizontal-calendar-big-list-item'><span class='booked-visit'>".date("H:i",$visit_timestamp)."</span></li>";
              }else{
                $output .= "<li class='horizontal-calendar-big-list-item'><a rel='nofollow' class='horizontal-calendar-big-link' href='".$booking_url."?calendar_id=".$calendar_id."&timestamp=".$visit_timestamp."'>".date("H:i",$visit_timestamp)."</a></li>";
              }
          }else if($l == $max_display){
            $output .= "<li><a rel='nofollow' class='horizontal-calendar-big-link dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>more</a>
              <ul class='dropdown-menu'>";
              if($day_visits[$l]['booked']==1 || $visit_timestamp  < time()){
              //if the visit is booked
                $output .= "<li rel='nofollow' class='horizontal-calendar-big-booked'><span class='booked-visit'>".date('H:i',$visit_timestamp)."</span></li>";
              }else{
                $output .= " <li><a rel='nofollow'  href='".$booking_url."?calendar_id=".$calendar_id."&timestamp=".$visit_timestamp."'>".date("H:i",$visit_timestamp)."</a></li>";
              }
            
            if($l == count($day_visits)){
              $output .= "</ul><!--end of dropdown--></li>";
            }
          }else if($l > $max_display){
            //booking method == link
              if($day_visits[$l]['booked']==1 || $visit_timestamp < time()){
              //if the visit is booked
                 $output .= "<li rel='nofollow' class='horizontal-calendar-big-booked'><span class='booked-visit'>".date('H:i',$visit_timestamp)."</span></li>";
              }else{
                 $output .= " <li><a rel='nofollow'  href='".$booking_url."?calendar_id=".$calendar_id."&timestamp=".$visit_timestamp."'>".date("H:i",$visit_timestamp)."</a></li>";
              }
            }
            if($l == count($day_visits)){
              $output .= "</ul><!--end of dropdown--></li>";
            }
          
        }//end of is deleted
    }//end of foreach loop  
    $output .= "</ul>";
     $output .="</td>";
  }//end of for i loop 
  $output .= "</tr>"; 
  return $output;
 }
}
