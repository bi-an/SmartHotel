<?php
    header("Content-type: text/html; charset=utf-8"); 
    $openid=($_POST['openid']);
     $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
     mysql_select_db(SAE_MYSQL_DB,$link);
     $sql=mysql_query("select * from z_userroom where OpenId = '$openid' "); 
     $count = intval(mysql_num_rows($sql));
     $isFirstOrder = $count == 0?true:false;
     $RoomId = $_POST['roomid'];      
         
     $sql=mysql_query("select * from z_room where Id ='$RoomId' "); 
     $roominfo=mysql_fetch_array($sql);
      
     $price = $roominfo[MemberPrice];
     $Total = $price*intval($_POST['days']);
     if($isFirstOrder)
    {
	     $Total=$Total-20;
	     $discount = 20;
    }
   
    
    $date=date('Y-m-d',strtotime($_POST['date']));
    $Count=intval($_POST['days']);
     
     
     if($isFirstOrder)
        $str = "insert into z_userroom (RoomId, Time, OpenId, Price, Count, Total,Finished,FirstOrder) 
                values('$RoomId', '$date','$openid',$price, $Count, $Total,false,true)";
     else
         $str = "insert into z_userroom (RoomId, Time, OpenId, Price, Count, Total,Finished,FirstOrder) 
                values('$RoomId', '$date','$openid',$price, $Count, $Total,false,false)";           
     $sql=mysql_query( $str);
     
     $sql = mysql_query("select * from z_hotel where Id =1 ");
     $HotelInfo = mysql_fetch_array($sql);
     mysql_close($link);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=screen-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<link href="../../public/css/styles.css" type="text/css" rel="stylesheet" />
<title>预定酒店</title>

</head>
<body>
<?php
	echo '<div class="d-left-module mt15"><div class="inner m-hotel-overview" id="jxDescTab">';
	echo '<h2 class="facility-title">预定成功，欢迎入住</h2><div class="hotel-introduce" id="descContent"><div class="base-info bordertop clrfix">';
    echo '<dl class="inform-list"><dt>酒   店：</dt><dd><cite>'.$HotelInfo["Name"].'</cite></dd></dl>';
    echo '<dl class="inform-list"><dt>数   量：</dt><dd><cite>'.$Count.'天</cite></dd></dl>';
	echo '<dl class="inform-list"><dt>房   型：</dt><dd><cite>'.$roominfo["Type"].'</cite></dd></dl>';
	echo '<dl class="inform-list"><dt>入住日期：</dt><dd><cite>'.$date.'</cite></dd></dl>';
	echo '<dl class="inform-list"><dt>会 员 价：</dt><dd><cite>'.$roominfo["MemberPrice"].'元</cite></dd></dl>';
	if($isFirstOrder)
	{
		echo '<dl class="inform-list"><dt>抵   扣：</dt><dd><cite>'.$discount.'元</cite></dd></dl>';
	}
	echo '<dl class="inform-list"><dt>总   价：</dt><dd><cite>'.$Total.'元</cite></dd></dl>';
	echo '<dl class="inform-list"><dt>电   话：</dt><dd><cite>'.$HotelInfo["Telephone"].'</cite></dd></dl>';
	echo '<dl class="inform-list"><dt>地   址：</dt><dd><cite>'.$HotelInfo["Address"].'</cite></dd></dl>';
	echo '</div></div></div></div>';
?>
</body>
</html>

