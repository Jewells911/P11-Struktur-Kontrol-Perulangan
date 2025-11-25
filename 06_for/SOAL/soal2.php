<?php

$total = 25;           
$jumlah_solusi = 0;    

$x = 1;

while ($x < $total) {

    $y = 1;

    while ($y < $total) {

        // z dihitung langsung
        $z = $total - ($x + $y);

        // valid jika z bilangan asli
        if ($z >= 1) {
            echo "x = $x, y = $y, z = $z <br>";
            $jumlah_solusi++;
        }

        $y++;
    }

    $x++;
}

echo "<br><b>Total penyelesaian: $jumlah_solusi</b>";
?>
