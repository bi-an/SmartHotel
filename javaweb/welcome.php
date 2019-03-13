<?php

      $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
      mysql_select_db(SAE_MYSQL_DB,$link);
      $sql=mysql_query("select room_id,sos,clean_room,silence,ask_service,check_out,execute from z_roomservice");
      $row=mysql_fetch_row($sql);
      if($row==false)
          echo"Not Found!";

      if ($row){
          echo $row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6];
      }

      while($row=mysql_fetch_row($sql)) {
         echo ',',$row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6];
      }   
      
     $sql = mysql_query("update z_roomservice set execute = '0' where execute = '1' ",$link);   
      
      mysql_close($link);

       
?>