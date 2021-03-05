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

$nisn = $_GET['n'] == '' ? header('Location: index.php') : $_GET['n'];

require '../../functions.php';
require_once '../../assets/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$date = date("d-M-Y");

$no = 1;
$total = 0;
$spp = 0;
$totalBayar = 0;
$pembayaran = query("SELECT *,
                        pembayaran.id AS id_pembayaran, 
                        siswa.nama AS nama_siswa FROM pembayaran
                    JOIN siswa ON siswa.nisn = pembayaran.nisn
                    JOIN pengguna ON pengguna.id = pembayaran.id_petugas
                    JOIN spp ON spp.id = pembayaran.id_spp
                    WHERE pembayaran.nisn = $nisn");

$siswa = query("SELECT * FROM siswa
                    JOIN kelas ON kelas.id = siswa.id_kelas
                    JOIN spp ON spp.id = siswa.id_spp
                    WHERE siswa.nisn = $nisn")[0];

foreach ($pembayaran as $p) {
    $totalBayar += $p['jumlah_bayar'];
}

$spp = $siswa['nominal'];
$total += ($spp * 12) - $spp * count($pembayaran);

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

$html .= "<h3>
            SMKN 1 Kepanjen<br>
            Struktur Pembayaran
        </h3>
        <hr>
        <p>
            NISN : 00" . $siswa['nisn'] . "<br>
            Nama : " . $siswa['nama'] . "<br>
            Kelas : " . $siswa['kelas'] . "<br>
            SPP : Tahun " . $siswa['tahun'] . " Nominal - Rp. " . rupiah($siswa['nominal']) . "
        </p>
        <h3>Daftar Pembayaran</h3>";

$html .= "<table style='margin: auto'>
                <tr>
                    <th>No</th>
                    <th>Petugas</th>
                    <th>Tanggal bayar</th>
                    <th>Bulan dibayar</th>
                    <th>Jumlah bayar</th>
                </tr>";

foreach ($pembayaran as $p) {
    $html .= "<tr>
                <td>" . $no . "</td>
                <td>" . $p['nama'] . "</td>
                <td>" . $p['tanggal_bayar'] . "</td>        
                <td>" . $p['bulan_dibayar'] . "</td>        
                <td>Rp. " . rupiah($p['jumlah_bayar']) . "</td>        
            </tr>";
    $no++;
}
$html .= "<tr>
                <td colspan='2'>Total belum dibayar</td>
                <td>    
                    <p style='font-weight: bold; color: red;'>Rp. " . rupiah($total) . "</p>
                </td>
                <td colspan='1'>Total bayar</td>
                <td>    
                    <p style='font-weight: bold; color: green;'>Rp. " . rupiah($totalBayar) . "</p>
                </td>
            </tr>";

$html .= "
<div style='margin-left: 70%;'>
    <div style='text-align:center;'>
        <p>Malang, " . $date . "</p>
        <br><br><br>
        <hr style='width: 200px;'>
        <p>Hafid Ardiansyah</p>
    </div>
</div>
<br><br><br>
";

$html .= "</table>
            </body>
    </html>";

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream('struktur-pembayaran-' . $date);
