<?php
/*
 *
 * 
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
 
public function prepareBigOutput($results=array(),$calendar_id,$first_day=0,$method="link",$number_of_weeks=4, $booking_method="", $booking_url=""){

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
    $output .= $this->prepareDayContent($results,$first_day,$week_number,$year_number,$booking_method,$booking_url);
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
 
 public function prepareSmallOutput($results){
   
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
 
 private function prepareDayContent($results,$first_day,$week_number,$year_number,$booking_method, $booking_url){
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
    for($j=0; $j<count($results);$j++){
      $timestamp_to_compare = strtotime($results[$j]['timestamp']);
      if(date("Y-m-d",$timestamp_to_compare) == $date_to_compare){
        if($results[$j]['deleted'] !=1){
          if($j<7){
            if($results[$j]['booked']==1){
              //if the visit is booked
              $output .= "<li class='horizontal-calendar-big-list-item'><span class='booked-visit'>".date("H:i",$timestamp_to_compare)."</span></li>";
            }else{
              if($booking_method == "modal"){
                //button trigger
                $output .= "<li class='horizontal-calendar-big-list-item'><a rel='nofollow' class='horizontal-calendar-big-link '  data-toggle='modal' data-target='#modal_$timestamp_to_compare'>";
                $output .= date("H:i",$timestamp_to_compare)."</a></li>";
                //modal
                $output .= "<div class='modal fade' id='modal_$timestamp_to_compare' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                            <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                <h4 class='modal-title' id='myModalLabel'>Make an appointment</h4>
                              </div>
                              <div class='modal-body row'>
                                <div class='col-xs-4'>
                                 <h4>Appointment details</h4>
                                 <p><strong>Date: </strong>".date("d/m/Y",$timestamp_to_compare)."</p>
                                 <p><strong>Time:</strong> ".date("H:i",$timestamp_to_compare)."</p>
                                 <br />  
                                 <h4>Location 2</h4>  
                                 <h4>Address</h4>
                                 <p>Street Name</p>
                                 <p>Postcode Location</p>
                                 <p>Country</p>
                               </div>
                                <div class='col-xs-8'>
                                  <form class='modal-form' id='modal_form_$timestamp_to_compare'>
                                      <div class='form-group'>
                                        <div><label for='firstname_$timestamp_to_compare' class=' control-label'>Firstname:</label></div>
                                        <div><input type='text' class='form-control' id='firstname_$timestamp_to_compare' placeholder='John'></div>
                                      </div>
                                      <div class='form-group'>
                                        <div><label for='lastname_$timestamp_to_compare' class=' control-label'>Lastname:</label></div>
                                        <div><input type='text' class='form-control' id='lastname_$timestamp_to_compare' placeholder='Doe'></div>
                                      </div>
                                      <div class='form-group'>
                                        <div><label for='email_$timestamp_to_compare' class=' control-label'>E-mail address:</label></div>
                                        <div><input type='text' class='form-control' id='email_$timestamp_to_compare' placeholder='johndoe@gmail.com'></div>
                                      </div>
                                      <div class='form-group'>
                                        <div><label for='mobile_$timestamp_to_compare' class=' control-label'>Mobile:</label></div>
                                        <div><input type='text' class='form-control' id='mobile_$timestamp_to_compare' placeholder='44 1122334455'></div>
                                      </div>
                                  </form>
                                </div>
                              </div>  
                              <div class='modal-footer'>
                                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                <button type='button' class='btn btn-primary'>Book now!</button>
                              </div>
                            </div>
                          </div>
                        </div>";
              }else{
                $output .= "<li class='horizontal-calendar-big-list-item'><a rel='nofollow' class='horizontal-calendar-big-link' href='".$booking_url."?timestamp=".$timestamp_to_compare."'>".date("H:i",$timestamp_to_compare)."</a></li>";
              }
            }
          }else if($j==7){
            $output .= "<li><a rel='nofollow' class='horizontal-calendar-big-link dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' href=''>more</a>
              <ul class='dropdown-menu'>";
                if($results[$j]['booked'] == 1){
                  $output .= "<li rel='nofollow' class='horizontal-calendar-big-booked'><span class='booked-visit'>".date('H:i',$timestamp_to_compare)."</span></li>";
                }else{
                  $output .= " <li><a rel='nofollow' class='' href=''>".date("H:i",$timestamp_to_compare)."</a></li>";
                }
                /*<li rel='nofollow' class='horizontal-calendar-big-booked'><span class='booked-visit'>.date("H:i".$timestamp_to_compare).</span></li>
          
                <li><a rel='nofollow' class='' href=''>18:00</a></li>
                <li><a rel='nofollow' class='' href=''>18:00</a></li>
                <li rel='nofollow' class='horizontal-calendar-big-booked'><span class='booked-visit'>12.30</span></li>*/
           
          }else if($j>7){
            
          }else if($j==count($results)){
            $output.= "</ul></li>";
          }
        }   
      }
    }
    $output .= "</ul>";
     $output .="</td>";
  }
  $output .= "</tr>"; 
  return $output;
 }
 
}
  /*$result = $run->fetchAll(PDO::FETCH_ASSOC);
        $datas = array();
        foreach($result as $res){
            $datas[] = date("Y-m-d" ,strtotime($res['timestamp']));
        }
        echo json_encode(array("success"=>true,"content"=>$datas));
        exit;
        */
        /*
         * foreach($result as $res){
             $date_to_compare = Date("Y-m-d" ,$res['timestamp']);
         *   if($date_to_compare == ){
         *   
         *   }
         * }
         */
        /* check how many weeks */
   
        /*
        $output = "<div class='carousel-inner' id='carousel_inner_$calendar_id' role='listbox'>";
    
        //loop which create slides items
        $current_week = date('W'); // i.e. 14
        $current_year = date('o'); //iso format
        $month_name = date("F"); // month name i.e. January, February etc.
        
        for($i = 0; $i<$week_number; $i++, $current_week++){
         
          //1. item heading
          if($i == 0){
            $output .= "<div class='item active'>";
          }else{
            $output .= "<div class='item'>"; 
          }
          //2. item content
        
          
$output .= "<div class='horizontal-calendar-big-content'><table class='table'>";  
            
$output .="
    <tr class='horizontal-calendar-big-day-names'>  
      <td>Monday</td>    
      <td>Tuesday</td> 
      <td>Wednesday</td> 
      <td>Thursday</td> 
      <td>Friday</td> 
      <td>Saturday</td> 
      <td>Sunday</td> 
    </tr>  
    <tr class='horizontal-calendar-day-numbers'>  
      <td>06 November</td>    
      <td>07 November</td> 
      <td>08 November</td> 
      <td>09 November</td> 
      <td>10 November</td> 
      <td>11 November</td> 
      <td>12 November</td> 
    </tr>
    <tr class='horizontal-calendary-day-hours'>
      <td>
        <ul class='list-unstyled '>
          <li class='horizontal-calendar-big-list-item'><a rel='nofollow' class='horizontal-calendar-big-link' href='''>8:00</a></li>
          <li class='horizontal-calendar-big-list-item'><span class='booked-visit'>12.30</span></li>
          <li class='horizontal-calendar-big-list-item'><a rel='nofollow' class='horizontal-calendar-big-link' href='''>8:00</a></li>
          <li class='horizontal-calendar-big-list-item'><a rel='nofollow' class='horizontal-calendar-big-link' href='''>8:00</a></li>
          <li class='horizontal-calendar-big-list-item'><a rel='nofollow' class='horizontal-calendar-big-link' href='''>8:00</a></li>
          <li class='horizontal-calendar-big-list-item'><a rel='nofollow' class='horizontal-calendar-big-link' href='''>8:00</a></li>
          <li class='horizontal-calendar-big-list-item'><a rel='nofollow' class='horizontal-calendar-big-link' href='''>8:00</a></li>
          
       
        <li><a rel='nofollow' class='horizontal-calendar-big-link dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' href=''>more</a>
              <ul class='dropdown-menu'>
                <li rel='nofollow' class='horizontal-calendar-big-booked'><span class='booked-visit'>12.30</span></li>
                <li><a rel='nofollow' class='' href=''>18:00</a></li>
                <li><a rel='nofollow' class='' href=''>18:00</a></li>
                <li><a rel='nofollow' class='' href=''>18:00</a></li>
                <li><a rel='nofollow' class='' href=''>18:00</a></li>
                <li><a rel='nofollow' class='' href=''>18:00</a></li>
                <li><a rel='nofollow' class='' href=''>18:00</a></li>
                <li><a rel='nofollow' class='' href=''>18:00</a></li>
                <li rel='nofollow' class='horizontal-calendar-big-booked'><span class='booked-visit'>12.30</span></li>
             </ul>
          </li>
        </ul>
      </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
         <ul class='list-unstyled '>
          <li class='horizontal-calendar-big-list-item'><a rel='nofollow' class='horizontal-calendar-big-link' href='''>8:00</a></li>
          <li class='horizontal-calendar-big-list-item'><span class='booked-visit'>12.30</span></li>
          <li class='horizontal-calendar-big-list-item'><a rel='nofollow' class='horizontal-calendar-big-link' href='''>8:00</a></li>
          <li class='horizontal-calendar-big-list-item'><a rel='nofollow' class='horizontal-calendar-big-link' href='''>8:00</a></li>
          <li class='horizontal-calendar-big-list-item'><a rel='nofollow' class='horizontal-calendar-big-link' href='''>8:00</a></li>
          <li class='horizontal-calendar-big-list-item'><a rel='nofollow' class='horizontal-calendar-big-link' href='''>8:00</a></li>
          <li class='horizontal-calendar-big-list-item'><a rel='nofollow' class='horizontal-calendar-big-link' href='''>8:00</a></li>
          
       
        <li><a rel='nofollow' class='horizontal-calendar-big-link dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' href=''>more</a>
              <ul class='dropdown-menu'>
                <li rel='nofollow' class='horizontal-calendar-big-booked'><span class='booked-visit'>12.30</span></li>
                <li><a rel='nofollow' class='' href=''>18:00</a></li>
                <li><a rel='nofollow' class='' href=''>18:00</a></li>
                <li><a rel='nofollow' class='' href=''>18:00</a></li>
                <li><a rel='nofollow' class='' href=''>18:00</a></li>
                <li><a rel='nofollow' class='' href=''>18:00</a></li>
                <li><a rel='nofollow' class='' href=''>18:00</a></li>
                <li><a rel='nofollow' class='' href=''>18:00</a></li>
                <li rel='nofollow' class='horizontal-calendar-big-booked'><span class='booked-visit'>12.30</span></li>
             </ul>
          </li>
        </ul>
      </td>
       
    </tr>
  </table>
</div><!--bootstrap-calendar-->";
          
          
          
          
          
          //3. item background + ending
          $output .= "<div class='horizontal-calendar-big-background'></div>
                      <div class='horizontal-calendar-big-background'></div>
                      <div class='horizontal-calendar-big-background'></div>
                      </div><!--end of item-->
                    ";
            
        } //end o loop
        //left and right arrow
        $output .= "</div><!--end of carousel-inner-->
            <a class='left horizontal-calendar-big-left carousel-control'  id='left_$calendar_id' href='#horizontal-calendar-big-wrapper-$calendar_id' role='button' data-slide='prev'>
              <span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>
              <span class='sr-only'>Previous</span>
            </a>
            <a class='right horizontal-calendar-big-right carousel-control' id='right_$calendar_id' href='#horizontal-calendar-big-wrapper-$calendar_id' role='button' data-slide='next'>
              <span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>
              <span class='sr-only'>Next</span>
            </a>";
       
               $output .="</div><!--end of horizontal-calendar-big-->" ;
        
        //end of wrapper
 
 
  
}*/