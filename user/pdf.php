<?php
session_start();

if (isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}
if (isset($_SESSION["petugas"])) {
    header("Location: petugas.php");
    exit;
}
require '../functions.php';
require_once '../assets/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$nisn = $_GET['n'];
$pembayaran = query("SELECT * FROM tb_pembayaran
                    JOIN tb_pengguna ON tb_pengguna.id = tb_pembayaran.id_petugas 
                    JOIN tb_spp ON tb_spp.id = tb_pembayaran.id_spp
                    WHERE tb_pembayaran.nisn = $nisn");

$dompdf = new Dompdf();

$html .= "<h1 style='text-align: center;'>Detail pembayaran</h1>";

$html .= "<table border='1' cellspacing='0' cellpadding='10' style='margin: auto'>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <td>NISN</td>
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
