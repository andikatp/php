<?php
include('../db_connection.php');


function readKeranjang()
{
    header("Content-Type: application/json");
    global $conn;

    if (empty($_POST["id"])) {
        http_response_code(400);
        $response = array("Status" => "Error", "Message" => "Masukkan ID Barang");
        return $response;
    }

    $id = mysqli_escape_string($conn, $_POST["id"]);

    $order = "SELECT * FROM keranjang WHERE id_keranjang = '$id'";
    $qry = mysqli_query($conn, $order);

    $data = array();
    if (!$qry || mysqli_affected_rows($conn) <= 0) {
        http_response_code(404);
        $data = array("Status" => "Error", "Message" => "Tidak Ada Data");
    }
    $data[] = mysqli_fetch_assoc($qry);
    return $data;
}

function createKeranjang()
{
    header("Content-Type: application/json");
    global $conn;


    if (empty($_POST["id"]) || empty($_POST["qty"]) || empty($_POST["harga"]) || empty($_POST["status"])) {
        http_response_code(500);
        $response = array("Status" => "Error", "Message" => "Masukkan Seluruh Field");
        return $response;
    }

    $id = mysqli_escape_string($conn, $_POST["id"]);
    $qty = mysqli_escape_string($conn, $_POST["qty"]);
    $harga = mysqli_escape_string($conn, $_POST["harga"]);
    $status = mysqli_escape_string($conn, $_POST["status"]);

    $order = "INSERT INTO keranjang (id_user, qty, total_harga, `status`) VALUES ('$id', '$qty', '$harga', '$status')";


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

function editKeranjang()
{
    header("Content-Type: application/json");
    global $conn;

    if (empty($_POST["id"]) || empty($_POST["idU"]) || empty($_POST["qty"]) || empty($_POST["harga"]) || empty($_POST["status"])) {
        http_response_code(400);
        $response = array("Status" => "Error", "Message" => "Masukkan Seluruh Field");
        return $response;
    }

    $id = mysqli_escape_string($conn, $_POST["id"]);
    $idU = mysqli_escape_string($conn, $_POST["idU"]);
    $qty = mysqli_escape_string($conn, $_POST["qty"]);
    $harga = mysqli_escape_string($conn, $_POST["harga"]);
    $status = mysqli_escape_string($conn, $_POST["status"]);

    $order = "UPDATE keranjang SET id_user='$idU', qty='$qty', total_harga='$harga', `status`='$status' WHERE id_keranjang = '$id'";

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

function deleteKeranjang()
{
    header("Content-Type: application/json");
    global $conn;

    if (empty($_POST["id"])) {
        http_response_code(400);
        $response = array("Status" => "Error", "Message" => "Masukkan ID Keranjang");
        return $response;
    }

    $id = mysqli_escape_string($conn, $_POST["id"]);

    $sql = "DELETE FROM keranjang WHERE id_keranjang = '$id'";

    if (mysqli_query($conn, $sql)) {
        http_response_code(200);
        $response = array("Status" => "Success", "Message" => "Data Berhasil Dihapus");
        return $response;
    } else {
        http_response_code(404);
        $response = array("Status" => "Error", "Message" => "Data Tidak Ditemukan");
        return $response;
    }

}