<?php
   
    require("../weixin_oop_api.php");
    require("../lib/weixin.config.php");
    //获取接口调用凭证
   $appid = APPID;
    $appsecret = APPSECRET;

    $wx = new WeixinApi($appid,$appsecret);
    $redirect_uri = "http://kladz.applinzi.com/zhzg/Info/customer.php";
    $result = $wx->snsapi_userinfo($redirect_uri);

    $OpenId = $result[openid];
?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>会员中心</title>
        <link rel="stylesheet" href="../public/weui/css/weui.min.css"/>
        <link rel="stylesheet" href="../public/weui/css/style.css"/>
    </head>
    <body ontouchstart>
        <div class="container" id="container"></div>
        <div class="hd">
            <p class="page_desc"><img src="<?php echo $result['headimgurl'];?>" class="avatar"></p>
        </div>
        <div class="bd">
            <div class="weui_cells weui_cells_access">
                <a class="weui_cell" href= "http://kladz.applinzi.com/BookHotel/MyOrder2.php" >
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>我的订单</p>
                    </div>
                    <div class="weui_cell_ft"></div>
                </a>

                <a class="weui_cell" href="javascript:;">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>我的会员卡</p>
                    </div>
                    <div class="weui_cell_ft"></div>
                </a>

                <a class="weui_cell" href="javascript:;">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>抵用券</p>
                    </div>
                    <div class="weui_cell_ft"></div>
                </a>
                <a class="weui_cell" href="javascript:;">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>用户协议</p>
                    </div>
                    <div class="weui_cell_ft"></div>
                </a>
            </div>
            <p class="page_desc mt30">
                @2016 福建科莱安（www.kladz.cn）-专注酒店开发
            </p>
        </div>
    </body>
</html>
