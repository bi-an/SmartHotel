<?php
     $roomno = $_POST['roomno'];
     
     //连主库
     $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
     mysql_select_db(SAE_MYSQL_DB,$link);
     $sql=mysql_query("select * from z_roomstate  where room_id = $roomno",$link);
     $leds = array();
     $row=mysql_fetch_assoc($sql);
     foreach ($row as $key => $value){
         if(strstr($key,'led')){
             $value = $_POST[$key];
             mysql_query("update z_roomstate set $key = '$value' where room_id = $roomno",$link);
         }
     }

     mysql_query("update z_roomstate set execute = 1 where room_id = $roomno",$link);
     
//      sleep(3);
 
     mysql_close($link);
//      var_dump(1);

     header("Location:led.php?roomno=".$roomno);
?>