<?php
include_once '../model/SaeDB.class.php';
$mysql = SaeDB::getInstance();
$light = $mysql->escape($_POST['light']);
$room_id = '0101';
// $room_id = substr($light,0,4);
$led_living = substr($light,0,1);
$led_toilet = substr($light,1,1);
$led_bedroom = substr($light,2,1);
// $execute = substr($roomServ,9,1);
$sql = "UPDATE `zt_roomstate` SET `led_living`=$led_living,`led_toilet`=$led_toilet,`led_bedroom`=$led_bedroom WHERE room_id='$room_id';";

$mysql->runSql($sql);

if ($mysql->errno() != 0)
{
    die("Error:" . $mysql->errmsg());
}
$mysql->closeDb();