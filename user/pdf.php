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
$pengguna = query("SELECT * FROM pengguna");
$date = date("Y-m-d");
$total = count($pengguna);

$html = "<style>
    *{
        font-family:  Arial, Helvetica, sans-serif;
        color: #333;
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

$html .= "<h3>
                SMKN 1 Kepanjen<br>
                Daftar Pengguna
            </h3>
            <p>
                Tanggal: " . $date . "<br>
                Total: " . $total . "
            </p>";

$html .= "<table border='1' cellspacing='0' cellpadding='10' style='margin: auto'>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Kata sandi</th>
                    <th>Tingkat</th>
                </tr>";

foreach ($pengguna as $p) {
    $html .= "<tr>
                <td>" . $i . "</td>
                <td>" . $p['nama'] . "</td>
                <td>" . $p['email'] . "</td>
                <td>" . $p['kata_sandi'] . "</td>
                <td>" . $p['tingkat'] . "</td>
            </tr>";
    $i++;
}

$html .= "</table>
        </body>
    </html>";

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('daftar-pengguna-' . $date);
