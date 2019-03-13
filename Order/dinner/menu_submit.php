<?php
$data = $_POST;
$menus = array();
foreach ($data as $key => $value){
    if($key!="openid"){
        $menus[$key] = $value;
    }else {
        $openid = $value;
    }
}
//存储客户菜单的menuid
$menuid = implode(',', $menus);

include_once '../../model/SaeDB.class.php';
$mysql = SaeDB::getInstance();


$sql = "SELECT * FROM  `z_usermenu` where openid = '$openid'";
$exist = $mysql->getData($sql);
if(!!$exist){
    $sql = "UPDATE `z_usermenu` SET menuid='$menuid' WHERE openid = '$openid'";
    $mysql->runSql($sql);
}else{
    $sql = "INSERT INTO `z_usermenu` (openid,menuid) VALUES ('$openid','$menuid')";
    $mysql->runSql($sql);
}
$mysql->closeDb();
$url = "mymenu2.php?openid=".$openid;
echo $url;
header("Location:$url");



