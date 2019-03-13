<?php
       $roomno  = $_GET[roomno];
       //连主库
       $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
       mysql_select_db(SAE_MYSQL_DB,$link);
       $sql = mysql_query("update z_roomstate set execute = '1' where room_id = $roomno",$link);  
       sleep(3);
       
       $sql=mysql_query("select * from z_roomstate  where room_id = $roomno",$link);
       $results = array();
       $row=mysql_fetch_assoc($sql);
       foreach ($row as $key => $value){
           if(strstr($key,'led')){
               $results[$key] = $value;
           }
       }
       return $results;
       mysql_close($link);
 ?>