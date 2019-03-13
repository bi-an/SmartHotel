<?php

	$mysql = new SaeMysql();
	
	$orderid=$mysql->escape($_POST['orderid']);

    $sql = "delete from z_order_s where Id = $orderid";
    $mysql->runSql($sql);
    if ($mysql->errno() != 0)
    {
        die("Error:".$mysql->errmsg());
    }
    $mysql->closeDb();
    
   $url = 'http://kladz.applinzi.com/BookHotel/MyOrder2.php';
   header('Location:'.$url);
   exit();
?>

