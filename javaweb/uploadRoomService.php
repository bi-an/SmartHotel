<?php
include_once '../model/SaeDB.class.php';
$mysql = SaeDB::getInstance();
$roomServ = $mysql->escape($_POST['roomServ']);
$room_id = substr($roomServ,0,4);
$sos = substr($roomServ,4,1);
$clean_room = substr($roomServ,5,1);
$silence = substr($roomServ,6,1);
$ask_service = substr($roomServ,7,1);
$check_out = substr($roomServ,8,1);
// $execute = substr($roomServ,9,1);
$sql = "UPDATE `z_roomservice` SET `room_id`='$room_id',`sos`='$sos',`clean_room`='$clean_room',`silence`='$silence',`ask_service`='$ask_service',`check_out`='$check_out' WHERE room_id=$room_id;";

$mysql->runSql($sql);
if ($mysql->errno() != 0)
{
    die("Error:" . $mysql->errmsg());
}
$mysql->closeDb();
