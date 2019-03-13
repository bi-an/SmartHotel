<?php
     $modelno   = $_GET[modelno];
     $state     = $_GET[state];
     $roomtemp  = $_GET[roomtemp];      
     $type      = $_GET[type];
     $wind      = $_GET[wind];
     $openmodel = $_GET[openmodel];
     $modelname  = $_GET[modelname];
     $autorun   = $_GET[autorun];
     $temp      = $_GET[temp];
     $roomno    = $_GET[roomno];
     $id        = $_GET[id];
     

     $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
     mysql_select_db(SAE_MYSQL_DB,$link);
     $sql = mysql_query("update t_uploadair set modelno = '$modelno' ,state = '$state',roomtemp = '$roomtemp',type = '$type',wind = '$wind',openmodel = '$openmodel',modelname = '$modelname',autorun = '$autorun',temp = '$temp' where roomno = $roomno and id = $id ",$link);     
     mysql_close($link);
    
     echo $roomtemp;
?>