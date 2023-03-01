<?php
$user = $_POST["user"];
$barcode = $_POST["barcode"];
$nama = $_POST["nama"];
$kategori = $_POST["kategori"];
$hargaB = $_POST["hargaB"];
$hargaJ = $_POST["hargaJ"];
$stok = $_POST["stok"];

$conn = mysqli_connect("localhost", "root", "", "db_tes_catatan");

$qry = mysqli_query($conn, "INSERT INTO barang (id_user, barcode, nama_barang, kategori, harga_beli, harga_jual, stok) VALUES ('$user', '$barcode', '$nama', '$kategori', '$hargaB', '$hargaJ', '$stok')");

$data = Array();

if($error = mysqli_error($conn)){
    $data["status"] = "error";
    $data["message"] = $error;
} else {
    $data["status"] = "berhasil";
    $data["message"] = "Data berhasil dimasukkan";
}

echo(json_encode($data));
?>