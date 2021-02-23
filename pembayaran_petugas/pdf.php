<?php
session_start();

if (!isset($_SESSION["petugas"])) {
    echo "
		<script>
            alert('Tidak dapat mengakses fitur ini!');
            window.history.back();
		</script>
	";
    exit;
}
require '../functions.php';
require_once '../assets/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$pembayaran = query("SELECT *, tb_pembayaran.id AS id_pembayaran FROM tb_pembayaran
                JOIN tb_pengguna ON tb_pengguna.id = tb_pembayaran.id_petugas 
                JOIN tb_spp ON tb_spp.id = tb_pembayaran.id_spp");

$dompdf = new Dompdf();

$html .= "<h1 style='text-align: center;'>Data Siswa</h1>";

$html .= "<table border='1' cellspacing='0' cellpadding='10' style='margin: auto'>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <th>NISN</th>
                    <td>Tanggal</td>
                    <td>Bulan</td>
                    <td>Tahun</td>
                    <td>SPP</td>
                    <td>Jumlah</td>
                </tr>
            </thead>";

$i = 1;

foreach ($pembayaran as $p) {
    $html .= "<tr>
                <td>" . $i . "</td>
                <td>" . $p['nama'] . "</td>
                <td>" . $p['nisn'] . "</td>        
                <td>" . $p['tanggal_bayar'] . "</td>        
                <td>" . $p['bulan_dibayar'] . "</td>        
                <td>" . $p['tahun_dibayar'] . "</td>        
                <td>" . "Tahun " .  $p['tahun'] . "</br>" . "Nominal " . rupiah($p['nominal']) . "</td>        
                <td>" . $p['jumlah_bayar'] . "</td>        
            </tr>";
    $i++;
}

$html .= "</table>
        </body>
    </html>";

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream();
