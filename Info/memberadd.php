<?php 
    $result = json_decode($_POST['result'],true);
    $openid = $result['openid'];
    $headimagurl = $result['headimagurl'];
    $nickname = $result['nickname'];

    require '../lib/common.func.php';
    require '../lib/weixin.class.php';
    include_once '../model/SaeDB.class.php';
    
    $mysql = SaeDB::getInstance();
    $sql = "SELECT * FROM  `z_member` where openid = '$openid'";
    $data = $mysql->getLine($sql);
    
    if ($data == null){
        //生成会员卡的条形码（卡号）
        $mysql = SaeDB::getInstance();
        $sql = "SELECT * FROM  `z_member`";
        $data = $mysql->getData( $sql );
        foreach ($data as $key => $value){
            $barcode[] = $value['barcode'];
        }
        do {
            $code = getRandChar(15);
        }while(is_array($code,$barcode));
    }else {
        echo '<form id="post_form" action="member.php" method="post">
               <input type="hidden" name="result" value='.json_encode($result).'></form>';
        echo '<script type="text/javascript" src="../public/js/jquery-3.2.0.js"></script>';
        echo "<script type='text/javascript'>$('#post_form').submit();</script>";
    }
    

?>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<title>会员注册</title> 
<link rel="stylesheet" type="text/css" href="../public/themes/metro/easyui.css">
<link rel="stylesheet" type="text/css" href="../public/css/form.css"/>
<link rel="stylesheet" type="text/css" href="../public/themes/mobile.css"/>
<link rel="stylesheet" type="text/css" href="../public/themes/icon.css"/>
<script type="text/javascript" src="../public/js/jquery-3.2.0.js"></script>
<script type="text/javascript" src="../public/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.easyui.mobile.js"></script>
<script type="text/javascript" src="../public/js/geo.js"></script>  
</head>

<body onload="setup();preselect('北京市');">
	<div class="easyui-navpanel" style="position:relative;padding:20px">
		<header>
			<div class="m-toolbar">
				<div class="m-title">会员注册</div>
				<div class="m-right">
					<a href="javascript:void(0)" class="easyui-linkbutton" plain="true" outline="true" onclick="$('#ff').form('reset')" style="width:60px">Reset</a>
				</div>
			</div>
		</header>
		<form id="ff" action="membersave.php" method="post">
			<div style="margin-bottom:10px">
				<input class="easyui-numberbox" label="手机:" prompt="您的手机号" style="width:100%" name="telephone">
			</div>
			<div style="margin-bottom:10px">
				<input class="easyui-textbox" label="名字:" prompt="您的名字" style="width:100%" name="name">
			</div>
			<div style="margin-bottom:10px">
				<input class="easyui-datebox" label="生日:" prompt="您的生日" name="birthday" data-options="editable:false,panelWidth:220,panelHeight:240,iconWidth:30" style="width:100%">
			</div>
			<div style="margin-bottom:10px">
				<label class="textbox-label">性别:</label>
				<input class="easyui-switchbutton" onText="男" offText="女" name="sex" value=1 checked>
			</div>
			<div>
			    <label class="textbox-label">常住地址:</label>
                <select class="select" name="province" id="s1">  
                  <option></option>  
                </select>  
                <select class="select" name="city" id="s2">  
                  <option></option>  
                </select>  
<!--                 <select class="select" name="town" id="s3">   -->
<!--                   <option></option>   -->
<!--                 </select>   -->
                <input id="address" name="address" type="hidden" value="" />
                <input name="openid" type="hidden" value="<?php echo $openid;?>"/>
                <input name="barcode" type="hidden" value="<?php echo $code;?>"/>
                <input name="result" type="hidden" value='<?php echo json_encode($result);?>'/>
			</div>
			<input onclick="promptinfo();" type="submit" value="提交" class="send"/>
		</form>
	</div>
</body>
</html>

