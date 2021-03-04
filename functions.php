<?php
// connection
$conn = mysqli_connect("localhost", "root", "", "db_spp_88");

// get url & folder
$url = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$folder = '/spp_88/';

// function query for query sintaks SQL
function query($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// active menu sidebar
function activeMenu($file)
{
    global $url, $folder;

    return $url == $folder . $file ? 'active' : '';
}

// dynamic title
function dynamicTitle()
{
    global $folder;

    $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

    switch ($url) {
        case $folder . 'index.php':
            return 'Dashboard';
            break;
        case $folder . 'student.php':
            return 'Dashboard Siswa';
            break;
        case $folder . 'admin.php':
            return 'Dashboard Admin';
            break;
        case $folder . 'officer.php':
            return 'Dashboard Petugas';
            break;
        case $folder . 'class/':
            return 'Daftar Kelas';
            break;
        case $folder . 'class/index.php':
            return 'Daftar Kelas';
            break;
        case $folder . 'class/create.php':
            return 'Tambah Kelas';
            break;
        case $folder . 'class/update.php':
            return 'Ubah Kelas';
            break;
        case $folder . 'student/':
            return 'Daftar Siswa';
            break;
        case $folder . 'student/index.php':
            return 'Daftar Siswa';
            break;
        case $folder . 'student/create.php':
            return 'Tambah Siswa';
            break;
        case $folder . 'student/update.php':
            return 'Ubah Siswa';
            break;
        case $folder . 'student/detail.php':
            return 'Detail Siswa';
            break;
        case $folder . 'user/':
            return 'Daftar Pengguna';
            break;
        case $folder . 'user/index.php':
            return 'Daftar Pengguna';
            break;
        case $folder . 'user/create.php':
            return 'Tambah Pengguna';
            break;
        case $folder . 'user/update.php':
            return 'Ubah Pengguna';
            break;
        case $folder . 'payment/':
            return 'Daftar Pembayaran';
            break;
        case $folder . 'payment/index.php':
            return 'Daftar Pembayaran';
            break;
        case $folder . 'payment/create.php':
            return 'Tambah Pembayaran';
            break;
        case $folder . 'payment/update.php':
            return 'Ubah Pembayaran';
            break;
        case $folder . 'payment/detail.php':
            return 'Detail Pembayaran';
            break;
        case $folder . 'donation/':
            return 'Daftar SPP';
            break;
        case $folder . 'donation/index.php':
            return 'Daftar SPP';
            break;
        case $folder . 'donation/create.php':
            return 'Tambah SPP';
            break;
        case $folder . 'donation/update.php':
            return 'Ubah SPP';
            break;
        case $folder . 'general/':
            return 'Daftar Pembayaran';
            break;
        case $folder . 'general/index.php':
            return 'Daftar Pembayaran';
            break;
        case $folder . 'general/detail.php':
            return 'Detail Pembayaran';
            break;
        default;
            return;
    }
}

// convert money to rupiah
function rupiah($money)
{
    return number_format($money, 2, ',', '.');
}

// month
function month()
{
    $month = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];
    return $month;
}

// departement
function departement()
{
    $departement = [
        'Rekayasa Perangkat Lunak',
        'Teknik Komputer dan Jaringan',
        'Teknik Elektronika Industri',
        'Teknik Kendarangan Ringan',
        'Teknik Sepeda Motor',
    ];
    return $departement;
}

// pagination
function queryPagination($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);

    return mysqli_num_rows($result);
}

function startNumber($activePage, $link)
{
    if ($activePage > $link) {
        return $activePage - $link;
    }
    return 1;
}

function endNumber($activePage, $link, $totalPage)
{
    if ($activePage < ($totalPage - $link)) {
        return $activePage + $link;
    }
    return $totalPage;
}

function numberData($limit, $curretPage)
{
    return 1 + ($limit * ($curretPage - 1));
}

