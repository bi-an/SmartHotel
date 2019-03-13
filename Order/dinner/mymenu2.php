<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=screen-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<link href="../../public/css/styles.css" type="text/css" rel="stylesheet" />

<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
<script type="text/javascript"><br>$(document).ready(function() {
    $("#div1Link").click(function() {
        $("html, body").animate({
            scrollTop: $("#div1").offset().top }, {duration: 500,easing: "swing"});
            return false;
    });
    $("#div2Link").click(function() {
        $("html, body").animate({
            scrollTop: $("#div2").offset().top }, {duration: 500,easing: "swing"});
            return false;
    });
    $("#div3Link").click(function() {
        $("html, body").animate({
            scrollTop: $("#div3").offset().top }, {duration: 500,easing: "swing"});
            return false;
    });
</script>
</head>
<body>

<?php
$title = "您的菜单";
include "../../header.php";
$mysql = SaeDB::getInstance();
$openid = $_GET['openid'];
//获取客户的menuid
$sql = "SELECT menuid FROM  `z_usermenu` WHERE openid = '$openid'";
$data = $mysql->getLine($sql);
$menuid = explode(',', $data['menuid']);

$sql = "SELECT id,name,price FROM  `z_menu` order by id asc";
$data = $mysql->getData($sql);
?>
<div class="menu_title">您的菜单：</div><br/>
<?php
echo "<table>";
echo "<thead><tr><th>序号</th><th>菜名</th><th>价格</th></tr></thead>";
foreach ($menuid as $key=>$id){
    foreach ($data as $item){
        if($item['id'] == $id){
            $number=$key+1;
            echo '<tr><td>'.$number.'</td><td>'.$item['name'].'</td><td>'.$item['price'].'元</td></tr>';
        } 
    }   
}
echo "</table>";
$mysql->closeDb();

echo "<br/><br/>"."如需修改，请按";
?>
&nbsp;<img alt="返回" src="images/finger.png" id="finger">
<button class="send" onclick="javascript :history.back(-1);">返回</button>
</body>
</html>

