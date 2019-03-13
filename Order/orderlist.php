<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=screen-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<link href="../public/css/styles.css" type="text/css" rel="stylesheet" />
<script src="../public/js/jquery.ui.core.js"></script>
<script src="../public/js/jquery.ui.widget.js"></script>
<script src="../public/js/jquery-1.10.2.js"></script>
<script src="../public/js/jquery-ui.js"></script>
<link rel="stylesheet" href="../public/css/jquery-ui.css">

<title>我的订单</title>

</head>
<body>

<?php
	require("../weixin_oop_api.php");
    //获取接口调用凭证
    require("../lib/weixin.config.php");
    
    $wx = new WeixinApi(APPID,APPSECRET);
    $redirect_uri = "http://kladz.applinzi.com/zhzg/Order/orderlist.php";
    $result = $wx->snsapi_userinfo($redirect_uri);
    $openid = $result[openid];
// $openid = 'o45QqwbDsSisOnDSriXT12Pp7i1U';
    
//     $data = array();
        $mysql = new SaeMysql();
        
        echo "<br/><h2 class='detail_title'>我的房间</h2>";
        $sql = "select * from z_userroom where OpenId = '$openid' and Finished=false";
        $orderlist=$mysql->getData($sql);
        if($orderlist){
            include 'room/myroom.php';
        }else{                
            echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;没有您的房间信息</p><br/><br/>";
        }
        
        echo "<br/><br/><h2 class='detail_title'>我的用餐</h2>";
        $sql = "select * from z_userdinnerinfo where OpenId = '$openid'  and Finished=false";
        $orderlist2=$mysql->getData($sql);
        if($orderlist2){
            include 'seat/myseat.php';
            $sql = "select id,menuid,Finished from z_usermenu where OpenId = '$openid' and Finished=false";
            $orderlist3=$mysql->getData($sql);
            echo "<h2 class='detail_title_menu'>菜单</h2>";
            if($orderlist3){
                include 'dinner/mymenu.php';
            }else{
                echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;没有您的菜单信息</p><br/><br/>";
            }
        }else{            
            echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;没有您的餐位信息</p><br/><br/>";
        }

?>
</body>
</html>
     

