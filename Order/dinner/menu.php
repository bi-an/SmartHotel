<?php
$title = '点菜';
include '../../header.php';

$mysql = SaeDB::getInstance();
$sql = "SELECT * FROM  `z_menu` where available = 0 order by category asc";

$data = $mysql->getData( $sql );

$mysql->closeDb();


//获取客户的openid
require("../../lib/weixin.config.php");
require("../../weixin_oop_api.php");
$appid = APPID;
$appsecret = APPSECRET;
$wx = new WeixinApi($appid,$appsecret);
$redirect_uri = "http://kladz.applinzi.com/zhzg/Order/dinner/menu.php";
$result = $wx->snsapi_userinfo($redirect_uri);
$openid = $result[openid];
?>

<link type="text/css" rel="stylesheet" href="../../public/css/font-awesome.css"/>
<script>
//当页面向下滑动时保持顶部导航条固定不变
window.onscroll = function() {
    var wint = document.documentElement.scrollTop;
    if (wint === 0) wint = document.body.scrollTop;
    var omng = document.getElementById("menu_nav");
    var head = document.getElementById("header");
    if (omng) {
        if (omng.offsetTop < wint - 5) omng.style.position = 'fixed';
        else omng.style.position = 'static';
    }
}
//切换显示
function toggle(o, id, m, l) {
    c = document.getElementById(id);
    if (c.style.display == 'none') {
        c.style.display = '';
    } else {
        c.style.display = 'none';
    }
    return false;
}
function store(){
	
}
</script>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
// 	jQuery.fn.scrollTo = function(speed) {
// 		var targetOffset = $(this).offset().top;
// 		$('html,body').stop().animate({scrollTop: targetOffset}, speed);
// 		return this;
// 	}; 
// 	// use
// 	$("#goheader").click(function(){
// 		$("body").scrollTo(500);
// 		return false;
// 	});	
// 	$("#goend").click(function(){
// 		$("body").scrollTo(500);
// 		$('html,body').stop.animate({scrollTop: targetOffset}, speed);
// 	});
    $("#goheader").click(function() {
        var targetOffset = $("body").offset().top;
        $("html, body").animate({       	
            scrollTop: targetOffset }, {duration: 500,easing: "swing"});
            return false;
    });
    $("#goend").click(function() {
        var targetOffset = $(document).height()-$(window).height();
        $("html, body").animate({       	
            scrollTop: targetOffset }, {duration: 500,easing: "swing"});
            return false;
    });
    $("#a1").click(function() {
        var targetOffset = $("#1").offset().top-55;
        $("html, body").animate({       	
            scrollTop: targetOffset }, {duration: 500,easing: "swing"});
            return false;
    });
    $("#a2").click(function() {
        var targetOffset = $("#2").offset().top-55;
        $("html, body").animate({       	
            scrollTop: targetOffset }, {duration: 500,easing: "swing"});
            return false;
    });
    $("#a3").click(function() {
        var targetOffset = $("#3").offset().top-55;
        $("html, body").animate({       	
            scrollTop: targetOffset }, {duration: 500,easing: "swing"});
            return false;
    });
    $("#a4").click(function() {
        var targetOffset = $("#4").offset().top-55;
        $("html, body").animate({       	
            scrollTop: targetOffset }, {duration: 500,easing: "swing"});
            return false;
    });
    $("#a5").click(function() {
        var targetOffset = $("#5").offset().top-55;
        $("html, body").animate({       	
            scrollTop: targetOffset }, {duration: 500,easing: "swing"});
            return false;
    });
    $("#a6").click(function() {
        var targetOffset = $("#6").offset().top-55;
        $("html, body").animate({       	
            scrollTop: targetOffset }, {duration: 500,easing: "swing"});
            return false;
    });
    $("#a7").click(function() {
        var targetOffset = $("#7").offset().top-55;
        $("html, body").animate({       	
            scrollTop: targetOffset }, {duration: 500,easing: "swing"});
            return false;
    });
    
});
</script>

<body class="bc_f9">
    <div class="topbar">
        <div class="menu_nav">
            <a id="goheader">返回顶部</a><a id="goend">底部</a>
        <a class="more" href="javascript:"><i class="fa fa-list-ul fa-2x" aria-hidden="true" onclick="toggle(this, 'popnav', '', '')"></i></a>
        </div>
    <div id="popnav" class="popnav" style="display: none;">
        <div class="menu_cat">
            <ul>
                <li class="pops"><a id="a1">本店特色</a></li>
                <li class="pops"><a id="a2">炒菜类</a></li>
                <li class="pops"><a id="a3">蔬果类</a></li>
                <li class="pops"><a id="a4">面点类</a></li>
                <li class="pops"><a id="a5">汤羹类</a></li>
                <li class="pops"><a id="a6">主食类</a></li>
                <li class="pops"><a id="a7">酒水</a></li>
            </ul> 
        </div>
    </div>
