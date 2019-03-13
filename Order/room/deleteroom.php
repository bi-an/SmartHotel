<?php

	$mysql = new SaeMysql();
	
	$orderid=$mysql->escape($_POST['orderid']);
	
    $sql = "delete from z_userroom where Id = $orderid";
    $mysql->runSql($sql);
    if ($mysql->errno() != 0)
    {
        die("Error:".$mysql->errmsg());
    }
    $mysql->closeDb();
    
   $url = 'http://kladz.applinzi.com/zhzg/Order/orderlist.php';
   header('Location:'.$url);
   exit();
?>