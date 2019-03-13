<?php
class RandChar{

  function getRandChar($length){
   $str = null;
   $strPol = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
   $strPol1 = "0123456789";
   $max = strlen($strPol)-1;
   $max1 = strlen($strPol1)-1;

   for($i=0;$i<5;$i++){
    $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
   }
   
   for($i=5;$i<$length;$i++){
       $str.=$strPol1[rand(0,$max1)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
   }

   return $str;
  }
 }

 $randCharObj = new RandChar();
$word=array($randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15));
$word1=array($randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15));
$word2=array($randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15));
$word3=array($randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15));
$word4=array($randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15));
$word15=array($randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15));
$word6=array($randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15));
$word7=array($randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15),$randCharObj->getRandChar(15));
print_r($word);echo "<br />";
// print_r($word1);echo "<br />";
// print_r($word2);echo "<br />";
// print_r($word3);echo "<br />";
// print_r($word4);echo "<br />";
// print_r($word5);echo "<br />";
// print_r($word6);echo "<br />";
// print_r($word7);echo "<br />";

?>