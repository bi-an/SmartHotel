<?php
     $dimmerId     = $_GET[dimmerId];
     $showState    = $_GET[showState];
     $roomno      = $_GET[roomno];
         
     $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
     mysql_select_db(SAE_MYSQL_DB,$link);
     $sql = mysql_query("update t_uploaddimmer set showState = '$showState'  where roomno = $roomno  and dimmerId  = $dimmerId ",$link);
     mysql_close($link);
     echo "dimmerId=".$dimmerId,"showState=".$showState;
?>