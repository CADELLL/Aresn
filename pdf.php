<?php
$id = $_GET['i'] == '' ? header('Location: error.php') : $_GET['i'];

require 'functions.php';
require_once 'assets/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$pengumuman = query("SELECT * FROM pengumuman WHERE id = $id")[0];

$html = "<style>
        *{
            font-family:  Arial, Helvetica, sans-serif;
            color: #333;
        }
        </style>";

$html .= "<h3>
            SMKN 1 Kepanjen<br>
            Pengumuman " . $pengumuman['judul'] . "
        </h3>
        <hr>
        ";

$html .= "<p style='line-height: 24px;'>
                " . $pengumuman['pembuka'] . "
                <br><br>
                " . $pengumuman['isi'] . "
                <br><br>
                " . $pengumuman['penutup'] . "
                <br><br><br>
            </p>";

$html .= "<div style='margin-left: 70%;'>
                <div style='text-align:center;'>
                    <p>Malang, " . $pengumuman['tanggal'] . "</p>
                    <br><br><br>
                    <hr style='width: 200px;'>
                    <p>Hafid Ardiansyah</p>
                </div>
            </div>
            <br><br><br>
";

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('Pengumuman ' . $pengumuman['judul']);
