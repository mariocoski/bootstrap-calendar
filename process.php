<?php
 /**
 * @author Mariocoski
 * @email mariuszrajczakowski@gmail.com 
 * @github https://github.com/mariocoski/Bootstrap-calendar
 * Copyright (c) 2015 Mariocoski
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
require 'config/init.php';
header('Access-Control-Allow-Origin: '.HOST_URL);
header('Access-Control-Allow-Methods: POST');
if(isset($_POST)){
  if(isset($_POST['calendar_type']) && !empty($_POST['calendar_type']) && isset($_POST['id']) && is_numeric($_POST['id'])&& isset($_POST['number_of_weeks']) && is_numeric($_POST['number_of_weeks'])){
    if($_POST['calendar_type']=='big'){
     //HORIZONTAL BIG CALENDAR
      $calendar_id = (int)($_POST['id']); //sanitize numeric value
      $number_of_weeks = (int)($_POST['number_of_weeks']);//sanitize numeric value
      if($number_of_weeks == 0 || $calendar_id == 0){
        echo json_encode(array("success"=>false,"content"=>array()));
        exit;
      }
      $booking_url = isset($_POST['booking_url'])? Helper::sanitize($_POST['booking_url']):"";
      $max_display = (isset($_POST['max_display']))? (int)($_POST['max_display']) : 7;
     //set first day
      if(isset($_POST['first_day']) && strtolower($_POST['first_day'])=='sunday'){
        $first_day = 0;
      }else{
        $first_day = 1;
      }
      try{
        $db = new DB();
        $query = "SELECT mariocoski_event.*
        FROM mariocoski_event
        INNER JOIN mariocoski_user_calendar
        ON mariocoski_event.calendar_id = mariocoski_user_calendar.calendar_id
        INNER JOIN mariocoski_calendar
        ON mariocoski_calendar.calendar_id = mariocoski_user_calendar.calendar_id
        WHERE mariocoski_calendar.calendar_id=:id ORDER BY timestamp ASC";
        $run = $db->prepare($query);
        $run->execute(array(":id"=>$calendar_id));
        $results = $run->fetchAll(PDO::FETCH_ASSOC);
        $helper = new Helper();
        
        $output = $helper->prepareBigOutput($results,$calendar_id,$first_day,$number_of_weeks, $booking_url ,$max_display);
        echo json_encode(array("success"=>true,"content"=>$output));
        exit;
      }catch(PDOException $e){
        echo json_encode(array("success"=>false,"content"=>array()));
        exit;
      }catch(Exception $e){
        echo json_encode(array("success"=>false,"content"=>array()));
        exit;
      }
    }else if($_POST['calendar_type']=='small'){
      //HORIZONTAL SMALL CALENDAR
      $calendar_id = (int)($_POST['id']); //sanitize numeric value
      $number_of_weeks = (int)($_POST['number_of_weeks']);//sanitize numeric value
      $in_advance = (isset($_POST['in_advance']))? (int)($_POST['in_advance']) : 86400;
        
      if($number_of_weeks == 0 || $calendar_id == 0){
        echo json_encode(array("success"=>false,"content"=>array()));
        exit;
      }
        $booking_url = isset($_POST['booking_url'])? Helper::sanitize($_POST['booking_url']):"";
        $max_in_row = (isset($_POST['max_in_row']))? (int)($_POST['max_in_row']) : 4;
      
      try{
            $db = new DB();
            $query_calendar = "SELECT * FROM `mariocoski_calendar` WHERE calendar_id=:calendar_id";
            $run_calendar = $db->prepare($query_calendar);
            $run_calendar->execute(array(":calendar_id"=>$calendar_id));
            $calendar_details = $run_calendar->fetchAll(PDO::FETCH_ASSOC);
       }catch(PDOException $e){
            echo json_encode(array("success"=>false,"content"=>array()));
            exit;
          }catch(Exception $e){
            echo json_encode(array("success"=>false,"content"=>array()));
            exit;
      } 
       
      if(isset($_POST['show']) && $_POST['show'] == "prev"){
      
      /* PREV BUTTON */  
        //current day d-m-Y 00:00:00 timestamp
        $start_timestamp = (isset($_SESSION['timestamp_'.$calendar_id]))? (int)($_SESSION['timestamp_'.$calendar_id]):(time()+86400);
        //how many seconds in advance show the visits
        $weeks_forward = (int)($number_of_weeks * 7 * 24 * 60 * 60);
        $max = time() + $weeks_forward;
        try{
          $query = "SELECT * FROM mariocoski_event
                    WHERE calendar_id=:id AND timestamp<:min AND timestamp>NOW() ORDER BY timestamp ASC";
                      $run = $db->prepare($query);
                      $run->execute(array(":id"=>$calendar_id,":min"=>(date("Y-m-d H:i:s",(int)($start_timestamp)))));
                      $results = $run->fetchAll(PDO::FETCH_ASSOC);

          }catch(PDOException $e){
            echo json_encode(array("success"=>false,"content"=>array()));
            exit;
          }catch(Exception $e){
            echo json_encode(array("success"=>false,"content"=>array()));
            exit;
          }
       
        if(count($results) > 0){
          $first_result = date("d-m-Y",strtotime($results[count($results)-1]['timestamp']));
          $start = strtotime($first_result);
          $_SESSION['timestamp_'.$calendar_id] = $start;
          $day_results = array();
          $counter = 0;
          $arrow_prev = false;
          $arrow_next = true;
          for($i=0; $i < count($results);$i++){
            $current_date = date("d-m-Y",strtotime($results[$i]['timestamp']));
            if($first_result == $current_date){
              $day_results[$counter] = $results[$i];
              $counter++;
            }else if($current_date < date("d-m-Y",($start))){
               $arrow_prev = true;
            }            
          }
          $helper = new Helper();
          $output = $helper->prepareSmallOutput($day_results,$calendar_id, $booking_url, $max_in_row,$calendar_details,$arrow_prev,$arrow_next);
          echo json_encode(array("success"=>true,"content"=>$output));
          exit; 
        }
      }else if(isset($_POST['show']) && $_POST['show'] == "next"){
      /* NEXT BUTTON */  
        
        //current day d-m-Y 00:00:00 timestamp
        $start_timestamp = (isset($_SESSION['timestamp_'.$calendar_id]))? (int)($_SESSION['timestamp_'.$calendar_id]):(time()+86400);
        //how many seconds in advance show the visits
        $weeks_forward = (int)($number_of_weeks * 7 * 24 * 60 * 60);
        $max = time() + $weeks_forward;
        
        try{
          $query = "SELECT * FROM mariocoski_event
                    WHERE calendar_id=:id AND timestamp>:min AND timestamp<:max ORDER BY timestamp ASC";
                      $run = $db->prepare($query);
                      $run->execute(array(":id"=>$calendar_id,":min"=>(date("Y-m-d H:i:s",(int)($start_timestamp+86400))),":max"=>(date("Y-m-d H:i:s",$max))));
                      $results = $run->fetchAll(PDO::FETCH_ASSOC);

          }catch(PDOException $e){
            echo json_encode(array("success"=>false,"content"=>array()));
            exit;
          }catch(Exception $e){
            echo json_encode(array("success"=>false,"content"=>array()));
            exit;
          }
          
        if(count($results) > 0){
          $first_result = date("d-m-Y",strtotime($results[0]['timestamp']));
           $start = strtotime($first_result);
          $_SESSION['timestamp_'.$calendar_id] = $start;
          $day_results = array();
          $counter = 0;
          $arrow_prev = true;
          $arrow_next = false;
          for($i=0; $i < count($results);$i++){
            $current_date = date("d-m-Y",strtotime($results[$i]['timestamp']));
            if($first_result == $current_date){
              $day_results[$counter] = $results[$i];
              $counter++;
            }else if($current_date > date("Y-m-d H:i:s",(int)($start+86400))){
               $arrow_next = true;
            }            
          }
               
          $helper = new Helper();
          $output = $helper->prepareSmallOutput($day_results,$calendar_id, $booking_url, $max_in_row,$calendar_details,$arrow_prev,$arrow_next);
          echo json_encode(array("success"=>true,"content"=>$output));
          exit;
        }
        
      }else{
        //query db 
          try{
            $query = "SELECT * FROM mariocoski_event
                      WHERE calendar_id=:id AND timestamp>(NOW()+(:in_advance)) ORDER BY timestamp ASC";
                      $run = $db->prepare($query);
                      $run->execute(array(":id"=>$calendar_id,":in_advance"=>$in_advance));
                      $results = $run->fetchAll(PDO::FETCH_ASSOC);

          }catch(PDOException $e){
            echo json_encode(array("success"=>false,"content"=>array()));
            exit;
          }catch(Exception $e){
            echo json_encode(array("success"=>false,"content"=>array()));
            exit;
          }
         // echo json_encode(array("success"=>true,"content"=>$results));
          //exit;
        if(count($results) > 0){
           
        //show the first free visit day
          //first visit is a 
          $first_visit = date("d-m-Y",strtotime($results[0]['timestamp']));
          $start = strtotime($first_visit); // timestamp of d-m-Y 00:00:00
          $_SESSION['timestamp_'.$calendar_id] = (int)$start;
          $day_results = array();
          $counter = 0;
          $arrow_next = false;
          for($i=0; $i < count($results);$i++){
            if(date("d-m-Y",$start) == date("d-m-Y",strtotime($results[$i]['timestamp']))){
              $day_results[$counter] = $results[$i];
              $counter++;
            }else if(date("d-m-Y",strtotime($results[$i]['timestamp']) > date("Y-m-d H:i:s",(int)($start+86400)))){
               $arrow_next = true;
            }
          }
          $helper = new Helper();
          $arrow_prev = false;
          $output = $helper->prepareSmallOutput($day_results,$calendar_id, $booking_url, $max_in_row,$calendar_details,$arrow_prev,$arrow_next);
          echo json_encode(array("success"=>true,"content"=>$output));
          exit;
        }else{
          $_SESSION['timestamp_'.$calendar_id] = time();
          $helper = new Helper();
          $arrow_prev = false;
          $arrow_next = false;
          $day_results = array();
          $output = $helper->prepareSmallOutput($day_results,$calendar_id, $booking_url, $max_in_row,$calendar_details,$arrow_prev,$arrow_next);
          echo json_encode(array("success"=>true,"content"=>$output));
          exit;
        }
        echo json_encode(array("success"=>true,"content"=>$output));
        exit;
      }
    }else{
      echo json_encode(array("success"=>false,"content"=>array()));
      exit;
    }
  }else{
    echo json_encode(array("success"=>false,"content"=>array()));
    exit;
  }
}else{
  echo json_encode(array("success"=>false,"content"=>array()));
  exit;
}
?>
