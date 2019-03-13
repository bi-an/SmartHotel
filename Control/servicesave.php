<?php
$roomno = $_POST['roomno'];
$soshelp  = $_POST['soshelp'];
$cleanroom = $_POST['cleanroom'];       
$silence = $_POST['silence'];       
$askservice = $_POST['askservice'];
$checkout = $_POST['checkout'];
//连主库
$link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
mysql_select_db(SAE_MYSQL_DB,$link);

if ($soshelp!=NULL){
    mysql_query("update z_roomservice set sos = $soshelp where room_id = '$roomno'");
}
if ($cleanroom!=NULL){
    mysql_query("update z_roomservice set clean_room = $cleanroom where room_id = '$roomno'");
}
if ($silence!=NULL){
    $sql=mysql_query("update z_roomservice set silence = $silence where room_id ='$roomno'");
}
if ($askservice!=NULL){
    mysql_query("update z_roomservice set ask_service = $askservice where room_id = '$roomno'");
}
if ($checkout!=NULL){
    mysql_query("update z_roomservice set check_out = $checkout where room_id = '$roomno'");
}
mysql_query("update z_roomservice set execute = 1 where room_id = '$roomno'");

mysql_close($link);

?>