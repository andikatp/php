<?php
$id = $_POST["id"];
$qty = $_POST["qty"];
$harga = $_POST["harga"];
$status = $_POST["status"];


$conn = mysqli_connect("localhost", "root", "", "db_tes_catatan");

$qry = mysqli_query($conn, "INSERT INTO keranjang (id_user, qty, total_harga, `status`) VALUES ('$id', '$qty', '$harga', '$status')");

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