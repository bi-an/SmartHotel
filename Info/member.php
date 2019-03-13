<?php 
    $result = json_decode($_POST['result'],true);
    $openid = $result['openid'];
    
    include_once '../model/SaeDB.class.php';
    require '../lib/weixin.class.php';
    
    $mysql = SaeDB::getInstance();
    $sql = "SELECT * FROM  `z_member` where openid = '$openid'";
    $data = $mysql->getLine( $sql );
    if($data != null){
        $barcode = $data['barcode'];
        if( $data['coupon']!=null ){
            $coupon = explode(',', $data['coupon']);
        }
    }else {
        echo '<form id="post_form" action="memberadd.php" method="post">
               <input type="hidden" name="result" value='.json_encode($result).'></form>';
        echo '<script type="text/javascript" src="../public/js/jquery-3.2.0.js"></script>';
        echo "<script type='text/javascript'>$('#post_form').submit();</script>";
    }
?>
 


<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=screen-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="stylesheet" href="../public/css/member.css">
<link type="text/css" rel="stylesheet" href="../public/css/font-awesome.css"/>

<script type="text/javascript" src="../public/js/jquery-3.2.0.js"></script>
<script type="text/javascript">
    function submit(address){
        $("#post_form").attr("action",address);
		$("#post_form").submit();
    }
</script> 

<title>我的会员卡</title>
</head>
<body>
<div id="header">
    <img id="stamp" src="<?php echo $result['headimgurl'];?>">
    <table class="left-white"><tr><td></td><td>卡片类型：微卡</td></tr>
    <tr><td></td><td>等级折扣：无</td></tr></table>
</div>
<div id="">
    <div><span>积分余额</span><div class="float-right"><?php echo $data['credit'];?></div></div><hr>
    <div><span>优惠券数量</span><div class="float-right"><?php if( $data['coupon']!=null) echo count($coupon); else echo 0;?></div></div>
</div>
<div id="wecard">
<div><img alt="微卡" src="../public/images/wecard.png" id="card"></div>
<div><img alt="条形码" src="barcode.php?barcode=<?php echo $barcode;?>" id="bar"></div>
</div>
<div>
    <div class="float"><div class="circle"><a onclick="alert('暂无活动');"><i class="fa fa-refresh fa-2x" aria-hidden="true"></i></a></div><font>积分活动</font></div>
    <div class="float"><div class="circle"><a onclick="submit('memberinfo.php')"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></div><font>个人资料</font></div>
    <div class="float"><div class="circle"><a href="manual.php"><i class="fa fa-user-o fa-2x" aria-hidden="true"></i></a></div><font>会员手册</font></div>
    <div class="float"><div class="circle"><a><i class="fa fa-picture-o fa-2x" aria-hidden="true"></i></a></div><font>更换绑定</font></div>
    <div class="clear"></div>
</div>

<div id="footer">powered by FZU</div>
<form id="post_form" action="" method="post">
    <input type="hidden" name="result" value='<?php echo json_encode($result);?>'/>
</form>

</body>
</html>