<?php
$id = $_POST["id"];

$conn = mysqli_connect("localhost", "root", "", "db_tes_catatan");

$qry = mysqli_query($conn, "DELETE FROM barang WHERE id_barang = '$id'");

$data = Array();

if($error = mysqli_error($conn)){
    $data["status"] = "Error";
    $data["message"] = $error;
} else {
    $data["status"] = "Berhasil";
    $data["message"] = "Data berhasil dihapus";
}

echo(json_encode($data));

?>