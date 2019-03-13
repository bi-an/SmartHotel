<?php

      $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
      mysql_select_db(SAE_MYSQL_DB,$link);
      $sql=mysql_query("select air_id,state,state,sleep,temp,fan_speed,air_swing,execute from z_roomair");
      $row=mysql_fetch_row($sql);
      if($row==false)
          echo"Not Found!";

      do
      {
         echo $row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7];
      
      }   while($row=mysql_fetch_row($sql));
      $sql = mysql_query("update z_roomair set execute = '0' where execute = '1' ",$link);     
        
      mysql_close($link);

       
?>