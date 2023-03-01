<?php
$nama = $_POST["barang"];

$conn = mysqli_connect("localhost", "root", "", "db_tes_catatan");

$qry = mysqli_query($conn, "SELECT * FROM barang WHERE nama_barang LIKE '%$nama%' ORDER BY nama_barang");

$data = Array();

while($row = mysqli_fetch_assoc($qry)){
    $data[] = $row;
}

echo(json_encode($data));
?>