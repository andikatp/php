<?php
$id = $_POST['id'];
$idU = $_POST["idU"];
$qty = $_POST["qty"];
$harga = $_POST["harga"];
$status = $_POST["status"];


$conn = mysqli_connect("localhost", "root", "", "db_tes_catatan");

$qry = mysqli_query($conn, "UPDATE keranjang SET id_user='$idU', qty='$qty', total_harga='$harga', `status`='$status' WHERE id_keranjang = '$id'");

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