// class
function createClass($data)
{
    global $conn;

    $kelas = htmlspecialchars($data["kelas"]);
    $kompetensi_keahlian = htmlspecialchars($data['kompetensi_keahlian']);

    $query = "INSERT INTO kelas VALUES ('','$kelas','$kompetensi_keahlian')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updateClass($data)
{
    global $conn;

    $id = $data['id'];
    $kelas = htmlspecialchars($data['kelas']);
    $kompetensi_keahlian = htmlspecialchars($data['kompetensi_keahlian']);

    $query = "UPDATE kelas SET
                    kelas = '$kelas',
                    kompetensi_keahlian = '$kompetensi_keahlian'
                WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deleteClass($id)
{
    global $conn;

    $query = "DELETE FROM kelas WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// users
function createUser($data)
{
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $kata_sandi = htmlspecialchars($data["kata_sandi"]);
    $tingkat = htmlspecialchars($data["tingkat"]);

    // check email
    $result = mysqli_query($conn, "SELECT email FROM pengguna WHERE email = '$email'");

    if (mysqli_fetch_assoc($result)) {
        echo "
            <script>
				alert('Akun sudah terdaftar!')
		    </script>
            ";
        return false;
    }

    mysqli_query($conn, "INSERT INTO pengguna VALUES('', '$nama', '$email', '$kata_sandi', '$tingkat')");

    return mysqli_affected_rows($conn);
}

function updateUser($data)
{
    global $conn;

    $id = $data["id"];
    $emailLama = $data["emailLama"];
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $kata_sandi = htmlspecialchars($data["kata_sandi"]);
    $tingkat = htmlspecialchars($data["tingkat"]);

    // check email
    $result = mysqli_query($conn, "SELECT email FROM pengguna WHERE email = '$email'");

    if ($email !== $emailLama && mysqli_fetch_assoc($result)) {
        echo "
            <script>
                alert('Akun sudah terdaftar');
            </script>
            ";
        return false;
    }


    mysqli_query(
        $conn,
        "UPDATE pengguna SET
            nama = '$nama',
            email = '$email', 
            kata_sandi = '$kata_sandi',
            tingkat = '$tingkat'
        WHERE id = $id"
    );

    return mysqli_affected_rows($conn);
}


function deleteUser($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM pengguna WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// Student
function createStudent($data)
{
    global $conn;

    $nisn = htmlspecialchars($data['nisn']);
    $nis = htmlspecialchars($data['nis']);
    $nama = htmlspecialchars($data['nama']);
    $id_kelas = htmlspecialchars($data['id_kelas']);
    $alamat = htmlspecialchars($data['alamat']);
    $no_telepon = htmlspecialchars($data['no_telepon']);
    $id_spp = htmlspecialchars($data['id_spp']);

    // check no nisn
    $strNisn = strlen((string)$nisn);
    if ($strNisn < 8) {
        echo "
            <script>
                alert('NISN minimum 8 karakter');
            </script>
            ";
        return false;
    }

    // check nis
    $strNis = strlen((string)$nis);
    if ($strNis < 4) {
        echo "
            <script>
                alert('NIS minimum 4 karakter');
            </script>
            ";
        return false;
    }

    // check no telepon
    $strNoTlp = strlen((string)$no_telepon);
    if ($strNoTlp < 10) {
        echo "
            <script>
                alert('No telepon minimum 10 karakter');
            </script>
            ";
        return false;
    }

    // check nisn from tb nisn
    $resultNisn = mysqli_query($conn, "SELECT nisn FROM nisn WHERE nisn = '$nisn'");

    if (!mysqli_fetch_assoc($resultNisn)) {
        echo "
            <script>
                alert('NISN tidak terdaftar!');
            </script>
            ";
        return false;
    }

    // check nisn student
    $resultStudent = mysqli_query($conn, "SELECT nisn FROM siswa WHERE nisn = '$nisn'");

    if (mysqli_fetch_assoc($resultStudent)) {
        echo ("
            <script>
                alert('NISN sudah terdaftar!');
            </script>
            ");
        return false;
    }

    $resultStudentNis = mysqli_query($conn, "SELECT nis FROM siswa WHERE nis = '$nis'");

    if (mysqli_fetch_assoc($resultStudentNis)) {
        echo ("
            <script>
                alert('NIS sudah terdaftar!');
            </script>
            ");
        return false;
    }


    $query = "INSERT INTO siswa VALUES ('$nisn','$nis','$nama','$id_kelas','$alamat','$no_telepon','$id_spp')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function updateStudent($data)
{
    global $conn;

    $nisLama = $data['nisLama'];
    $nisnLama = $data['nisnLama'];
    $nisn = htmlspecialchars($data['nisn']);
    $nis = htmlspecialchars($data['nis']);
    $nama = htmlspecialchars($data['nama']);
    $id_kelas = htmlspecialchars($data['id_kelas']);
    $alamat = htmlspecialchars($data['alamat']);
    $no_telepon = htmlspecialchars($data['no_telepon']);
    $id_spp = htmlspecialchars($data['id_spp']);

    // check no nisn
    $strNisn = strlen((string)$nisn);
    if ($strNisn < 8) {
        echo "
                <script>
                    alert('NISN minimum 8 karakter');
                </script>
                ";
        return false;
    }

    // check nis
    $strNis = strlen((string)$nis);
    if ($strNis < 4) {
        echo "
         <script>
             alert('NIS minimum 4 karakter');
         </script>
         ";
        return false;
    }

    // check no telepon
    $strNoTlp = strlen((string)$no_telepon);
    if ($strNoTlp < 10) {
        echo "
            <script>
                alert('No telepon minimum 10 karakter');
            </script>
            ";
        return false;
    }

    // check nisn from tb nisn
    $resultTbNisn = mysqli_query($conn, "SELECT nisn FROM nisn WHERE nisn = '$nisn'");

    if (!mysqli_fetch_assoc($resultTbNisn)) {
        echo "
            <script>
                alert('NISN tidak terdaftar');
            </script>
            ";
        return false;
    }

    // check nisn student
    $resultNisn = mysqli_query($conn, "SELECT nisn FROM siswa WHERE nis = '$nis'");

    if ($nisn !== $nisnLama && mysqli_fetch_assoc($resultNisn)) {
        echo "
            <script>
                alert('NISN sudah terdaftar');
            </script>
            ";
        return false;
    }

    // check nis student
    $resultNis = mysqli_query($conn, "SELECT nis FROM siswa WHERE nis = '$nis'");

    if ($nis !== $nisLama && mysqli_fetch_assoc($resultNis)) {
        echo "
            <script>
                alert('NIS sudah terdaftar');
            </script>
            ";
        return false;
    }

    $query = "UPDATE siswa SET 
                nis = '$nis',
                nama = '$nama',
                id_kelas = '$id_kelas',
                alamat = '$alamat',
                no_telepon = '$no_telepon',
                id_spp = '$id_spp'
            WHERE nisn = $nisn";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function deleteStudent($nisn)
{
    global $conn;

    $query = "DELETE FROM siswa WHERE nisn = $nisn";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Spp
function createDonation($data)
{
    global $conn;

    $tahun = htmlspecialchars($data['tahun']);
    $nominal = htmlspecialchars($data['nominal']);

    $query = "INSERT INTO spp VALUES ('','$tahun','$nominal')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updateDonation($data)
{
    global $conn;

    $id = $data['id'];
    $tahun = htmlspecialchars($data['tahun']);
    $nominal = htmlspecialchars($data['nominal']);

    $query = "UPDATE spp SET
                    tahun = '$tahun',
                    nominal = '$nominal'
                WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deleteDonation($id)
{
    global $conn;

    $query = "DELETE FROM spp WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// payment 
function createPayment($data)
{
    global $conn;

    $id_petugas = $_SESSION['id'];
    $nisn = htmlspecialchars($data['nisn']);
    $tanggal_bayar = date("Y-m-d H:i:s");
    $bulan_dibayar = htmlspecialchars($data['bulan_dibayar']);
    $jumlah_bayar = htmlspecialchars($data['jumlah_bayar']);

    // check nisn
    $resultSiswa = mysqli_query($conn, "SELECT nisn FROM siswa WHERE nisn = '$nisn'");

    if (!mysqli_fetch_assoc($resultSiswa)) {
        echo "
            <script>
                alert('NISN tidak terdaftar!')
            </script>
            ";
        return false;
    }

    $resultSpp = query("SELECT * FROM siswa JOIN spp ON siswa.id_spp = spp.id WHERE nisn = '$nisn'")[0];
    $id_spp = (int)$resultSpp['id_spp'];
    $tahun_dibayar = $resultSpp['tahun'];

    $resultMonth = mysqli_query($conn, "SELECT * FROM pembayaran WHERE nisn = '$nisn' ");

    // check month
    foreach ($resultMonth as $rm) {
        if ($rm['bulan_dibayar'] == $bulan_dibayar) {
            echo "<script>
                    alert('Anda sudah membayar SPP bulan $bulan_dibayar')
                </script>
                ";
            return false;
        }
    }

    $nominal = (int)$resultSpp['nominal'];

    // check jumlah bayar
    if ((int)$jumlah_bayar < $nominal) {
        $rupiah = rupiah($nominal);
        echo "
            <script>
				alert('Nominal kurang dari Rp. $rupiah')
            </script>
            ";
        return false;
    }

    $query = "INSERT INTO pembayaran VALUES ('','$id_petugas','$nisn','$tanggal_bayar','$bulan_dibayar','$tahun_dibayar','$id_spp','$jumlah_bayar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updatePayment($data)
{
    global $conn;

    $id_petugas = $data['id_petugas'];
    $bulan_lama = $data['bulan_lama'];
    $id_pembayaran = $data['id_pembayaran'];
    $nisn_lama = $data['nisn_lama'];
    $nisn = htmlspecialchars($data['nisn']);
    $bulan_dibayar = htmlspecialchars($data['bulan_dibayar']);
    $jumlah_bayar = htmlspecialchars($data['jumlah_bayar']);

    $resultId = query("SELECT * FROM pembayaran WHERE id = '$id_pembayaran'")[0];

    if ($resultId['id_petugas'] !== $id_petugas) {
        echo "
            <script>
				alert('Akun tidak sesuai!')
                document.location.href = 'index.php';
		    </script>
            ";
        return false;
    }


    // check nisn
    $resultNisn = mysqli_query($conn, "SELECT nisn FROM siswa WHERE nisn = '$nisn'");

    if ($nisn !== $nisn_lama && !mysqli_fetch_assoc($resultNisn)) {
        echo "
            <script>
				alert('NISN tidak terdaftar!')
		    </script>
            ";
        return false;

        // check bulan
        $resultMonth = mysqli_query($conn, "SELECT bulan_dibayar FROM pembayaran WHERE nisn = '$nisn'");

        foreach ($resultMonth as $rm) {
            if ($rm['bulan_dibayar'] == $bulan_dibayar) {
                echo "
                <script>
                    alert('Siswa sudah membayar SPP bulan $bulan_dibayar')
                </script>
                ";
                return false;
            }
        }
    }

    // check bulan
    $resultMonth = mysqli_query($conn, "SELECT bulan_dibayar FROM pembayaran WHERE nisn = '$nisn'");

    foreach ($resultMonth as $rm) {
        if ($bulan_dibayar !== $bulan_lama && $rm['bulan_dibayar'] == $bulan_dibayar) {
            echo "
                <script>
                    alert('Siswa sudah membayar SPP bulan $bulan_dibayar')
                </script>
                ";
            return false;
        }
    }

    // check nominal
    $resultSpp = query("SELECT * FROM siswa JOIN spp ON siswa.id_spp = spp.id WHERE nisn = '$nisn_lama'")[0];
    $nominal = $resultSpp['nominal'];

    if ((int)$jumlah_bayar < $nominal) {
        $rupiah = rupiah($nominal);
        echo "
             <script>
                 alert('Nominal kurang dari Rp. $rupiah')
             </script>
             ";
        return false;
    }

    $query = "UPDATE pembayaran 
                SET
                    id_petugas = '$id_petugas',
                    nisn = '$nisn',
                    bulan_dibayar = '$bulan_dibayar',
                    jumlah_bayar = '$jumlah_bayar'
                WHERE id = $id_pembayaran";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deletePayment($id)
{
    global $conn;

    $id_petugas = $_SESSION['id'];

    $resultId = query("SELECT * FROM pembayaran WHERE id = '$id'")[0];

    if ($resultId['id_petugas'] !== $id_petugas) {
        echo "
            <script>
				alert('Akun tidak sesuai!')
                document.location.href = 'index.php';
		    </script>
            ";
        return false;
    }

    mysqli_query($conn, "DELETE FROM pembayaran WHERE id = '$id'");

    return mysqli_affected_rows($conn);
}