</div>
  
<div class="menulist">
    <form action="menu_submit.php" method="post">
    <div>
    <ul class="noborder">
        <span class="menu_family" id="1">本店特色<br/></span>
        <?php 
        foreach ($data as $item){
            if($item['category']==1){
        ?>
       <li><div class="menu_item">
            <img src="<?php echo $item['imgurl'];?>" width="150" height="150" border="0" alt="<?php echo $item['name'];?>" />
                <input name="<?php echo $item['id'];?>" type="checkbox" value="<?php echo $item['id'];?>"/><label>
                <span class="menu_item_desc"><?php echo $item['name'];?></span>
                <span class="menu_item_desc"><?php echo $item['price']."元";?></span></label>
            </div>
        </li>
        <?php }}?>
        <span class="menu_family" id="2">炒菜类<br/></span>   
        <?php 
        foreach ($data as $item){
            if($item['category']==2){
        ?> 
            <li><div class="menu_item">
            <img src="<?php echo $item['imgurl'];?>" width="150" height="150" border="0" alt="<?php echo $item['name'];?>" />
                <input name="<?php echo $item['id'];?>" type="checkbox" value="<?php echo $item['id'];?>"/><label>
                <span class="menu_item_desc"><?php echo $item['name'];?></span>
                <span class="menu_item_desc"><?php echo $item['price']."元";?></span></label>
            </div>
        </li> 
        <?php }}?>
        <span class="menu_family" id="3">蔬果类<br/></span>
        <?php 
        foreach ($data as $item){
            if($item['category']==3){
        ?> 
               <li><div class="menu_item">
            <img src="<?php echo $item['imgurl'];?>" width="150" height="150" border="0" alt="<?php echo $item['name'];?>" />
                <input name="<?php echo $item['id'];?>" type="checkbox" value="<?php echo $item['id'];?>"/><label>
                <span class="menu_item_desc"><?php echo $item['name'];?></span>
                <span class="menu_item_desc"><?php echo $item['price']."元";?></span></label>
            </div>
        </li> 
        <?php }}?>
        <span class="menu_family" id="4">面点类<br/></span>
        <?php 
        foreach ($data as $item){
            if($item['category']==4){
        ?> 
            <li><div class="menu_item">
            <img src="<?php echo $item['imgurl'];?>" width="150" height="150" border="0" alt="<?php echo $item['name'];?>" />
                <input name="<?php echo $item['id'];?>" type="checkbox" value="<?php echo $item['id'];?>"/><label>
                <span class="menu_item_desc"><?php echo $item['name'];?></span>
                <span class="menu_item_desc"><?php echo $item['price']."元";?></span></label>
            </div>
        </li> 
        <?php }}?>
        <span class="menu_family" id="5">汤羹类<br/></span>
        <?php 
        foreach ($data as $item){
            if($item['category']==5){
        ?> 
            <li><div class="menu_item">
            <img src="<?php echo $item['imgurl'];?>" width="150" height="150" border="0" alt="<?php echo $item['name'];?>" />
                <input name="<?php echo $item['id'];?>" type="checkbox" value="<?php echo $item['id'];?>"/><label>
                <span class="menu_item_desc"><?php echo $item['name'];?></span>
                <span class="menu_item_desc"><?php echo $item['price']."元";?></span></label>
            </div>
        </li> 
        <?php }}?>
        <span class="menu_family" id="6">主食类<br/></span>
        <?php 
        foreach ($data as $item){
            if($item['category']==6){
        ?> 
            <li><div class="menu_item">
            <img src="<?php echo $item['imgurl'];?>" width="150" height="150" border="0" alt="<?php echo $item['name'];?>" />
                <input name="<?php echo $item['id'];?>" type="checkbox" value="<?php echo $item['id'];?>"/><label>
                <span class="menu_item_desc"><?php echo $item['name'];?></span>
                <span class="menu_item_desc"><?php echo $item['price']."元";?></span></label>
            </div>
        </li>
        <?php }}?>
        <span class="menu_family" id="7">酒水<br/></span>
        <?php 
        foreach ($data as $item){
            if($item['category']==7){
        ?> 
               <li><div class="menu_item">
            <img src="<?php echo $item['imgurl'];?>" width="150" height="150" border="0" alt="<?php echo $item['name'];?>" />
                <input name="<?php echo $item['id'];?>" type="checkbox" value="<?php echo $item['id'];?>"/><label>
                <span class="menu_item_desc"><?php echo $item['name'];?></span>
                <span class="menu_item_desc"><?php echo $item['price']."元";?></span></label>
            </div>
        </li> 
        <?php }}?>
    </ul>
    </div>
    <div align="center">
    <input name="openid" value="<?php echo $openid;?>" type="hidden"/>
    <input type="submit" class="send"/>&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="reset" class="send"/>
    </div>
    </form>
</div>
</body>
</html>