<?php
  require 'config/init.php';
  $db = new DB();
?>
 <link href='<?php echo BOOTSTRAP_CSS; ?>bootstrap.css' rel='stylesheet'>
<?php


$current_week = date('W'); // i.e. 14
  $current_year = date('o'); //iso format
    
  $how_many_weeks_forward = 4;
  $how_many_visits_per_day = 10;
  $first_day = 1; // 0 is sunday, 1 is monday
  $calendar_id = 667788;
  $errors_pdo = array();
  $errors = array();
  $hour_start = 7;

  //RUN ONLY IF YOU WANT TO DELETE RECORDS  
  $db->query("DELETE FROM mariocoski_event WHERE calendar_id='$calendar_id'");
  
  
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
      $max_a_day = (int)($hour_start+$how_many_visits_per_day);
      if($j%3){
        $hour_start = 7;
        $max_a_day = 12;
      }
      try{
        for($l=$hour_start; $l<$max_a_day;$l++){
          if($l < 10){
            $day_hour = "0".$l;
          }else{
            $dat_hour = $l;
          }
          $timestamp = strtotime($year_number."W".$week_number.$j.$l.":00:00");
         
          if($l%4){
            $query = "INSERT INTO `mariocoski_event`(`calendar_id`, `timestamp`) VALUES (:calendar_id, :timestamp)"; 
          }else{
            //each fourth visit will be booked
            $query = "INSERT INTO `mariocoski_event`(`calendar_id`, `timestamp`,`booked`) VALUES (:calendar_id, :timestamp,'1')"; 
          }
          $run = $db->prepare($query);
          $run->execute(array(":calendar_id"=>$calendar_id,":timestamp"=>date("Y-m-d H:i:s",$timestamp)));
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
  }
  if(count($errors_pdo)>0){
    echo "<div class='alert alert-danger'>";
    foreach($errors_pdo as $error){
      echo "<p>".$error->getMessage()."</p>";
    } 
    echo "</div>";
  }
   if(count($errors)>0){
    echo "<div class='alert alert-danger'>";
    foreach($errors as $error){
      echo "<p>".$error->getMessage()."</p>";
    } 
    echo "</div>";
  }
  if(count($errors)== 0 && count($errors_pdo)==0){
    echo "<p class='alert alert-success'>Success!</p>";
  }
  
  function getMonthsCount($year){
  $date = new DateTime();
  $date->setISODate($year, 53);
  return ($date->format("W") === "53" ? 53 : 52);
}
  