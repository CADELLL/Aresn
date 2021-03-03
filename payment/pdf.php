<?php
session_start();

// check payment
if (!isset($_SESSION["payment"])) {
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

$totalPembayaran = query("SELECT * FROM pembayaran");
$pembayaran = query("SELECT *,
                        pembayaran.id AS id_pembayaran, 
                        siswa.nama AS nama_siswa FROM pembayaran
                    JOIN siswa ON siswa.nisn = pembayaran.nisn
                    JOIN pengguna ON pengguna.id = pembayaran.id_petugas
                    JOIN spp ON spp.id = pembayaran.id_spp");

$i = 1;
$dompdf = new Dompdf();
$date = date("Y-m-d");
$total = count($totalPembayaran);

$html = "<style>
    *{
        font-family:  Arial, Helvetica, sans-serif;
        color: #333;
    }
    table {
        border-collapse: collapse;
        border-spacing: 10px;
        width: 100%;
    }
    table td,
    table th {
        border: 1px solid #333;
        padding: 12px;
    }
</style>";

$html .= "<h2>
                SMKN 1 Kepanjen<br>
                Daftar Pembayaran
            </h2>
            <hr>
            <p>
                Tanggal: " . $date . "<br>
                Total: " . $total . "
            </p>";

$html .= "<table border='1' cellspacing='0' cellpadding='10' style='margin: auto'>
                <tr>
                    <th>No</th>
                    <th>Petugas</th>
                    <th>Siswa</th>
                    <th>NISN (+00)</th>
                    <th>Tanggal</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>SPP</th>
                    <th>Jumlah bayar</th>
                </tr>";

foreach ($pembayaran as $p) {
    $html .= "<tr>
                <td>" . $i . "</td>
                <td>" . $p['nama'] . "</td>
                <td>" . $p['nama_siswa'] . "</td>
                <td>" . $p['nisn'] . "</td>        
                <td>" . $p['tanggal_bayar'] . "</td>        
                <td>" . $p['bulan_dibayar'] . "</td>        
                <td>" . $p['tahun_dibayar'] . "</td>        
                <td>" . "Tahun" .  $p['tahun'] . "<br>Rp. " . rupiah($p['nominal']) . "</td>        
                <td style='font-weight: bold; color: green;'>" . "Rp. " . rupiah($p['jumlah_bayar']) . "</td>        
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
