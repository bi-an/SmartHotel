<?php
$result = $_POST['result'];
$openid = $_POST['openid'];
$name = $_POST['name'];
$sex = $_POST['sex'];
$birthday = date("Y-m-d",strtotime($_POST['birthday']));
if($sex==null){
    $sex = 0;
}
$telephone = $_POST['telephone'];
$address = $_POST['address'];
$barcode = $_POST['barcode'];

$link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
mysql_select_db(SAE_MYSQL_DB,$link);
$sql = mysql_query("select * from z_member where openid = '$openid' ",$link);
$data = mysql_fetch_array($sql);
if (!$data){
    $sql = mysql_query("insert into z_member (openid,name,sex,telephone,barcode,address,birthday) values ('$openid','$name',$sex,'$telephone','$barcode','$address','$birthday')",$link);
}else {
   $sql = mysql_query("update z_member set name='$name',sex=$sex,telephone='$telephone',address='$address',birthday='$birthday' where openid='$openid'");
}

mysql_close($link);

echo '<form id="post_form" action="member.php" method="post">
      <input type="hidden" name="result" value='.$result.'></form>';
echo '<script type="text/javascript" src="../public/js/jquery-3.2.0.js"></script>';
echo "<script type='text/javascript'>$('#post_form').submit();</script>";
