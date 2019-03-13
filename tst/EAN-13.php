<?php
//class testinfo{
function UPCAbarcode($code) {
    $trans_code = $code;
    $lw = 2.2; $hi = 40;
    $Lencode = array('0001101','0011001','0010011','0111101','0100011',
        '0110001','0101111','0111011','0110111','0001011');
    $Rencode = array('1110010','1100110','1101100','1000010','1011100',
        '1001110','1010000','1000100','1001000','1110100');
    $ends = '101'; $center = '01010';
    /* Compute the EAN-13 Checksum digit */
    $ncode = '0'.$code;
    $even = 0; $odd = 0;
    for ($x=0;$x<12;$x++) {
        if ($x % 2) {
            $odd += $ncode[$x];
        } else { $even += $ncode[$x];
        }
    }
    $code.=(10 - (($odd * 3 + $even) % 10)) % 10;
    /* Create the bar encoding using a binary string */
    $bars=$ends;
    $bars.=$Lencode[$code[0]];

    for($x=1;$x<6;$x++) {
        $bars.=$Lencode[$code[$x]];
    }
    $bars.=$center;
    for($x=6;$x<12;$x++) {
        $bars.=$Rencode[$code[$x]];
    }
    $bars.=$ends;
    /* Generate the Barcode Image */
    $img = ImageCreate($lw*75+30,$hi-3);   // 95
    $fg = ImageColorAllocate($img, 0, 0, 0);
    $bg = ImageColorAllocate($img, 255, 255, 255);
    ImageFilledRectangle($img, 0, 0, $lw*75+30, $hi+30, $bg);
    $shift=10;
    for ($x=0;$x<strlen($bars);$x++) {
        if (($x<0) || ($x>=45 && $x<46) || ($x >=85)) {
            $sh=10;
        } else { $sh=0;
        }
        if ($bars[$x] == '1') {
            $color = $fg;
        } else { $color = $bg;
        }
        ImageFilledRectangle($img, ($x*$lw)+15,5,($x+1)*$lw+14,$hi+5+$sh,$color);
    }
    /* Add the Human Readable Label */
    ImageString($img,4,5,$hi-5,$code[0],$fg);
    for ($x=0;$x<5;$x++) {
        ImageString($img,5,$lw*(13+$x*6)+15,$hi+5,$code[$x+1],$fg);
        ImageString($img,5,$lw*(53+$x*6)+15,$hi+5,$code[$x+6],$fg);
    }
    ImageString($img,4,$lw*95-7,$hi,$code[11],$fg);
    /* Output the Header and Content. */
    header("Content-Type: image/png");
    ImagePNG($img);
}
//}
echo UPCAbarcode('EA201212070099');