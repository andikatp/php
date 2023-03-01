<?php
$id = $_POST["id"];
$idU = $_POST["idU"];
$idK = $_POST["idK"];
$idB = $_POST["idB"];
$nama = $_POST["nama"];
$qty = $_POST["qty"];
$hargaB = $_POST["hargaB"];
$hargaJ = $_POST["hargaJ"];


$conn = mysqli_connect("localhost", "root", "", "db_tes_catatan");

$qry = mysqli_query($conn, "UPDATE penjualan SET id_user='$id', id_keranjang='$idK', id_barang='$idB' nama='$nama', qty='$qty', harga_beli = '$hargaB', harga_jual = '$hargaJ' WHERE id_penjualan = '$id'");

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