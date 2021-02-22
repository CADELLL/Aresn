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

function rupiah($data)
{
    $hasil = number_format($data, 2, ',', '.');
    return $hasil;
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

    // cek nisn sudah terdaftar apa belum di tabel nisn
    $tbNisn = mysqli_query($koneksi, "SELECT nisn FROM tb_nisn WHERE nisn = '$nisn'");

    if (!mysqli_fetch_assoc($tbNisn)) {
        echo ("<script>
                alert('NISN tidak terdaftar!');
            </script>");
        return false;
    }

    // cek nisn sudah terdfatar apa belum di tabel siswa
    $tbSiswa = mysqli_query($koneksi, "SELECT nisn FROM tb_siswa WHERE nisn = '$nisn'");

    if (mysqli_fetch_assoc($tbSiswa)) {
        echo ("<script>
                alert('NISN sudah terdaftar!');
            </script>");
        return false;
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

    if ($nis !== $nisLama && mysqli_fetch_assoc($hasil)) {
        echo "<script>
                alert('NIS sudah terdaftar');
            </script>";
        return false;
    }

    $query = "UPDATE tb_siswa SET 
                nis = '$nis',
                nama = '$nama',
                id_kelas = '$id_kelas',
                alamat = '$alamat',
                no_telepon = '$no_telepon',
                id_spp = '$id_spp'
            WHERE nisn = $nisn";

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
    $query = "SELECT * FROM tb_siswa JOIN 
                tb_kelas ON tb_siswa.id_kelas = tb_kelas.id 
                WHERE 
                nama LIKE '%$kataKunci%' OR
                nisn LIKE '%$kataKunci%' OR
                nis LIKE '%$kataKunci%' OR
                alamat LIKE '%$kataKunci%' OR
                alamat LIKE '%$kataKunci%' OR
                kelas LIKE '%$kataKunci%' OR
                no_telepon LIKE '%$kataKunci%'";
    return query($query);
}

// Autentikasi

function daftar($data)
{
    global $koneksi;

    $email = htmlspecialchars($data["email"]);
    $kataSandi = htmlspecialchars($data["kata_sandi"]);
    $kataSandi2 = htmlspecialchars($data["kata_sandi2"]);
    $nama = htmlspecialchars($data["nama"]);


    // cek nama_pengguna sudah ada atau belum
    $hasil = mysqli_query($koneksi, "SELECT email FROM tb_pengguna WHERE email = '$email'");

    if (mysqli_fetch_assoc($hasil)) {
        echo "<script>
				alert('Akun sudah terdaftar!')
		      </script>";
        return false;
    }


    // cek konfirmasi kata_sandi
    if ($kataSandi !== $kataSandi2) {
        echo "<script>
				alert('Konfirmasi kata sandi tidak sesuai!');
		      </script>";
        return false;
    }

    // tambahkan userbaru ke database
    mysqli_query($koneksi, "INSERT INTO tb_pengguna VALUES('', '$email', '$kataSandi','$nama', 'siswa')");

    return mysqli_affected_rows($koneksi);
}

// Petugas

function tambahPetugas($data)
{
    global $koneksi;

    $email = htmlspecialchars($data["email"]);
    $kataSandi = htmlspecialchars($data["kata_sandi"]);
    $kataSandi2 = htmlspecialchars($data["kata_sandi2"]);
    $nama = htmlspecialchars($data["nama"]);

    // cek nama_pengguna sudah ada atau belum
    $hasil = mysqli_query($koneksi, "SELECT email FROM tb_pengguna WHERE email = '$email'");

    if (mysqli_fetch_assoc($hasil)) {
        echo "<script>
				alert('Akun sudah terdaftar!')
		      </script>";
        return false;
    }

    // cek konfirmasi kata_sandi
    if ($kataSandi !== $kataSandi2) {
        echo "<script>
				alert('Konfirmasi kata sandi tidak sesuai!');
		    </script>";
        return false;
    }

    // tambahkan userbaru ke database
    mysqli_query($koneksi, "INSERT INTO tb_pengguna VALUES('', '$email', '$kataSandi','$nama', 'petugas')");

    return mysqli_affected_rows($koneksi);
}

function ubahPetugas($data)
{
    global $koneksi;

    $id = $data["id"];
    $email_lama = $data["email_lama"];

    $email = htmlspecialchars($data["email"]);
    $kataSandi = htmlspecialchars($data["kata_sandi"]);
    $kataSandi2 = htmlspecialchars($data["kata_sandi2"]);
    $nama = htmlspecialchars($data["nama"]);


    // cek nama_pengguna sudah ada atau belum
    $hasil = mysqli_query($koneksi, "SELECT email FROM tb_pengguna WHERE email = '$email'");

    if ($email !== $email_lama && mysqli_fetch_assoc($hasil)) {
        echo "<script>
                alert('Akun sudah terdaftar');
            </script>";
        return false;
    }

    // cek konfirmasi kata_sandi
    if ($kataSandi !== $kataSandi2) {
        echo "<script>
                alert('Konfirmasi kata sandi tidak sesuai!');
            </script>";
        return false;
    }

    mysqli_query(
        $koneksi,
        "UPDATE tb_pengguna SET
            email = '$email', 
            kata_sandi = '$kataSandi',
            nama = '$nama'
        WHERE id = $id"
    );

    return mysqli_affected_rows($koneksi);
}


function hapusPetugas($id)
{
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM tb_pengguna WHERE id = '$id' AND tingkat = 'petugas'");
    return mysqli_affected_rows($koneksi);
}


function cariPetugas($kataKunci)
{
    $query = "SELECT * FROM tb_pengguna WHERE 
                nama LIKE '%$kataKunci%' OR
                email LIKE '%$kataKunci%' OR
                kata_sandi LIKE '%$kataKunci%'
            AND tingkat = 'petugas'";
    return query($query);
}


// kelas
function tambahKelas($data)
{
    global $koneksi;

    $kelas = htmlspecialchars($data['nama']);
    $kompetensi_keahlian = htmlspecialchars($data['kompetensi_keahlian']);

    $query = "INSERT INTO tb_kelas VALUES ('','$kelas','$kompetensi_keahlian')";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}


function ubahKelas($data)
{
    global $koneksi;

    $id = $data['id'];
    $kelas = htmlspecialchars($data['nama']);
    $kompetensi_keahlian = htmlspecialchars($data['kompetensi_keahlian']);

    $query = "UPDATE tb_kelas SET 
                kelas = '$kelas',
                kompetensi_keahlian = '$kompetensi_keahlian'
            WHERE id = $id";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function hapusKelas($id)
{
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM tb_kelas WHERE id = '$id'");

    return mysqli_affected_rows($koneksi);
}

function cariKelas($kataKunci)
{
    $query = "SELECT * FROM tb_kelas WHERE 
                kelas LIKE '%$kataKunci%' OR
                kompetensi_keahlian LIKE '%$kataKunci%'";

    return query($query);
}

// pembayaran
function tambahPembayaran($data)
{
    global $koneksi;

    $id_petugas = $data['id_petugas'];
    $nisn = htmlspecialchars($data['nisn']);
    $tanggal_bayar = htmlspecialchars($data['tanggal_bayar']);
    $bulan_dibayar = htmlspecialchars($data['bulan_dibayar']);
    $tahun_dibayar = htmlspecialchars($data['tahun_dibayar']);
    $id_spp = htmlspecialchars($data['id_spp']);
    $jumlah_bayar = htmlspecialchars($data['jumlah_bayar']);

    $hasil = mysqli_query($koneksi, "SELECT nisn FROM tb_siswa WHERE nisn = '$nisn'");

    if (!mysqli_fetch_assoc($hasil)) {
        echo "<script>
				alert('NISN tidak terdaftar!')
		      </script>";
        return false;
    }

    $query = "INSERT INTO tb_pembayaran VALUES ('','$id_petugas','$nisn','$tanggal_bayar','$bulan_dibayar','$tahun_dibayar','$id_spp','$jumlah_bayar')";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}


function cariPembayaran($kataKunci)
{
    $query = "SELECT *, tb_pembayaran.id AS id_pembayaran FROM tb_pembayaran 
                JOIN tb_pengguna ON tb_pengguna.id = tb_pembayaran.id_petugas 
                JOIN tb_spp ON tb_spp.id = tb_pembayaran.id_spp 
                WHERE nisn LIKE '%$kataKunci%' OR
                tanggal_bayar LIKE '%$kataKunci%' OR
                bulan_dibayar LIKE '%$kataKunci%' OR
                tahun_dibayar LIKE '%$kataKunci%' OR
                jumlah_bayar LIKE '%$kataKunci%' OR
                nama LIKE '%$kataKunci%' OR
                tahun LIKE '%$kataKunci%'";
    return query($query);
}

function cariPembayaranSiswa($kataKunci)
{
    $query = "SELECT * FROM tb_pembayaran
                JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn
                WHERE tb_siswa.nisn LIKE '%$kataKunci%' OR
                tanggal_bayar LIKE '%$kataKunci%' OR
                nama LIKE '%$kataKunci%'";
    return query($query);
}

function ubahPembayaran($data)
{
    global $koneksi;

    $id_petugas = $data['id_petugas'];
    $id_pembayaran = $data['id_pembayaran'];
    $nisn_lama = $data['nisn_lama'];
    $nisn = htmlspecialchars($data['nisn']);
    $tanggal_bayar = htmlspecialchars($data['tanggal_bayar']);
    $bulan_dibayar = htmlspecialchars($data['bulan_dibayar']);
    $tahun_dibayar = htmlspecialchars($data['tahun_dibayar']);
    $id_spp = htmlspecialchars($data['id_spp']);
    $jumlah_bayar = htmlspecialchars($data['jumlah_bayar']);

    $hasil = mysqli_query($koneksi, "SELECT nisn FROM tb_nisn WHERE nisn = '$nisn'");

    if ($nisn !== $nisn_lama && mysqli_fetch_assoc($hasil)) {
        echo "<script>
				alert('NISN tidak terdaftar!')
		      </script>";
        return false;
    }

    $query = "UPDATE tb_pembayaran SET
                id_petugas = '$id_petugas',
                nisn = '$nisn',
                tanggal_bayar ='$tanggal_bayar',
                bulan_dibayar = '$bulan_dibayar',
                tahun_dibayar = '$tahun_dibayar',
                id_spp = '$id_spp',
                jumlah_bayar = '$jumlah_bayar'
            WHERE id = $id_pembayaran";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function hapusPembayaran($id)
{
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM tb_pembayaran WHERE id = '$id'");
    return mysqli_affected_rows($koneksi);
}
