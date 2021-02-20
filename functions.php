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
    $hasil = mysqli_query($koneksi, "SELECT nisn FROM tb_siswa WHERE nisn = '$nisn'");

    if (mysqli_fetch_assoc($hasil)) {
        return false;
    }

    $query = "INSERT INTO tb_siswa VALUES ('$nisn','$nis','$nama','$id_kelas','$alamat','$no_telepon','$id_spp')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
