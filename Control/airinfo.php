<?php
   $airid  = $_GET['airid'];
   //连主库
   $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
   mysql_select_db(SAE_MYSQL_DB,$link);
//    $sql = mysql_query("update z_roomair set execute = '1' where air_id = $airid",$link);  
//    sleep(3);
   
   $sql=mysql_query("select * from z_roomair  where air_id = $airid",$link);

   $row=mysql_fetch_assoc($sql);
   mysql_close($link);
    
   echo json_encode($row);
       
 ?>