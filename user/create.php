<?php
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$hp = $_POST["hp"];


$conn = mysqli_connect("localhost", "root", "", "db_tes_catatan");

$qry = mysqli_query($conn ,"INSERT INTO users (username, email, `password`, hp) VALUES ('$username', '$email', '$password', '$hp')");

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