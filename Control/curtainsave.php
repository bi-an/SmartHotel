<?php
     $roomno = $_POST['roomno'];
     $curtain = $_POST['curtainstate'];
     //连主库
     $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
     mysql_select_db(SAE_MYSQL_DB,$link);
     
     $sql=mysql_query("update z_roomstate set curtain = $curtain where room_id = $roomno",$link);
     
     mysql_query("update z_roomstate set execute = 1 where room_id = $roomno",$link);
     
//      sleep(3);
 
     mysql_close($link);


     header("Location:curtain.php?roomno=".$roomno);
?>