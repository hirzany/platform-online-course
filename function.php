<?php
$koneksi = mysqli_connect("localhost", "root", "", "data_peserta");

function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function tambah($data)
{
    global $koneksi;

    $id_peserta = htmlspecialchars($data['id_peserta']);
    $nama = htmlspecialchars($data['nama']);
    $tmpt_Lahir = htmlspecialchars($data['tmpt_Lahir']);
    $tgl_Lahir = $data['tgl_Lahir'];
    $jekel = $data['jekel'];
    $program = $data['program'];
    $email = htmlspecialchars($data['email']);
    $alamat = htmlspecialchars($data['alamat']);
    
    $sql = "INSERT INTO peserta VALUES ('$id_peserta','$nama','$tmpt_Lahir','$tgl_Lahir','$jekel','$program','$email','$alamat')";

    mysqli_query($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
}

function hapus($id_peserta)
{
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM peserta WHERE id_peserta = $id_peserta");
    return mysqli_affected_rows($koneksi);
}

function ubah($data)
{
    global $koneksi;

    $id_peserta = $data['id_peserta'];
    $nama = htmlspecialchars($data['nama']);
    $tmpt_Lahir = htmlspecialchars($data['tmpt_Lahir']);
    $tgl_Lahir = $data['tgl_Lahir'];
    $jekel = $data['jekel'];
    $program = $data['program'];
    $email = htmlspecialchars($data['email']);
    $alamat = htmlspecialchars($data['alamat']);

    
    $sql = "UPDATE peserta SET nama = '$nama', tmpt_Lahir = '$tmpt_Lahir', tgl_Lahir = '$tgl_Lahir', jekel = '$jekel', program = '$program', email = '$email', alamat = '$alamat' WHERE id_peserta = $id_peserta";

    mysqli_query($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
}

function registrasi($data)
{
    global $koneksi;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

    $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar');
        </script>";
        return false;
    }

    if ($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai');
        </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($koneksi, "INSERT INTO user VALUES('', '$username', '$password')
    ");

    return mysqli_affected_rows($koneksi);
}