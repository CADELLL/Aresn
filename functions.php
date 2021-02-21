<?php

$koneksi = mysqli_connect("localhost", "root", "", "db_spp");

function query($query)
{
    global $koneksi;

    $hasil = mysqli_query($koneksi, $query);
    $folder = [];

    while ($file = mysqli_fetch_assoc($hasil)) {
        $folder[] = $file;
    }

    return $folder;
}

// Siswa
function tambahSiswa($data)
{
    global $koneksi;

    $nisn = htmlspecialchars($data['nisn']);
    $nis = htmlspecialchars($data['nis']);
    $nama = htmlspecialchars($data['nama']);
    $id_kelas = htmlspecialchars($data['id_kelas']);
    $alamat = htmlspecialchars($data['alamat']);
    $no_telepon = htmlspecialchars($data['no_telepon']);
    $id_spp = htmlspecialchars($data['id_spp']);

    // cek nisn
    $hasil = mysqli_query($koneksi, "SELECT nisn FROM tb_nisn WHERE nisn = '$nisn'");

    if ($nisn !== mysqli_fetch_assoc($hasil)['nisn']) {
        die;
    }

    $query = "INSERT INTO tb_siswa VALUES ('$nisn','$nis','$nama','$id_kelas','$alamat','$no_telepon','$id_spp')";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}


function ubahSiswa($data)
{
    global $koneksi;

    $nisn = htmlspecialchars($data['nisn']);
    $nis = htmlspecialchars($data['nis']);
    $nisLama = htmlspecialchars($data['nisLama']);
    $nama = htmlspecialchars($data['nama']);
    $id_kelas = htmlspecialchars($data['id_kelas']);
    $alamat = htmlspecialchars($data['alamat']);
    $no_telepon = htmlspecialchars($data['no_telepon']);
    $id_spp = htmlspecialchars($data['id_spp']);

    // cek nisn
    $hasil = mysqli_query($koneksi, "SELECT nis FROM tb_siswa WHERE nis = '$nis'");

    // var_dump(mysqli_fetch_assoc($hasil));
    // var_dump($nisLama);
    // var_dump($nis);
    // die;

    if (mysqli_fetch_assoc($hasil)) {
        $nis = $nisLama;
    }

    $query = "UPDATE tb_siswa SET 
                nis = '$nis',
                nama = '$nama',
                id_kelas = '$id_kelas',
                alamat = '$alamat',
                no_telepon = '$no_telepon',
                id_spp = '$id_spp'
                WHERE nisn = $nisn
    ";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function hapusSiswa($nisn)
{
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM tb_siswa WHERE nisn = '$nisn'");
    return mysqli_affected_rows($koneksi);
}

function cariSiswa($kataKunci)
{
    $query = "SELECT * FROM tb_siswa JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id WHERE 
    nama LIKE '%$kataKunci%' OR
    nisn LIKE '%$kataKunci%' OR
    nis LIKE '%$kataKunci%' OR
    alamat LIKE '%$kataKunci%' OR
    alamat LIKE '%$kataKunci%' OR
    kelas LIKE '%$kataKunci%' OR
    no_telepon LIKE '%$kataKunci%'";

    return query($query);
}
