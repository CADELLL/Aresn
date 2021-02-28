<?php
// connection
$conn = mysqli_connect("localhost", "root", "", "spp");

// get url & folder
$url = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$folder = '/spp/';

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
        case $folder . 'pages/class/':
            return 'Daftar Kelas';
            break;
        case $folder . 'pages/class/index.php':
            return 'Daftar Kelas';
            break;
        case $folder . 'pages/class/create.php':
            return 'Tambah Kelas';
            break;
        case $folder . 'pages/class/update.php':
            return 'Ubah Kelas';
            break;
        case $folder . 'pages/users/':
            return 'Daftar Pengguna';
            break;
        case $folder . 'pages/users/index.php':
            return 'Daftar Pengguna';
            break;
        case $folder . 'pages/users/create.php':
            return 'Tambah Pengguna';
            break;
        case $folder . 'pages/users/update.php':
            return 'Ubah Pengguna';
            break;
        default;
            return;
    }
}

// class
function createClass($data)
{
    global $conn;

    $kelas = htmlspecialchars($data['kelas']);
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
    $hasil = mysqli_query($conn, "SELECT email FROM pengguna WHERE email = '$email'");

    if (mysqli_fetch_assoc($hasil)) {
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

    // check nisn from tb nisn
    $tbNisn = mysqli_query($conn, "SELECT nisn FROM nisn WHERE nisn = '$nisn'");

    if (!mysqli_fetch_assoc($tbNisn)) {
        echo "
            <script>
                alert('NISN tidak terdaftar!');
            </script>
            ";
        return false;
    }

    // check nisn student
    $tbSiswa = mysqli_query($conn, "SELECT nisn FROM siswa WHERE nisn = '$nisn'");

    if (mysqli_fetch_assoc($tbSiswa)) {
        echo ("
            <script>
                alert('NISN sudah terdaftar!');
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