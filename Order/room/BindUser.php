<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=screen-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<title>用户注册</title>
<style>
.content{
	border:2px solid #d9d9d9;
	border-radius: 15px;	
}
.content p{	
	width:100%;
}

.content p label{	
	margin-left:10px;
	font-size:18px;
	font-family:"微软雅黑","Arial","Helvetica",sans-serif,verdana;
	color:#383838;
}
.content p input[type="text"] {	
	height:32px;
	border:1px solid #d9d9d9;
	margin:0px 1px;
	width:90%;
	font-size:18px;
	overflow:hidden;
}
</style>
<link rel="stylesheet" href="../../css/demos.css">
<script src="../../public/js/jquery-1.10.2.js"></script>
<script src="../../public/js/jquery.ui.core.js"></script>
<script src="../../public/js/jquery.ui.widget.js"></script>
<script src="../../public/js/jquery.ui.datepicker.js"></script>
<script type="text/javascript">
	function check(){
	    var name = document.getElementById("name").value;
	    var telephone = document.getElementById("telephone").value; 
	    var Identity = document.getElementById("Identity").value;    
	    if(!name){
	        alert('请填写姓名！');
	        return false;
	    }
	    if(!telephone){
			alert("请留下您的联系方式！");
			return false;
		}
		if(!Identity){
			alert("根据公安部门要求，请留下身份证号码！");
			return false;
		}
		
		document.getElementById("myform").submit(); 
/* 		$('#myform').submit(); */
	}
</script>

<!--   引入jQuery -->
<script src="../../public/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
		//如果是必填的，则加红星标识.
		$("form :input.required").each(function(){
			var $required = $("<strong class='high'> *</strong>"); //创建元素
			$(this).parent().append($required); //然后将它追加到文档中
		});
         //文本框失去焦点后
	    $('form :input').blur(function(){
			 var $parent = $(this).parent();
			 $parent.find(".formtips").remove();
// 			 //验证用户名
// 			 if( $(this).is('#username') ){
// 					if( this.value=="" || this.value.length < 6 ){
// 					    var errorMsg = '请输入至少6位的用户名.';
//                         $parent.append('<span class="formtips onError">'+errorMsg+'</span>');
// 					}else{
// 					    var okMsg = '输入正确.';
// 					    $parent.append('<span class="formtips onSuccess">'+okMsg+'</span>');
// 					}
// 			 }
// 			 //验证邮件
// 			 if( $(this).is('#email') ){
// 				if( this.value=="" || ( this.value!="" && !/.+@.+\.[a-zA-Z]{2,4}$/.test(this.value) ) ){
//                       var errorMsg = '请输入正确的E-Mail地址.';
// 					  $parent.append('<span class="formtips onError">'+errorMsg+'</span>');
// 				}else{
//                       var okMsg = '输入正确.';
// 					  $parent.append('<span class="formtips onSuccess">'+okMsg+'</span>');
// 				}
// 			 }

			 //验证手机
			 if( $(this).is(#telephone) ){
				if( this.value=="" || ( this.value!="" && !\d{11}.test(this.value) ) ){
					var errorMsg = '请输入正确的电话号码';
					$parent.append('<span class="formtips onError">'+errorMsg+'</span>');
				}else{
					var okMsg = "输入正确";
					$parent.append('<span class="formtips onSuccess">'+okMsg+'</span>');
				}
		     }
			 
		}).keyup(function(){
		   $(this).triggerHandler("blur");
		}).focus(function(){
	  	   $(this).triggerHandler("blur");
		});//end blur

		
		//提交，最终验证。
		 $('#send').click(function(){
				$("form :input.required").trigger('blur');
				var numError = $('form .onError').length;
				if(numError){
					return false;
				} 
				alert("注册成功,密码已发到你的邮箱,请查收.");
		 });

		//重置
		 $('#res').click(function(){
				$(".formtips").remove(); 
		 });
})
</script>


</head>
<body>
<div class="content">
<form action='AddUser.php' method='post' id='myform' onsubmit="return check();">
<p>
<label >欢迎来到科莱安酒店，注册用户第一次使用微信预定，在原有折扣基础之上再减20元,积分还可以抵扣房费，还等什么，来吧!!!</label>
</p>
<br/>
<p><label>姓名：</label>
<input type="text" id='name' name='name' class="required"/></p>

<p><label>手机：</label>
<input type="text" id='telephone' name='telephone' pattern="\d{11}" class="required"/></p>

<p><label>身份证号码:</label>
<input type="text" id='Identity' name='Identity' pattern="\d{18}"/></p>
<p>
<!-- <a class='btn_buy' onClick="$('#myform').submit();">下一步</a> -->
<button value="submit">下一步</button>
</p>
<input type='hidden' name='openid' id='openid' value="<?php echo  $_GET['OpenId'];?>">
</form>
</div>
</body>
</html>

