<?php
     $roomno      = $_GET[roomno];
     $relayid     = $_GET[relayid];
     $relaystate  = $_GET[relaystate];

     $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
     mysql_select_db(SAE_MYSQL_DB,$link);
     
     $sql = mysql_query("update t_roomrelay set relaystate = '$relaystate'  where roomno = $roomno  and relayid = $relayid ",$link);     
     mysql_close($link);
    echo "roomno=".$roomno."relayid=".$relayid."relaystate=".$relaystate;
?>