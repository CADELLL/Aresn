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

require '../functions.php';
require_once '../assets/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$i = 1;
$dompdf = new Dompdf();
$kelas = query("SELECT * FROM kelas");
$date = date("Y-m-d");
$total = count($kelas);

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
                Daftar Kelas
            </h2>
            <hr>
            <p>
                Tanggal: " . $date . "<br>
                Total: " . $total . "
            </p>";

$html .= "<table border='1' cellspacing='0' cellpadding='10' style='margin: auto'>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kompetensi keahlian</th>
                </tr>";

foreach ($kelas as $k) {
    $html .= "<tr>
                <td>" . $i . "</td>
                <td>" . $k['kelas'] . "</td>
                <td>" . $k['kompetensi_keahlian'] . "</td>
            </tr>";
    $i++;
}

$html .= "</table>
        </body>
    </html>";

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('daftar-kelas-' . $date);
