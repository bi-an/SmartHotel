<form action='dinner/deletedinner.php' method='post' id='menuform'>

<?php 
$sql = "select id,name,price from z_menu";
$temp = $mysql->getData($sql);
$mysql->closeDb();

//获取菜名
$menu = array();
foreach ($temp as $value){
    $key=$value['id'];
    $menu[$key]=array($value['name'],$value['price']);
}


foreach ($orderlist3 as $order){
    $menuid=array();
    $menuid=explode(',', $order['menuid']);
    
	echo '<div class="d-left-module mt15"><div class="inner m-hotel-overview" id="jxDescTab">';
	echo '<h2 class="facility-title"><span class="fr inform-error">';
	echo "<a class='btn_buy' onClick=\"$('#orderid3').val(".$order["id"].");$('#menuform').submit();\">退订</a></span>";
	echo '订单号：'.$order["id"].'</h2>';
	echo '<table><thead><tr><th>菜名</th><th>价格</th></tr></thead><tbody>';
    foreach ($menuid as $id){
        echo '<tr><td>'.$menu[$id][0].'</td><td>'.$menu[$id][1].'元</td></tr>';   
    }
    echo "</tbody></table></div></div><br/>";
}

if ($mysql->errno() != 0)
{
    die("Error:".$mysql->errmsg());
}

?>
<input type='hidden' name='orderid' id='orderid3'>
</form>