<form action='seat/deleteseat.php' method='post' id='seatform'>


<?php 

foreach ($orderlist2 as $order){
    $locid=$order['locid'];
    $sql = "select Name,Address,Telephone from z_hotel where Id=$locid";
    $hotelinfo = $mysql->getLine($sql);
    
    $item = array(
        "id"=>$order["id"],
        "name"=>$order["name"],
        "num"=>$order["num"],
        "dinertime"=>date("Y-m-d H:i",$order["dinertime"]),
        "fname"=>$hotelinfo['Name'],
        "address"=>$hotelinfo["Address"],
        "telephone"=>$order["phone"],
        "hotelphone"=>$hotelinfo['Telephone']
    );
    $data2[]=$item;
}

if ($mysql->errno() != 0)
{
    die("Error:".$mysql->errmsg());
}
$mysql->closeDb();


foreach ($data2 as $item) {
	echo '<div class="d-left-module mt15"><div class="inner m-hotel-overview" id="jxDescTab">';
	echo '<h2 class="facility-title"><span class="fr inform-error">';
	echo "<a class='btn_buy' onClick=\"$('#orderid2').val(".$item["id"].");$('#seatform').submit();\">退订</a></span>";
	echo '订单号：'.$item["id"].'</h2>';
	echo '<div class="hotel-introduce" id="descContent"><div class="base-info bordertop clrfix">';
	echo '<dl class="inform-list"><dt>预约人：</dt><dd><cite>'.$item["name"].'</cite></dd></dl>';
	echo '<dl class="inform-list"><dt>人      数：</dt><dd><cite>'.$item["num"].'</cite></dd></dl>';
	echo '<dl class="inform-list"><dt>用餐时间：</dt><dd><cite>'.$item["dinertime"].'</cite></dd></dl>';
	echo '<dl class="inform-list"><dt>电      话：</dt><dd><cite>'.$item["telephone"].'</cite></dd></dl>';
	echo '<dl class="inform-list"><dt>分      店：</dt><dd><cite>'.$item["fname"].'</cite></dd></dl>';
	echo '<dl class="inform-list"><dt>地      址：</dt><dd><cite>'.$item["address"].'</cite></dd></dl>';
	echo '<dl class="inform-list"><dt>分店电话：</dt><dd><cite>'.$item["hotelphone"].'</cite></dd></dl>';
	echo '</div></div></div></div>';
}
?>
<input type='hidden' name='orderid' id='orderid2'>
</form>