<?php
    require("../lib/weixin.config.php");
    require("../weixin_oop_api.php");
    $title = "客房智控";
    require("../header.php");
    $appid = APPID;
    $appsecret = APPSECRET;
    $wx = new WeixinApi($appid,$appsecret);
    $redirect_uri = "http://kladz.applinzi.com/zhzg/Control/index.php";
    $result = $wx->snsapi_userinfo($redirect_uri);
    $openid = $result[openid];
// $openid = 'o45QqwbDsSisOnDSriXT12Pp7i1U';
    $mysql = SaeDB::getInstance();
    $sql = "select RoomId from z_userroom where OpenId='$openid'";
    //连主库
    $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
    mysql_select_db(SAE_MYSQL_DB,$link);
    $data = $mysql->getData( $sql );
    $roomno = mysql_query("select RoomId from z_userroom where OpenId='$openid'",$link);
    $roomno =  $data[0]["RoomId"];
    if($roomno){
    }else{
        exit("Uable to connect to your room!<br/>Please contact to the Front Desk!<br/><br/> 没有查到您订的房间！<br/>如有疑问，请联系前台：<br/>400-12345");
    }
?>

<link type="text/css" rel="stylesheet" href="css/font-awesome.css"/>
<link type="text/css" rel="stylesheet" href="css/style.css"/>

<script type="text/javascript" src="js/jquery-3.2.0.js"></script>

<body>

<div class="circle">
	<div class="ring">
	<a href="#" class="menuItem fa fa-home fa-2x"></a>
	<a href="#" class="menuItem fa fa-television fa-2x"></a>
	<a href="#" class="menuItem fa fa-music fa-2x"></a>
	<a href="service.php?roomno=<?php echo $roomno;?>" class="menuItem fa fa-volume-control-phone fa-2x"></a>
	<a href="bathtub.php?roomno=<?php echo $roomno;?>" class="menuItem fa fa fa-bath fa-2x">
	<a href="curtain.php?roomno=<?php echo $roomno;?>" class="menuItem"><img id="img_curtain" src="images/curtain_white.png" alt="窗帘"/></a>
	<a href="air.php?roomno=<?php echo $roomno;?>" class="menuItem"><img  id="img_air" alt="空调" src="images/air_white.png"/></a>
	<a href="led.php?roomno=<?php echo $roomno;?>" class="menuItem fa fa-lightbulb-o fa-2x"></a>
	</div>
	<a href="#" class="center fa fa-th fa-2x"></a>
</div>



<script type="text/javascript">
	var items = document.querySelectorAll('.menuItem');
	
	for(var i = 0, l = items.length; i < l; i++) {
	  items[i].style.left = (50 - 35*Math.cos(-0.5 * Math.PI - 2*(1/l)*i*Math.PI)).toFixed(4) + "%";
	  
	  items[i].style.top = (50 + 35*Math.sin(-0.5 * Math.PI - 2*(1/l)*i*Math.PI)).toFixed(4) + "%";
	}
	
	document.querySelector('.center').onclick = function(e) {
	   e.preventDefault(); document.querySelector('.circle').classList.toggle('open');
	}   
	   
	$(function(){
		$("[id^=img_]").mouseover( function () {
				var src=$(this).attr("src"); 
				var pre=src.split("_")[0];	
				$(this).attr("src",pre+"_red.png");	
		});
		
		$("[id^=img_]").mouseout( function () {
				var src=$(this).attr("src"); 
				var pre=src.split("_")[0];
				$(this).attr("src",pre+"_white.png");	
		});
	})
   
</script>
<div style="text-align:center;">
<br/><br/><br/>
<p>Copyright © 2017 福建科莱安</p>
</div>

</body>
</html>
