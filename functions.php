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
        case $folder . 'example.php':
            return 'Example Page';
            break;
        case $folder . 'pages/class/index.php':
            return 'Daftar Kelas';
            break;
        case $folder . 'pages/class/add.php':
            return 'Tambah Kelas';
            break;
        case $folder . 'pages/class/edit.php':
            return 'Ubah Kelas';
            break;
        default;
            return;
    }
}

// class
function addClass($data)
{
    global $conn;

    $kelas = htmlspecialchars($data['kelas']);
    $kompetensiKeahlian = htmlspecialchars($data['kompetensiKeahlian']);

    $query = "INSERT INTO kelas VALUES ('','$kelas','$kompetensiKeahlian')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function editClass($data)
{
    global $conn;

    $id = $data['id'];
    $kelas = htmlspecialchars($data['kelas']);
    $kompetensiKeahlian = htmlspecialchars($data['kompetensiKeahlian']);

    $query = "UPDATE kelas SET
                kelas = '$kelas',
                kompetensi_keahlian = '$kompetensiKeahlian'
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
function addUser($data)
{
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $kataSandi = htmlspecialchars($data["kataSandi"]);
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

    mysqli_query($conn, "INSERT INTO pengguna VALUES('', '$nama', '$email', '$kataSandi', '$tingkat')");

    return mysqli_affected_rows($conn);
}

function editUser($data)
{
    global $conn;

    $id = $data["id"];
    $emailLama = $data["emailLama"];
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $kataSandi = htmlspecialchars($data["kataSandi"]);
    $tingkat = htmlspecialchars($data["tingkat"]);

    // cek email
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
            kata_sandi = '$kataSandi',
            tingkat = '$tingkat'
        WHERE id = $id"
    );

    return mysqli_affected_rows($conn);
}


function hapusPetugas($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM tb_pengguna WHERE id = '$id' AND tingkat = 'petugas'");

    return mysqli_affected_rows($conn);
}
