<form method="post">
    Saldo Awal: 
    <input type="number" name="saldo_awal" required><br><br>

    Jangka Waktu (N bulan):
    <input type="number" name="jangka_waktu" required><br><br>

    <input type="submit" value="Hitung Saldo Akhir">
</form>

<?php

function hitungBungaBulanan($saldo) {
    // rate tahunan sesuai ketentuan PDF
    $rate_tahunan = ($saldo < 1100000) ? 0.03 : 0.04;
    return ($rate_tahunan / 12) * $saldo;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $saldo_awal     = (float) $_POST['saldo_awal'];
    $jangka_waktu   = (int) $_POST['jangka_waktu'];
    $biaya_admin    = 9000;

    // saldo yang akan dihitung
    $saldo = $saldo_awal;

    echo "<h3>Rincian Perhitungan</h3>";
    echo "<table border='1' cellpadding='6' cellspacing='0'>
            <tr>
                <th>Bulan</th>
                <th>Bunga</th>
                <th>Biaya Admin</th>
                <th>Saldo Akhir Bulan</th>
            </tr>";

    for ($bulan = 1; $bulan <= $jangka_waktu; $bulan++) {

        // Hitung bunga bulanan berdasarkan aturan PDF
        $bunga = hitungBungaBulanan($saldo);

        // Tambah bunga lalu kurangi admin
        $saldo = $saldo + $bunga - $biaya_admin;

        echo "<tr>
                <td align='center'>$bulan</td>
                <td>Rp " . number_format($bunga, 0, ',', '.') . "</td>
                <td>Rp " . number_format($biaya_admin, 0, ',', '.') . "</td>
                <td>Rp " . number_format($saldo, 0, ',', '.') . "</td>
             </tr>";
    }

    echo "</table><br>";

    echo "<h3>Saldo akhir setelah $jangka_waktu bulan adalah:</h3>";
    echo "<b>Rp " . number_format($saldo, 0, ',', '.') . "</b>";
}
?>
