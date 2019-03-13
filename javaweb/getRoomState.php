<?php

  $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
  mysql_select_db(SAE_MYSQL_DB,$link);
  $sql=mysql_query("select s.room_id,s.door,s.card,s.safebox,s.curtain,s.bathtub,s.led_living,
      s.led_toilet,s.led_bedroom,s.led_bedside,s.led_entrance,s.air_id,a.state,a.model,a.sleep,
      a.temp,a.fan_speed,a.air_swing,s.execute from z_roomstate s left join z_roomair a on 
      s.air_id=a.air_id");
  $row=mysql_fetch_row($sql);

  if($row==false)
      echo"Not Found!";

  if ($row){
      echo $row[0].' '.$row[1].' '.$row[2].' '.$row[3].' '.$row[4].' '.$row[5].' '.$row[6].' '.$row[7].' '.$row[8].' '.$row[9].' '.$row[10].' '.$row[11].' '.$row[12].' '.$row[13].' '.$row[14].' '.$row[15].' '.$row[16].' '.$row[17].' '.$row[18];
  }
  
  while($row=mysql_fetch_row($sql))  {
      echo ',',$row[0].' '.$row[1].' '.$row[2].' '.$row[3].' '.$row[4].' '.$row[5].' '.$row[6].' '.$row[7].' '.$row[8].' '.$row[9].' '.$row[10].' '.$row[11].' '.$row[12].' '.$row[13].' '.$row[14].' '.$row[15].' '.$row[16].' '.$row[17].' '.$row[18];
  }
  
  $sql1 = mysql_query("update z_roomstate set execute = '0' where execute = '1' ",$link);  
    
  mysql_close($link);

       
?>