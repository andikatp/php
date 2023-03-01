<?php
$id = $_POST["id"];
$user = $_POST["user"];
$barcode = $_POST["barcode"];
$nama = $_POST["nama"];
$kategori = $_POST["kategori"];
$hargaB = $_POST["hargaB"];
$hargaJ = $_POST["hargaJ"];
$stok = $_POST["stok"];


$conn = mysqli_connect("localhost", "root", "", "db_tes_catatan");

$qry = mysqli_query($conn, "UPDATE barang SET id_user='$user', barcode='$barcode', nama_barang='$nama', kategori='$kategori', harga_beli='$hargaB', 
harga_jual='$hargaJ', stok='$stok' WHERE id_barang='$id'");

$data = Array();

if($error = mysqli_error($conn)){
    $data["status"] = "Error";
    $data["message"] = $error;
} else {
    $data["status"] = "Berhasil";
    $data["message"] = "Data berhasil di update";
}
echo(json_encode($data));
?>