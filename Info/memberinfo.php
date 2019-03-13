<?php
$result = json_decode($_POST['result'],true);
$openid = $result['openid'];
$nickname = $result['nickname'];

include_once '../model/SaeDB.class.php';
$mysql = SaeDB::getInstance();
$sql = "SELECT * FROM  `z_member` where openid = '$openid'";
$data = $mysql->getLine( $sql );
?>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">

<link rel="stylesheet" type="text/css" href="../public/css/form.css"/>
<link rel="stylesheet" type="text/css" href="../public/css/font-awesome.css"/>
<link rel="stylesheet" type="text/css" href="../public/themes/mobile.css">
<link rel="stylesheet" type="text/css" href="../public/themes/icon.css">

<script type="text/javascript" src="../public/js/jquery-3.2.0.js"></script>
<script type="text/javascript" src="../public/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.easyui.mobile.js"></script>
<script type="text/javascript" src="../public/js/geo.js"></script>  
<script type="text/javascript" >
    var sex = <?php echo $data['sex']?>;
    var address = "<?php echo $data['address']?>";

	$(function(){		
	    $(".down1").click(function(){
			$("div.content1").show();
			$(".down1").hide();
			$(".up1").show();
		})
		$up = $(".up1").click(function(){
			$("div.content1").hide();
			$(".down1").show();
			$(".up1").hide();
		})
		
	    $(".down2").click(function(){
			$("div.content2").show();
			$(".down2").hide();
			$(".up2").show();
		})
		$up = $(".up2").click(function(){
			$("div.content2").hide();
			$(".down2").show();
			$(".up2").hide();
		})
		

		var provinces = $("#s1 option").map(function(){return $(this).val();}).get();
		for(var x in provinces){
			if (address.indexOf(provinces[x]) >= 0){
				preselect(provinces[x]);
				break;
			}
		}

		var cities = $("#s2 option").map(function(){return $(this).val();}).get();
		for(var x in cities){
			if (address.indexOf(cities[x]) >= 0){
				if(cities[x] != "城市"){
    				$("#s2").val(cities[x]);
    				break;
				}
			}
		}
		
		if(sex == 1){
			$("#sex").switchbutton({checked:true});
		}else {
			$("#sex").switchbutton({checked:false});
		}
	})

</script>

<title>个人信息</title> 
</head>
<body onload="setup();">
<form action="membersave.php" method="post">
    <div class="d-title header">持卡人信息</div>
    <i class="fa fa-angle-double-down down1" aria-hidden="true"></i>
    <i class="fa fa-angle-double-up up1" aria-hidden="true"></i>
    <div class="content1">
	<div style="margin-bottom:10px" class="input text">
		<input class="easyui-textbox" label="名字" prompt="您的名字" style="width:100%" name="nickname" value="<?php echo $nickname;?>" disabled>
	</div>
	<div style="margin-bottom:10px" class="input text">
		<input class="easyui-numberbox" label="手机" prompt="您的手机号" style="width:100%" name="telephone" value="<?php echo $data['telephone'];?>">
	</div>
	<div style="margin-bottom:10px" class="input notext">
		<label class="textbox-label">性别</label>
		<input id="sex" class="easyui-switchbutton" onText="男" offText="女" name="sex" value=1>
	</div>
	<div class="input notext">
	    <label class="textbox-label">常住地址</label>
        <select class="select" name="province" id="s1">  
          <option></option>  
        </select>  
        <select class="select" name="city" id="s2">  
          <option></option>  
        </select>  
        <input id="address" name="address" type="hidden" value="" />
    </div>
    </div>

    <div class="d-title footer">宝宝信息</div>
    <i class="fa fa-angle-double-down down2" aria-hidden="true"></i>
    <i class="fa fa-angle-double-up up2" aria-hidden="true"></i>
    <div class="content2">
	<div style="margin-bottom:10px" class="input text">
		<input class="easyui-textbox" label="名字" prompt="您的名字" style="width:100%" name="name" value="<?php echo $data['name'];?>">
	</div>
    <div style="margin-bottom:10px" class="input text">
		<input class="easyui-datebox" label="生日" prompt="您的生日" name="birthday" data-options="editable:false,panelWidth:220,panelHeight:240,iconWidth:30" style="width:100%" value="<?php echo date('m/d/Y',strtotime($data['birthday']));?>">
	</div>
    <input type="hidden" name="openid" value="<?php echo $openid;?>"/>
    <input type="hidden" name="barcode" value="<?php echo $data['barcode'];?>"/>
    <input name="result" type="hidden" value='<?php echo json_encode($result);?>'/>
    </div>
    <div><input onclick="promptinfo();" type="submit" value="保  存" class="render"/></div>
    
</form>



</body>
</html>