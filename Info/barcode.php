<?php
    $barcode = $_GET['barcode'];
    
    require '../lib/common.func.php';
    $barcode = new BarCode128($barcode);
    $barcode->createBarCode();
?>