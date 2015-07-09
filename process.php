<?php
require 'config/init.php';
  
header('Access-Control-Allow-Origin: http://localhost/calendar/');
header('Access-Control-Allow-Methods: POST');
 
if(isset($_POST)){
 
  if(isset($_POST['calendar_type']) && !empty($_POST['calendar_type']) && isset($_POST['id']) && is_numeric($_POST['id'])&& isset($_POST['weeks_number']) && is_numeric($_POST['weeks_number'])){
    if($_POST['calendar_type']=='big'){
      $calendar_id = Helper::sanitize($_POST['id']);
      $week_number = (int)($_POST['weeks_number']);
     
      if($week_number ==0){
        echo json_encode(array("success"=>false,"content"=>array()));
        exit;
      }
      
      
      
      try{
        $db = new DB();
        $query = "SELECT mariocoski_event.*
        FROM mariocoski_event
        INNER JOIN mariocoski_user_calendar
        ON mariocoski_event.calendar_id = mariocoski_user_calendar.calendar_id
        INNER JOIN mariocoski_calendar
        ON mariocoski_calendar.calendar_id = mariocoski_user_calendar.calendar_id
        WHERE mariocoski_calendar.calendar_id=:id";
       // $run = $db->prepare($query);
       // $run->execute(array(":id"=>$calendar_id));
       // $result = $run->fetchAll(PDO::FETCH_OBJ);
       // echo json_encode(array("success"=>true,"content"=>$result));
       // exit;
        /* check how many weeks */
   
        
        $output = "<div class='carousel-inner' id='carousel_inner_$calendar_id' role='listbox'>";
        //loop which create slides items
        for($i = 0; $i<$week_number; $i++){
         
          //1. item heading
          if($i == 0){
            $output .= "<div class='item active'>";
          }else{
            $output .= "<div class='item'>"; 
          }
          //2. item content
$output .= <<<EOT
  <div class="horizontal-calendar-big-content">  
  <table class="table">
    <tr class="horizontal-calendar-big-day-names">  
      <td>Monday</td>    
      <td>Tuesday</td> 
      <td>Wednesday</td> 
      <td>Thursday</td> 
      <td>Friday</td> 
      <td>Saturday</td> 
      <td>Sunday</td> 
    </tr>  
    <tr class="horizontal-calendar-day-numbers">  
      <td>06 November</td>    
      <td>07 November</td> 
      <td>08 November</td> 
      <td>09 November</td> 
      <td>10 November</td> 
      <td>11 November</td> 
      <td>12 November</td> 
    </tr>
    <tr class="horizontal-calendary-day-hours">
      <td>
        <ul class="list-unstyled ">
          <li class="horizontal-calendar-big-list-item"><a rel="nofollow" class="horizontal-calendar-big-link" href="">8:00</a></li>
          <li class="horizontal-calendar-big-list-item"><a rel="nofollow" class="horizontal-calendar-big-link" href="">9:00</a></li>
          <li class="horizontal-calendar-big-list-item"><a rel="nofollow" class="horizontal-calendar-big-link" href="">10:00</a></li>
          <li class="horizontal-calendar-big-list-item"><a rel="nofollow" class="horizontal-calendar-big-link" href="">11:00</a></li>
          <li class="horizontal-calendar-big-list-item"><a rel="nofollow" class="horizontal-calendar-big-link" href="">12:00</a></li>
          <li class="horizontal-calendar-big-list-item"><a rel="nofollow" class="horizontal-calendar-big-link" href="">13:00</a></li>
          <li class="horizontal-calendar-big-list-item"><a rel="nofollow" class="horizontal-calendar-big-link" href="">14:00</a></li>
          <li><a rel="nofollow" class="horizontal-calendar-big-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="">more</a>
              <ul class="dropdown-menu ">
                <li rel="nofollow" class="horizontal-calendar-big-booked"><span class="booked-visit">12.30</span></li>
                <li><a rel="nofollow" class="" href="">18:00</a></li>
                <li><a rel="nofollow" class="" href="">8:00</a></li>
                <li><a rel="nofollow" class="" href="">8:00</a></li>
                <li ><a rel="nofollow" class="" href="">18:00</a></li>
                <li rel="nofollow" class="horizontal-calendar-big-booked"><span class="booked-visit">12.30</span></li>
                <li ><a rel="nofollow" class="" href="">8:00</a></li>
                <li ><a rel="nofollow" class="" href="">8:00</a></li>
                <li ><a rel="nofollow" class="" href="">18:00</a></li>
                <li rel="nofollow" class="horizontal-calendar-big-booked"><span class="booked-visit">12.30</span></li>
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
          <ul class="list-unstyled ">
          <li class="horizontal-calendar-big-list-item"><a rel="nofollow" class="horizontal-calendar-big-link" href="">8:00</a></li>
          <li class="horizontal-calendar-big-list-item"><a rel="nofollow" class="horizontal-calendar-big-link" href="">9:00</a></li>
          <li class="horizontal-calendar-big-list-item"><a rel="nofollow" class="horizontal-calendar-big-link" href="">10:00</a></li>
          <li class="horizontal-calendar-big-list-item"><a rel="nofollow" class="horizontal-calendar-big-link" href="">11:00</a></li>
          <li class="horizontal-calendar-big-list-item"><a rel="nofollow" class="horizontal-calendar-big-link" href="">12:00</a></li>
          <li class="horizontal-calendar-big-list-item"><a rel="nofollow" class="horizontal-calendar-big-link" href="">13:00</a></li>
          <li class="horizontal-calendar-big-list-item"><a rel="nofollow" class="horizontal-calendar-big-link" href="">14:00</a></li>
          <li><a rel="nofollow" class="horizontal-calendar-big-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="">more</a>
              <ul class="dropdown-menu ">
                <li rel="nofollow" class="horizontal-calendar-big-booked"><span class="booked-visit">12.30</span></li>
                <li><a rel="nofollow" class="" href="">18:00</a></li>
                <li><a rel="nofollow" class="" href="">8:00</a></li>
                <li><a rel="nofollow" class="" href="">8:00</a></li>
                <li ><a rel="nofollow" class="" href="">18:00</a></li>
                <li rel="nofollow" class="horizontal-calendar-big-booked"><span class="booked-visit">12.30</span></li>
                <li ><a rel="nofollow" class="" href="">8:00</a></li>
                <li ><a rel="nofollow" class="" href="">8:00</a></li>
                <li ><a rel="nofollow" class="" href="">18:00</a></li>
                <li rel="nofollow" class="horizontal-calendar-big-booked"><span class="booked-visit">12.30</span></li>
              </ul>
          </li>
        </ul>      
      </td>
       
    </tr>
  </table>
</div><!--bootstrap-calendar-->

        
EOT;
  
          
          
          
          
          
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
 
        
         echo json_encode(array("success"=>true,"content"=>$output));
        
        exit;
      }catch(PDOException $e){
        echo json_encode(array("success"=>false,"content"=>array()));
        exit;
      }catch(Exception $e){
        echo json_encode(array("success"=>false,"content"=>array()));
        exit;
      }
    }else if($_POST['type']=='small'){
      
    }else{
      echo json_encode(array("success"=>false,"content"=>array()));
      exit;
    }
  }
}
/**
* getMonthsCount checks if certain yeat has 53 or 52 weeks
* @return Integer
*/ 
function getMonthsCount($year){
    $date = new DateTime();
    $date->setISODate($year, 53);
    return ($date->format("W") === "53" ? 53 : 52);
  }


?>
