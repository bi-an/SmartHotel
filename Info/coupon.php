<?php
    header("Content-type: text/html; charset=utf-8"); 
    $result = json_decode($_POST['result'],true);
    $openid = $result['openid'];
    include_once '../model/SaeDB.class.php';
    $mysql = SaeDB::getInstance();
    $sql = "SELECT * FROM  `z_member` where openid = '$openid'";
    $data = $mysql->getLine( $sql );
    if( $data['coupon']!=null ){
        $coupon = explode(',', $data['coupon']);
        $sql1 = "SELECT * FROM `z_coupon`";
        $data1 = $mysql->getData($sql1);
        foreach ($data1 as $key1 => $value1){
            foreach ($coupon as $key => $value){
                if(strpos($value1, '-') !== false){
                    if($value1['typeid'] == $value){
                        if(strtotime($value1['deadline'])>strtotime(date('Y-m-d H:i:s')))
                            $coupon_aval[] = $value1;
                        else 
                            $coupon_over[] = $value1;
                    }else{
                        $value = substr($value,1); 
                        if($value1['typeid'] == $value){
                            $coupon_used[] = $value1;
                        }
                    }
                }
            }
        }
    }
    
?>

<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">    
    <title>我的优惠券</title>    
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <link rel="stylesheet" href="../public/css/coupon.css"/>
    <script type="text/javascript" src="../public/js/jquery-3.2.0.js"></script>
    <script type="text/javascript" >
    	$(function(){
    	    var $div_li =$("div.tab_menu ul li");
    	    $div_li.click(function(){
    			$(this).addClass("selected")            //当前<li>元素高亮
    				   .siblings().removeClass("selected");  //去掉其它同辈<li>元素的高亮
                var index =  $div_li.index(this);  // 获取当前点击的<li>元素 在 全部li元素中的索引。
    			$("div.tab_box > div")   	//选取子节点。不选取子节点的话，会引起错误。如果里面还有div 
    					.eq(index).show()   //显示 <li>元素对应的<div>元素
    					.siblings().hide(); //隐藏其它几个同辈的<div>元素
    		}).hover(function(){
    			$(this).addClass("hover");
    		},function(){
    			$(this).removeClass("hover");
    		})
    	})
    </script>
</head>
<body>


<div class="tab">
	<div class="tab_menu">
		<ul>
			<li class="selected">未使用(<?php echo count($coupon_aval);?>)</li>
			<li>已使用(<?php echo count($coupon_used);?>)</li>
			<li>已过期(<?php echo count($coupon_over);?>)</li>
		</ul>
	</div>
	<div class="tab_box"> 
		 <div id="coupon-available">
		      <ul class="demo">
		      <?php foreach ($coupon_aval as $k1 => $v1){?>
		          <li class="avaliable left"><font class="font-left"><font class="yuan">&yen;<font class="no"><?php echo $v1['derate'];?></font><br><font class="lowest-consumption">满<?php echo $v1['lowest-consumption'];?>元可用</font></font></font></li><li class="right"><font class="description"><?php echo $v1['description'];?><br><font class="validate"><?php echo "<br>".date("Y.m.d",strtotime($v1['starttime'])).'-'.date("Y.m.d",strtotime($v1['deadline']));?></font></font></li>
            <?php }?>    
		      </ul>
		 </div>
		 <div class="hide" id="coupon-used">
		      <ul class="demo">
		      <?php foreach ($coupon_used as $k2 => $v2){?>
		          <li class="used left"><font class="font-left"><font class="yuan">&yen;<font class="no"><?php echo $v2['derate'];?></font><br><font class="lowest-consumption">满<?php echo $v2['lowest-consumption'];?>元可用</font></font></font></li><li class="right"><font class="description"><?php echo $v2['description'];?><br><font class="validate"><?php echo "<br>".date("Y.m.d",strtotime($v2['starttime'])).'-'.date("Y.m.d",strtotime($v2['deadline']));?></font></font><img alt="已使用" src="../public/images/seal.png" class="used-seal"></li>
		                
            <?php }?> 		      
            </ul>
		 </div>
		 <div class="hide" id="coupon-expired">
		      <ul class="demo">
		      <?php foreach ($coupon_over as $k3 => $v3){?>
		          <li class="expired left"><font class="font-left"><font class="yuan">&yen;<font class="no"><?php echo $v3['derate'];?></font><br><font class="lowest-consumption">满<?php echo $v3['lowest-consumption'];?>元可用</font></font></font></li><li class="right"><font class="description"><?php echo $v3['description'];?><br><font class="validate"><?php echo "<br>".date("Y.m.d",strtotime($v3['starttime'])).'-'.date("Y.m.d",strtotime($v3['deadline']));?></font></font></li>
            <?php }?> 		      
		      </ul>
		 </div>
	</div>
</div>

</body>
</html>