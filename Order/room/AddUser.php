<?php
     
    $OpenId = ($_POST['openid']);
    $Telephone= ($_POST['telephone']);
	  $Name= ($_POST['name']);
	  $Identify=($_POST['Identity']);

    // 连主库
    $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
    mysql_select_db(SAE_MYSQL_DB,$link);
    mysql_query("insert into z_user(OpenId,Name,Telephone,Identify)values('$OpenId','$Name','$Telephone','$Identify')",$link);     
    mysql_close($link);
    
    $url = 'http://kladz.applinzi.com/zhzg/Order/room/hoteldetail.php?OpenId='.$OpenId;
	  header('Location:'.$url);
	//$url = 'http://8.huoyaxiaotu.sinaapp.com/BookHotel/hoteldetail.php?hotelid='.$_POST['hotelid'].'&openid='.$OpenId;
	//header('Location:'.$url);
    exit;
?>