<?php
session_start();

// check admin
if (!isset($_SESSION["admin"])) {
    echo "
		<script>
            alert('Tidak dapat mengakses fitur ini!');
            window.history.back();
		</script>
		";
    exit;
}

require '../../functions.php';
require_once '../../assets/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$i = 1;
$dompdf = new Dompdf();

$siswa = query("SELECT * FROM siswa 
                JOIN kelas ON siswa.id_kelas = kelas.id
                JOIN spp ON spp.id = siswa.id_spp");
$totalSiswa = query("SELECT * FROM siswa");
$date = date("Y-m-d");
$total = count($totalSiswa);

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
            Daftar Siswa
        </h2>
        <hr>
        <p>
            Tanggal: " . $date . "<br>
            Total: " . $total . "
        </p>";

$html .= "<table border='1' cellspacing='0' cellpadding='10' style='margin: auto'>
                <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>No telepon (+62)</th>
                    <th>SPP</th>
                </tr>";

foreach ($siswa as $s) {
    $html .= "<tr>
                <td>" . $i . "</td>
                <td>" . $s['nisn'] . "</td>
                <td>" . $s['nis'] . "</td>        
                <td>" . $s['nama'] . "</td>
                <td>" . $s['kelas'] . "</td>        
                <td>" . $s['alamat'] . "</td>     
                <td>" . $s['no_telepon'] . "</td>     
                <td>Tahun " . $s['tahun'] . "<br>Nominal Rp. " . rupiah($s['nominal']) . "</td>     
            </tr>";
    $i++;
}

$html .= "</table>
        </body>
    </html>";

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('daftar-siswa-' . $date);
