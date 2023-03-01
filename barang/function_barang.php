<?php
include('../db_connection.php');
function readBarang(){
global $conn;
$nama = $_POST["barang"];
$qry = mysqli_query($conn, "SELECT * FROM barang WHERE nama_barang LIKE '%$nama%' ORDER BY nama_barang");
$data = Array();

while($row = mysqli_fetch_assoc($qry)){
    $data[] = $row;
}
echo json_encode($data);
}


?>