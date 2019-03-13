<?php
include_once '../model/SaeDB.class.php';
$mysql = SaeDB::getInstance();
$roomState = $mysql->escape($_POST['roomState']);
$array = explode(",", $roomState);
$room_id = $array[0];
$door = $array[1];
$card = $array[2];
$safebox = $array[3];
$curtain = $array[4];
$bathtub = $array[5];
$led_living = $array[6];
$led_toilet = $array[7];
$led_bedroom = $array[8];
$led_bedside = $array[9];
$led_entrance = $array[10];
$air_id = $array[11];
$state = $array[12];
$model = $array[13];
$sleep = $array[14];
$temp = $array[15];
$fan_speed = $array[16];
$air_swing = $array[17];

$sql1 = "update z_roomstate set door=$door,card=$card,safebox=$safebox,curtain=$curtain,
    bathtub=$bathtub,led_living=$led_living,led_toilet=$led_toilet,led_bedroom=$led_bedroom,
    led_bedside=$led_bedside,led_entrance=$led_entrance,air_id='$air_id' 
    where room_id='$room_id'";
$sql2 = "update z_roomair set state=$state,model='$model',sleep=$sleep,temp=$temp,
    fan_speed='$fan_speed',air_swing='$air_swing' 
    where air_id='$air_id'";
    
$mysql->runSql($sql1);
$mysql->runSql($sql2);

if ($mysql->errno() != 0)
{
    die("Error:" . $mysql->errmsg());
}
$mysql->closeDb();
    
