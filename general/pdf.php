<?php
session_start();
// check level
if (isset($_SESSION["payment"])) {
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

$nisn = $_GET['n'] == '' ? header('Location: index.php') : $_GET['n'];
$dompdf = new Dompdf();
$date = date("Y-m-d");

$html = "<style>
    *{
        font-family:  Arial, Helvetica, sans-serif;
    }
    table {
        border-collapse: collapse;
        border-spacing: 10px;
        width: 100%;
        color: #333;
    }
    table td,
    table th {
        border: 1px solid #ddd;
        padding: 12px;
        color: #333;
    }
</style>";

$pembayaran = query("SELECT *,
                        pembayaran.id AS id_pembayaran, 
                        siswa.nama AS nama_siswa FROM pembayaran
                    JOIN siswa ON siswa.nisn = pembayaran.nisn
                    JOIN pengguna ON pengguna.id = pembayaran.id_petugas
                    JOIN spp ON spp.id = pembayaran.id_spp
                    WHERE pembayaran.nisn = $nisn");

$html .= "<h1 style='text-align: center;'>Data Siswa</h1>";

$html .= "<table border='1' cellspacing='0' cellpadding='10' style='margin: auto'>
                <tr>
                    <td colspan='9'>
                        <h2>Daftar Pembayaran</h2>
                        <p>Tanggal: " . $date . "</p>
                    </td>
                </tr>
                <tr>
                    <th>No</th>
                    <th>Petugas</th>
                    <th>Siswa</th>
                    <th>NISN</th>
                    <th>Tanggal</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>SPP</th>
                    <th>Jumlah dibayar</th>
                </tr>";

$i = 1;

foreach ($pembayaran as $p) {
    $html .= "<tr>
                <td>" . $i . "</td>
                <td>" . $p['nama'] . "</td>
                <td>" . $p['nama_siswa'] . "</td>
                <td>" . $p['nisn'] . "</td>        
                <td>" . $p['tanggal_bayar'] . "</td>        
                <td>" . $p['bulan_dibayar'] . "</td>        
                <td>" . $p['tahun_dibayar'] . "</td>        
                <td>" . "Tahun " . $p['tahun'] . "<br>Rp." . rupiah($p['nominal']) . "</td>        
                <td>Rp. " . rupiah($p['jumlah_bayar']) . "</td>        
            </tr>";
    $i++;
}

$html .= "</table>
        </body>
    </html>";

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('daftar-pembayaran-' . $date);
