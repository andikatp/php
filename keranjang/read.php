<?php
$id = $_POST["id"];

$conn = mysqli_connect("localhost", "root", "", "db_tes_catatan");

$qry = mysqli_query($conn, "SELECT * FROM keranjang WHERE id_keranjang = '$id'");

$data = Array();

while($row = mysqli_fetch_assoc($qry)){
    $data[] = $row;
}


echo(json_encode($data));

?>