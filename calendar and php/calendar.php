<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link href="calendar.css" rel="stylesheet" type="text/css" />
  <?php
    $curDate = getdate();
    $curDate[days] = cal_days_in_month(CAL_GREGORIAN, $curDate[mon], $curDate[year]);
    
    if ($curDate[mon] == 1) { 
      $prevDate[mon]=12; 
      $prevDate[year]=$curDate[year]-1; 
    }
    else { 
      $prevDate[mon]=$curDate[mon]-1; 
      $prevDate[year]=$curDate[year]; 
    }
    $prevDate[days]=cal_days_in_month(CAL_GREGORIAN, $prevDate[mon], $prevDate[year]);
    
   
    $calStart = $curDate[mday] - $curDate[wday] + 1;
    while ($calStart > 1) $calStart -= 7;
    
    $showMon = 1;
    if ($calStart <= 0) {
      $calStart += $prevDate[days];
      $showMon = 0;
    }
    $monDays[0] = $prevDate[days];
    $monDays[1] = $curDate[days];
    $monDays[2] = 110;
  ?>
</head>
<div width="840px" style="background-color:#EEEEEE;">
  <table>
    <tr>
      <th>M</th>
      <th>T</th>
      <th>W</th>
      <th>T</th>
      <th>F</th>
      <th>S</th>
      <th>S</th>
    </tr>
  <?php 
  
    for ($showDay=$calStart, $showWeekDay=1, $breakFor = 1; $breakFor || $showWeekDay != 1; $showWeekDay++, $showDay++) {
      if ($showWeekDay==1) echo "<tr>";
      
      echo "<td><div class=\"calCell\">".$showDay; 
      echo "<div class=\"over9000\">";
      // here goes the retrieving of events from databse!!!!!!!!!!!!!!!
      for ($i=0; $i<=10; $i++) echo "Event".$i."<br />";
      //
      echo "</div></td>\n";
      
      
      if ($showWeekDay == 7) {
         $showWeekDay = 0; 
         echo "</tr>";
       }
     
      if ($showDay == $monDays[$showMon]) {
        $showDay = 0;
        $showMon ++;
        if ($showMon == 2) $breakFor = 0;
       }
    }
  ?>
  </table>
</div>
</html>