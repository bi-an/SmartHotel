<form action='room/deleteroom.php' method='post' id='roomform'>

<?php 

foreach ($orderlist as $order){
    $item = array();
    $roomid = $order["RoomId"];
    $sql = "select * from z_room where Id =$roomid";
    $room = $mysql->getLine($sql);

    $hotelid= $room["HotelId"];
    $sql = "select * from z_hotel where Id =$hotelid";
    $hotelinfo=$mysql->getLine($sql);

    $item = array(
        "id"=>$order["Id"],
        "hotelname"=>$hotelinfo["Name"],
        "date"=>$order["Time"],
        "count"=>$order["Count"],
        "price"=>$order["Price"],
        "total"=>$order["Total"],
        "address"=>$hotelinfo["Address"],
        "telephone"=>$hotelinfo["Telephone"],
        "type"=>$room["Type"]
    );
    $data[]=$item;
}

if ($mysql->errno() != 0)
{
    die("Error:".$mysql->errmsg());
}
$mysql->closeDb();



foreach ($data as $item) {
	echo '<div class="d-left-module mt15"><div class="inner m-hotel-overview" id="jxDescTab">';
	echo '<h2 class="facility-title"><span class="fr inform-error">';
	echo "<a class='btn_buy' onClick=\"$('#orderid').val(".$item["id"].");$('#roomform').submit();\">退订</a></span>";
	echo '订单号：'.$item["id"].'</h2>';
	echo '<div class="hotel-introduce" id="descContent"><div class="base-info bordertop clrfix">';
	echo '<dl class="inform-list"><dt>酒   店：</dt><dd><cite>'.$item["hotelname"].'</cite></dd></dl>';
	echo '<dl class="inform-list"><dt>房   型：</dt><dd><cite>'.$item["type"].'</cite></dd></dl>';
	echo '<dl class="inform-list"><dt>入住日期：</dt><dd><cite>'.$item["date"].'</cite></dd></dl>';
	echo '<dl class="inform-list"><dt>价   格：</dt><dd><cite>'.$item["price"].'</cite></dd></dl>';
	echo '<dl class="inform-list"><dt>数   量：</dt><dd><cite>'.$item["count"].'</cite></dd></dl>';
	echo '<dl class="inform-list"><dt>总   额：</dt><dd><cite>'.$item["total"].'</cite></dd></dl>';
	echo '<dl class="inform-list"><dt>电   话：</dt><dd><cite><a href="tel:'.$item["telephone"].'">'.$item["telephone"].'</a></cite></dd></dl>';
	echo '<dl class="inform-list"><dt>地   址：</dt><dd><cite>'.$item["address"].'</cite></dd></dl>';
	echo '</div></div></div></div>';
}
?>
<input type='hidden' name='orderid' id='orderid'>
</form>
