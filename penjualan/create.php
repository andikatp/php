<?php
$idU = $_POST["idU"];
$idK = $_POST["idK"];
$idB = $_POST["idB"];
$nama = $_POST["nama"];
$qty = $_POST["qty"];
$hargaB = $_POST["hargaB"];
$hargaJ = $_POST["hargaJ"];


$conn = mysqli_connect("localhost", "root", "", "db_tes_catatan");

$qry = mysqli_query($conn ,"INSERT INTO penjualan (id_user, id_keranjang, id_barang, nama_barang, qty, harga_beli, harga_jual) VALUES ('$idU', '$idK', '$idB', '$nama', '$qty', '$hargaB', '$hargaJ')");

$data = [];

if($error = mysqli_error($conn)){
    $data["status"] = "error";
    $data["message"]= $error;
} else {
    $data["status"] = "berhasil";
    $data["message"]= "Data berhasil ditambah";
}

echo(json_encode($data));

?>