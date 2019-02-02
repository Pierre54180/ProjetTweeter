<?php /* PHP 7 code below​​​​​​​‌‌‌‌​​‌​‌‌‌​​​​​​​‌‌‌​​‌ */?>
<?php
function exists(array $ints, $k) {
    $index = 0;
    echo $index;
    foreach($ints as $ink){
        if($index > 4){
            if($k === $ink){
            return "1";
            }
            else{
                $index++;
        }
    }
    else{
        return "0";
    }
    }
    }

    echo exists($ints, -9) . "\n";  // 1
echo exists($ints, 14) . "\n";  // 1
echo exists($ints, 37) . "\n";  // 1
echo exists($ints, 102) . "\n"; // 1
echo exists($ints, 10000000);   // 0
?>