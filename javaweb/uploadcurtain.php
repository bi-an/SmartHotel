<?php
     $modname     = $_GET[modname];
     $clstate     = $_GET[clstate];
     $roomno      = $_GET[roomno];
     $id          = $_GET[id];
     
     $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
     mysql_select_db(SAE_MYSQL_DB,$link);
     $sql = mysql_query("update t_uploadcurtain set clstate = '$clstate'        where roomno = $roomno  and id  = $id ",$link);
     mysql_close($link);
     echo "modname=".$modname,"clstate=".$clstate,"id=".$id;
?>

