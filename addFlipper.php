<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $response = array();
    //mendapatkan data

    $nama = $_POST['nama'];
    $gambar = $_FILES['gambar']['name'];

    $target = "uploads/" . basename($gambar);

    require_once('koneksi.php');
    //Cek nim sudah terdaftar apa belum

    $sql = "INSERT INTO flipper (nama,gambar) VALUES('$nama','$gambar')";

    if (mysqli_query($con, $sql)) {

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
            $result["value"] = true;
            $result["message"] = "Success mendaftar!";
            echo json_encode($result);
        }
    } else {
        $result["value"] = false;
        $result["message"] = "Gagal mendaftar!";
        echo json_encode($result);
    }

    mysqli_close($con);
} else {
    $response["value"] = false;
    $response["message"] = "oops! Coba lagi!";
    echo json_encode($response);
}
