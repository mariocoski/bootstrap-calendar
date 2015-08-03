<?php
/**
 * Description of Helper
 * This class is used for database connection
 * 
 * @author Mariocoski
 * @email mariuszrajczakowski@gmail.com 
 * @github https://github.com/mariocoski/Bootstrap-calendar
 * Copyright (c) 2015 Mariocoski
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
class Helper{
  public function __construct() {
    
  }
    
/**
* sanitize return sanitized strings
* $param String $string - string to sanitize
* @return String 
*/  
  public static function sanitize($string){
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
  }
  
/**
* getMonthsCount checks if certain year has 53 or 52 weeks
* @return Integer
*/ 
  private function getMonthsCount($year){
    $date = new DateTime();
    $date->setISODate($year, 53);
    return ($date->format("W") === "53" ? 53 : 52);
  }
  
/**
* prepareBigOutput creates desktop version of the calendar
* $param array   $results - contains events details received from db query
* $param int     $calendar_id - contains calendar identification number
* $param int     $first_day - 0 means sunday is a first day of the week, 1 means monday is a first day of the week 
* $param int     $number_of_weeks - how many weeks to display 
* $param string  $booking_url - url which will handle the event timestamp param and process the next booking step
* $param int     $max_display - how many visits are visible in day column
* @return string
*/   
public function prepareBigOutput($results=array(),$calendar_id,$first_day=0,$number_of_weeks=4, $booking_url="", $max_display){
  $output = "<div class='carousel-inner' id='carousel_inner_$calendar_id' role='listbox'>";
  //preparing datetime variables
  $current_week = date('W'); // i.e. 14
  $current_year = date('o'); //iso format
  //creating carousel-inner items
  //items number equals number_of_weeks
  for($i = 0; $i < $number_of_weeks; $i++){
    //if week number is lower than 10 add extra zero e.g. 5 -> 05
    if($current_week < 10){
      $week_number = "0".$current_week;
    }else{
      $week_number = $current_week;
    }
    $year_number = $current_year;
    //item heading
    if($i == 0){
      //set the first item as an active
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
    //check if the week number is greater than max year week number if yes increment the year and set week number to 1
    if($current_week > $weeks_in_current_year && $weeks_in_current_year==52){ 
      ++$current_year;
      $current_week = 1;
    }else if($current_week>$weeks_in_current_year&& $weeks_in_current_year==53){
      ++$current_year;
      $current_week = 1;
    } 
  }        
  $output .= "</div><!--end of carousel-inner-->";
  //creating carousel controls
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

/**
* prepareSmallOutput creates mobile version of the calendar
* $param array   $day_results - contains events details received from db query
* $param int     $calendar_id - contains calendar identification number
* $param string  $booking_url - url which will handle the event timestamp param and process the next booking step
* $param int     $max_in_row - the number of events in day row
* $param array   $calendar_details - array which contains calendar company details 
* $param boolean $arrow_prev - if true shows the arrow
* $param boolean $arrow_next - if true shows the arrow 
* @return string
*/   
public function prepareSmallOutput($day_results=array(),$calendar_id, $booking_url="", $max_in_row=4,$calendar_details=array(), $arrow_prev=true,$arrow_next=true){
  //calendar company details
  $company_name = (isset($calendar_details[0]['company_name']))?  $calendar_details[0]['company_name']:"Company Name";
  $company_address = (isset($calendar_details[0]['address']))?  $calendar_details[0]['address']:"Street Name";
  $company_postcode = (isset($calendar_details[0]['postcode']))?  $calendar_details[0]['postcode']:"Postcode";
  $company_city = (isset($calendar_details[0]['city']))?  $calendar_details[0]['city']:"City";
  $company_country = (isset($calendar_details[0]['country']))?  $calendar_details[0]['country']:"Country";
  $company_website = (isset($calendar_details[0]['website']))?  $calendar_details[0]['website']:"www.example.com";
  
  //preparing the output
  $output = "<div class='panel panel-default'>";
  //preparing panel heading
  $output .= $this->preparePanelHeading($arrow_prev, $arrow_next,$calendar_id);
  //preparing panel body
  $output .= "<div class='panel-body'>
              <div class='horizontal-calendar-small-location' id='horizontal-calendar-small-location-$calendar_id'>
                <p><strong> $company_name</strong></p> 
                <p><span class='glyphicon glyphicon-map-marker'></span> Location </p>
                <p> $company_address, $company_postcode, $company_city </p>
                <p> $company_country </p>  
                <p> $company_website </p>  
              </div>
              <table class='table table-responsive horizontal-calendar-small-hours' id='horizontal-calendar-small-hours-$calendar_id'>";
  //display events
  if(count($day_results)>0){
    $output .= "<tr>";
    $counter = 0;
      for($i=0; $i < count($day_results);$i++,$counter++){
         if($i % ($max_in_row) == 0){
           $output .= "</tr><tr>";
           $counter = 0;
        }
        //check whether event was marked as deleted
        if($day_results[$i]['deleted']==0){
          //check wheter event was marked as booked (if yes do not display it)
          if($day_results[$i]['booked']){
            $output .= " <td style='width:25%'><span class='horizontal-calendar-small-booked'>".date('H:i',strtotime($day_results[$i]['timestamp']))."</span></td>";
          }else{
            $output .= " <td style='width:25%'><a href='".$booking_url."?calendar_id=".$calendar_id."&timestamp=".strtotime($day_results[$i]['timestamp'])."' class='btn btn-primary btn-xs'>".date('H:i',strtotime($day_results[$i]['timestamp']))."</a></td>";
          }
        }
        //check how many events could be in day row
        if($i == (count($day_results)-1)){
          $diff = ($max_in_row-1) - $counter;
          for($j=0; $j<$diff;$j++){
            $output .= "<td style='width:25%'></td>";
          }
        }
      }  
    $output .= "</tr>";
  }else{
    //if there are no visits available display warning
    $output .= "<tr><td><p class='alert alert-warning'>You don't have any visits available in this calendar</p></td></tr>";
  }
  $output .= "</table><div><!--end of panel-body--></div><!--end of panel-->";               
  return $output;
}
  
/**
* preparePanelHeading creates heading for mobile version of the calendar
* $param boolean $arrow_prev - if true shows the arrow
* $param boolean $arrow_next - if true shows the arrow 
* $param int     $calendar_id - contains calendar id
* @return string
*/     
 private function preparePanelHeading($arrow_prev = true, $arrow_next = true, $calendar_id){
   $timestamp = (isset($_SESSION['timestamp_'.$calendar_id]))? (int)$_SESSION['timestamp_'.$calendar_id] : time();
   $output = "<div class='panel-heading'>
                <table class='table'>  
                  <tr class='text-center'>";
   //if arrow_prev == true display it
   if($arrow_prev){
     $output .= "<td ><a href='#'class='horizontal-calendar-small-left btn btn-primary btn-lg' data-calendar-id='$calendar_id' id='horizontal-calendar-small-left-$calendar_id'><span class='glyphicon glyphicon-chevron-left'></span> </a></td>";
   }else{
   //do not display prev arrow 
     $output .= "<td></td>";
   }
   // horizontal-calendar-small-center - day details
   $output .= " <td class='horizontal-calendar-small-center' id='horizontal-calendar-small-center-$calendar_id'><strong>".date('l',$timestamp)."</strong>, ".date("d F",$timestamp)."</td>";
   //if arrow_next == true display it
   if($arrow_next){
     $output .= "<td ><a href='#' class='horizontal-calendar-small-right btn btn-primary btn-lg' data-calendar-id='$calendar_id' id='horizontal-calendar-small-right-$calendar_id' > <span class='glyphicon glyphicon-chevron-right'></span></a></td>";
   }else{
   //do not display next arrow  
     $output .= "<td></td>";
   }
   $output .= " </tr></table>
              </div><!--end of panel-heading-->";
   return $output;        
 }
 
/**
* prepareDayNamesHeading creates heading for desktop version of the calendar i.e. Sunday, Monday, Tuesday etc; OR Monday, Tuesday, Wednesday etc. 
* $param int     $first_day - 0 means sunday is a first day of the week, 1 means monday is a first day of the week 
* $param int     $week_number - contains week number 
* $param int     $year_number - contains year_number
* @return string
*/ 
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
 /**
* prepareDayNumberHeadings creates day dates i.e. 12 July, 13 July, 14 July
* $param int     $first_day - 0 means sunday is a first day of the week, 1 means monday is a first day of the week 
* $param int     $week_number - contains week number 
* $param int     $year_number - contains year_number
* @return string
*/
 
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
 
/**
* prepareDayContent creates desktop version of the calendar
* $param array   $results - contains events details received from db query
* $param int     $first_day - 0 means sunday is a first day of the week, 1 means monday is a first day of the week 
* $param int     $week_number - contains week number 
* $param int     $year_number - contains year_number
* $param string  $booking_url - url which will handle the event timestamp param and process the next booking step
* $param int     $max_display - how many visits are visible in day column
* $param int     $calendar_id - contains calendar id
* @return string
*/ 
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
          }else if($l == $max_display && $visit_timestamp > time()){
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
          }else if($l > $max_display && $visit_timestamp > time()){
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
/**
* prepareDayContent creates desktop version of the calendar
* $param array   $results - contains events details received from db query
* $param int     $first_day - 0 means sunday is a first day of the week, 1 means monday is a first day of the week 
* $param int     $week_number - contains week number 
* $param int     $year_number - contains year_number
* $param string  $booking_url - url which will handle the event timestamp param and process the next booking step
* $param int     $max_display - how many visits are visible in day column
* $param int     $calendar_id - contains calendar id
* @return array
*/ 
public static function getCompanyDetails($calendar_id){
  if(isset($calendar_id) && (int)$calendar_id > 0){
    try{
      $db = new DB();
      $query_calendar = "SELECT * FROM `mariocoski_calendar` WHERE calendar_id=:calendar_id";
      $run_calendar = $db->prepare($query_calendar);
      $run_calendar->execute(array(":calendar_id"=>$calendar_id));
      $calendar_details = $run_calendar->fetchAll(PDO::FETCH_ASSOC); 
      return $calendar_details;
    }catch(PDOException $e){
         
    }catch(Exception $e){
       
    }
    return array();
  }  
}

}//end of helper class  
  
