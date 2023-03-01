<?php
$username = $_POST["username"];

$conn = mysqli_connect("localhost", "root", "", "db_tes_catatan");

$qry = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

$data = Array();

while($row = mysqli_fetch_assoc($qry)){
    $data[] = $row;
}


echo(json_encode($data));

?>