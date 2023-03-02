<?php
include('../db_connection.php');


function readPenjualan()
{
    header("Content-Type: application/json");
    global $conn;

    if (empty($_POST["id"])) {
        http_response_code(400);
        $response = array("Status" => "Error", "Message" => "Masukkan ID Penjualan");
        return $response;
    }
    $id = mysqli_escape_string($conn, $_POST["id"]);

    $order = "SELECT * FROM penjualan WHERE id_penjualan = '$id'";
    $qry = mysqli_query($conn, $order);

    $data = array();
    if (!$qry || mysqli_affected_rows($conn) <= 0) {
        http_response_code(404);
        $data = array("Status" => "Error", "Message" => "Tidak Ada Data");
    }
    $data[] = mysqli_fetch_assoc($qry);
    return $data;
}

function createPenjualan()
{
    header("Content-Type: application/json");
    global $conn;


    if (empty($_POST["idU"]) || empty($_POST["idK"]) || empty($_POST["idB"]) || empty($_POST["nama"]) || empty($_POST["qty"]) || empty($_POST["hargaB"]) || empty($_POST["hargaJ"])) {
        http_response_code(500);
        $response = array("Status" => "Error", "Message" => "Masukkan Seluruh Field");
        return $response;
    }

    $idU = mysqli_escape_string($conn, $_POST["idU"]);
    $idK = mysqli_escape_string($conn, $_POST["idK"]);
    $idB = mysqli_escape_string($conn, $_POST["idB"]);
    $nama = mysqli_escape_string($conn, $_POST["nama"]);
    $qty = mysqli_escape_string($conn, $_POST["qty"]);
    $hargaB = mysqli_escape_string($conn, $_POST["hargaB"]);
    $hargaJ = mysqli_escape_string($conn, $_POST["hargaJ"]);

    $order = "INSERT INTO penjualan (id_user, id_keranjang, id_barang, nama_barang, qty, harga_beli, harga_jual) VALUES ('$idU', '$idK', '$idB', '$nama', '$qty', '$hargaB', '$hargaJ')";


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

function editPenjualan()
{
    header("Content-Type: application/json");
    global $conn;

    if (empty($_POST["id"]) || empty($_POST["idU"]) || empty($_POST["idK"]) || empty($_POST["idB"]) || empty($_POST["nama"]) || empty($_POST["qty"]) || empty($_POST["hargaB"]) || empty($_POST["hargaJ"])) {
        http_response_code(400);
        $response = array("Status" => "Error", "Message" => "Masukkan Seluruh Field");
        return $response;
    }

    $id = mysqli_escape_string($conn, $_POST["id"]);
    $idU = mysqli_escape_string($conn, $_POST["idU"]);
    $idK = mysqli_escape_string($conn, $_POST["idK"]);
    $idB = mysqli_escape_string($conn, $_POST["idB"]);
    $nama = mysqli_escape_string($conn, $_POST["nama"]);
    $qty = mysqli_escape_string($conn, $_POST["qty"]);
    $hargaB = mysqli_escape_string($conn, $_POST["hargaB"]);
    $hargaJ = mysqli_escape_string($conn, $_POST["hargaJ"]);

    $order = "UPDATE penjualan SET id_user='$idU', id_keranjang='$idK', id_barang='$idB' nama='$nama', qty='$qty', harga_beli = '$hargaB', harga_jual = '$hargaJ' WHERE id_penjualan = '$id'";

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

function deletePenjualan()
{
    header("Content-Type: application/json");
    global $conn;

    if (empty($_POST["id"])) {
        http_response_code(400);
        $response = array("Status" => "Error", "Message" => "Masukkan ID Keranjang");
        return $response;
    }

    $id = mysqli_escape_string($conn, $_POST["id"]);

    $sql = "DELETE FROM penjualan WHERE id_penjualan = '$id'";

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