<?php

$id = $_GET['i'] == '' ? header('Location: error.php') : $_GET['i'];

require 'functions.php';
require_once 'assets/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$no = 1;

$pengumuman = query("SELECT * FROM pengumuman WHERE id = $id")[0];

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
            Pengumuman
        </h3>
        <hr>
        <br>
        ";

$html .= "
   " . $pengumuman['isi'] . "
";

$html .= "
<div style='margin-left: 70%;'>
    <div style='text-align:center;'>
        <p>Malang, " . $pengumuman['tanggal'] . "</p>
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
$dompdf->stream($pengumuman['judul']);
