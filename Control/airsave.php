<?php
$airid = $_POST['airid'];
$model = $_POST['model']; 
$state = $_POST['state'];
$temp = $_POST['temp'];
$sleep = $_POST['sleep'];
$fan_speed = $_POST['fan_speed'];
$air_swing = $_POST['air_swing'];
//连主库
$link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
mysql_select_db(SAE_MYSQL_DB,$link);

if ($model!=NULL){
    mysql_query("update z_roomair set model = '$model' where air_id = $airid");
}
if ($state!=NULL){
    mysql_query("update z_roomair set state = $state where air_id = $airid");
}
if ($temp!=NULL){
    mysql_query("update z_roomair set temp = $temp where air_id = $airid");
}
if ($sleep!=NULL){
    mysql_query("update z_roomair set sleep = $sleep where air_id = $airid");
}
if ($fan_speed!=NULL){
    mysql_query("update z_roomair set fan_speed = '$fan_speed' where air_id = $airid");
}
if ($air_swing!=NULL){
    mysql_query("update z_roomair set air_swing = '$air_swing' where air_id = $airid");
}

mysql_close($link);

?>