<?php
/**
 * Description of calendar1_visit_creator
 * This file help you to insert event timestamps to database quickly
 * Calendar 1  -> calendar_id = 334455
 * 
 * @author Mariocoski
 * @email mariuszrajczakowski@gmail.com 
 * @github https://github.com/mariocoski/Bootstrap-calendar
 * Copyright (c) 2015 Mariocoski
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

//load config file - make sure that path to config is correct  
require 'config/init.php';
//initialize DB connection
$db = new DB();
?>
<!-- GET STYLESHEET FOR BOOTSTRAP-->
<link href='<?php echo BOOTSTRAP_CSS; ?>bootstrap.css' rel='stylesheet'>  
  
<?php
//get current week
$current_week = date('W'); // i.e. 14
//get current year
$current_year = date('o'); //iso format

//adjust the settings
//how many weeks forward would you like to have in database
$how_many_weeks_forward = 4;
//how many visits should be per day
$how_many_visits_per_day = 6;
//which day of the week is first: monday or sunday
$first_day = 1; // 0 is sunday, 1 is monday
//calendar_id - must be the same like in your html index file and the same like in database

//error arrays
$errors_pdo = array();
$errors = array();


/*CALENDAR 1*/
$calendar_id1 = 334455;
$hour_start1 = 10;

//RUN ONLY IF YOU WANT TO DELETE RECORDS  
/*IF YOU WANT TO DELETE EVENTS FROM FIRST CALENDAR BEFORE INSERTING ANYTHING */
$db->query("DELETE FROM mariocoski_event WHERE calendar_id='$calendar_id1'");
  
//CREATING NEW RECORDS
  for($i=$current_week; $i < ($current_week+$how_many_weeks_forward); $i++){
     if($current_week < 10){
      $week_number = "0".$current_week;
    }else{
      $week_number = $current_week;
    }
    $year_number = $current_year;
    for($j=$first_day; $j<(7+$first_day);$j++){
      if($j%2 == 0){
        continue;
      }
      $max_a_day = (int)($hour_start1+$how_many_visits_per_day);
      if($j%3){
        $hour_start1 = 10;
        $max_a_day = 20;
      }
      try{
        for($l=$hour_start1; $l<$max_a_day;$l++){
          if($l < 10){
            $day_hour = "0".$l;
          }else{
            $day_hour = $l;
          }
          $timestamp = strtotime($year_number."W".$week_number.$j.$l.":00:00");
          // make some variety - some visits will be booked
          if($l%4){
            $query = "INSERT INTO `mariocoski_event`(`calendar_id`, `timestamp`) VALUES (:calendar_id, :timestamp)"; 
          }else{
            //each fourth visit will be booked
            $query = "INSERT INTO `mariocoski_event`(`calendar_id`, `timestamp`,`booked`) VALUES (:calendar_id, :timestamp,'1')"; 
          }
          $run = $db->prepare($query);
          $run->execute(array(":calendar_id"=>$calendar_id1,":timestamp"=>date("Y-m-d H:i:s",$timestamp)));
        }
      }catch(PDOException $e){
        $errors_pdo[] = $e;
      }catch(Exception $e){
        $errors[] = $e;
      }
    }
    $current_week++;
    $weeks_in_current_year = getMonthsCount($current_year);
    if($current_week > $weeks_in_current_year && $weeks_in_current_year==52){
      ++$current_year;
      $current_week = 1;
    }else if($current_week>$weeks_in_current_year&& $weeks_in_current_year==53){
      ++$current_year;
      $current_week = 1;
    } 
  }//end of big loop
  /*END OF CALENDAR 1*/
 
  /*ERRORS HANDLING*/
  //pdo errors
  if(count($errors_pdo)>0){
    echo "<div class='alert alert-danger'>";
    foreach($errors_pdo as $error){
      echo "<p>".$error->getMessage()."</p>";
    } 
    echo "</div>";
  }
  //normal errors
   if(count($errors)>0){
    echo "<div class='alert alert-danger'>";
    foreach($errors as $error){
      echo "<p>".$error->getMessage()."</p>";
    } 
    echo "</div>";
  }
  //DISPLAY SUCCESS MESSAGE IF EVERYTHING WAS CORRECT
  if(count($errors)== 0 && count($errors_pdo)==0){
    echo "<p class='alert alert-success'>Success!</p>";
  }
  
  
  //FUNCTION WHICH ALLOW TO ADJUST WEEK NUMBER PROPERLY 
  function getMonthsCount($year){
  $date = new DateTime();
  $date->setISODate($year, 53);
  return ($date->format("W") === "53" ? 53 : 52);
  }
  
