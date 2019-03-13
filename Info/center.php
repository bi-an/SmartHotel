<?php
   
    require("../weixin_oop_api.php");
    require("../lib/weixin.config.php");
    //获取接口调用凭证
    $appid = APPID;
    $appsecret = APPSECRET;

    $wx = new WeixinApi($appid,$appsecret);
    $redirect_uri = "http://kladz.applinzi.com/zhzg/Info/center.php";
    $result = $wx->snsapi_userinfo($redirect_uri);
?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>会员中心</title>
        <link rel="stylesheet" href="../public/weui/css/weui.min.css"/>
        <link rel="stylesheet" href="../public/weui/css/style.css"/>
        <script type="text/javascript" src="../public/js/jquery-3.2.0.js"></script>
        
        <script type="text/javascript">
            function submit(address){
                $("#post_form").attr("action",address);
    			$("#post_form").submit();
            }
        </script>
    </head>
    <body ontouchstart>
        <div class="container" id="container"></div>
        <div class="hd">
            <p class="page_desc"><img src="<?php echo $result['headimgurl'];?>" class="avatar" style="height: 10px;width:10px;"></p>
        </div>
        <div class="bd">
            <div class="weui_cells weui_cells_access">
                <a class="weui_cell" onclick="submit('memberadd.php')">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>会员注册</p>
                    </div>
                    <div class="weui_cell_ft"></div>
                </a>

                <a class="weui_cell" onclick="submit('member.php')">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>我的会员卡</p>
                    </div>
                    <div class="weui_cell_ft"></div>
                </a>

                <a class="weui_cell" onclick="submit('coupon.php')">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>优惠券</p>
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
                @2017 福建科莱安（www.kladz.cn）-专注酒店开发
            </p>
        </div>
        
        <form id="post_form" action="" method="post">
            <input type="hidden" name="result" value='<?php echo json_encode($result);?>'/>
        </form>
        
    </body>
</html>
