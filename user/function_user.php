<?php
include('../db_connection.php');


function readUser()
{
    header("Content-Type: application/json");
    global $conn;

    if (empty($_POST["username"]) || empty($_POST["password"])) {
        http_response_code(200);
        $response = array("Status" => "400", "Message" => "Masukkan Username dan Password User");
        return $response;
    }

    $username = mysqli_escape_string($conn, $_POST["username"]);
    $password = mysqli_escape_string($conn, $_POST["password"]);

    $order = "SELECT * FROM users WHERE username = '$username' and `password` = '$password'";
    $qry = mysqli_query($conn, $order);

    $data = array();
    if (!$qry || mysqli_num_rows($qry) == 0) {
        http_response_code(200);
        $data = ["Status" => "404", "Message" => "Periksa username dan password"];
    } else {
        $data["Status"] = "200";
        $data["Message"] = "Success";
        $data["User"] = mysqli_fetch_assoc($qry);

    }
    return $data;
}

function createUser()
{
    header("Content-Type: application/json");
    global $conn;


    if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["hp"])) {
        http_response_code(500);
        $response = array("Status" => "Error", "Message" => "Masukkan Seluruh Field");
        return $response;
    }

    $username = mysqli_escape_string($conn, $_POST["username"]);
    $email = mysqli_escape_string($conn, $_POST["email"]);
    $password = mysqli_escape_string($conn, $_POST["password"]);
    $hp = mysqli_escape_string($conn, $_POST["hp"]);

    $order = "INSERT INTO users (username, email, `password`, hp) VALUES ('$username', '$email', '$password', '$hp')";


    if (mysqli_query($conn, $order)) {
        http_response_code(200);
        $response = array("Status" => "Success", "Message" => "Data Berhasil Ditambahkan");
        return $response;
    } else {
        http_response_code(500);
        $response = array("Status" => "Error", "Message" => "Gagal Memasukkan Data, Coba Lagi Nanti");
        return $response;
    }
}

function editUser()
{
    header("Content-Type: application/json");
    global $conn;

    if (empty($_POST["id"]) || empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["hp"])) {
        http_response_code(400);
        $response = array("Status" => "Error", "Message" => "Masukkan Seluruh Field");
        return $response;
    }

    $id = mysqli_escape_string($conn, $_POST["id"]);
    $username = mysqli_escape_string($conn, $_POST["username"]);
    $email = mysqli_escape_string($conn, $_POST["email"]);
    $password = mysqli_escape_string($conn, $_POST["password"]);
    $hp = mysqli_escape_string($conn, $_POST["hp"]);

    $order = "UPDATE users SET username='$username', email='$email', `password`='$password', hp='$hp' WHERE id_user='$id'";

    if (mysqli_query($conn, $order)) {
        http_response_code(200);
        $response = array("Status" => "Success", "Message" => "Data Berhasil Diupdate");
        return $response;
    } else {
        http_response_code(500);
        $response = array("Status" => "Error", "Message" => "Gagal Mengupdate Data, Coba Lagi Nanti");
        return $response;
    }

}

function deleteUser()
{
    header("Content-Type: application/json");
    global $conn;

    if (empty($_POST["id"])) {
        http_response_code(400);
        $response = array("Status" => "Error", "Message" => "Masukkan ID Keranjang");
        return $response;
    }

    $id = mysqli_escape_string($conn, $_POST["id"]);
    $order = "DELETE FROM users WHERE id_user ='$id'";

    if (mysqli_query($conn, $order)) {
        http_response_code(200);
        $response = array("Status" => "Success", "Message" => "Data Berhasil Dihapus");
        return $response;
    } else {
        http_response_code(404);
        $response = array("Status" => "Error", "Message" => "Data Tidak Ditemukan");
        return $response;
    }

}
?>