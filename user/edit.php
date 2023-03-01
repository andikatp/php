<?php
$id = $_POST["id"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$hp = $_POST["hp"];


$conn = mysqli_connect("localhost", "root", "", "db_tes_catatan");

$qry = mysqli_query($conn, "UPDATE users SET username='$username', email='$email', `password`='$password', hp='$hp' WHERE id_user = '$id'");

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