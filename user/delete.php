<?php
$id = $_POST("id");

$conn = mysqli_connect("localhost", "root", "", "db_tes_catatan");

$qry = mysqli_query($conn, "DELETE FROM users WHERE id_user ='$id'");

$data = [];

if($error = mysqli_error($conn)){
    $data["status"] = "error";
    $data["message"]= $error;
} else {
    $data["status"] = "berhasil";
    $data["message"]= "Data berhasil dihapus";
}

echo(json_encode($data));


?>