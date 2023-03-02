<?php
include('../db_connection.php');

// Menampilkan Barang
function readBarang()
{
    // Header to indicate to the client's browser that the response from the server is in JSON format.
    header("Content-Type: application/json");
    global $conn;

    // Validate input values
    if (empty($_POST["nama"])) {
        http_response_code(400);
        $response = array("Status" => "Error", "Message" => "Masukkan Nama Barang");
        return $response;
    }

    // Sanitize input values
    $nama = mysqli_real_escape_string($conn, $_POST["nama"]);

    // Construct the UPDATE SQL statement
    $order = "SELECT * FROM barang WHERE nama_barang LIKE '%$nama%' ORDER BY nama_barang LIMIT 25";
    $qry = mysqli_query($conn, $order);

    // Execute the SQL statement
    $data = array();
    if (!$qry || mysqli_affected_rows($conn) <= 0) {
        http_response_code(404);
        $data = array("Status" => "Error", "Message" => "Tidak Menemukan Data");
    } else {
        while ($row = mysqli_fetch_assoc($qry)) {
            $data[] = $row;
        }

    }
    return $data;
}

// Membuat Barang
function createBarang()
{
    header("Content-Type: application/json");
    global $conn;

    if (empty($_POST["user"]) || empty($_POST["barcode"]) || empty($_POST["nama"]) || empty($_POST["kategori"]) || empty($_POST["hargaB"]) || empty($_POST["hargaJ"]) || empty($_POST["stok"])) {
        http_response_code(400);
        $response = array("Status" => "Error", "Message" => "Masukkan Seluruh Field");
        return $response;
    }
    $user = mysqli_real_escape_string($conn, $_POST["user"]);
    $barcode = mysqli_real_escape_string($conn, $_POST["barcode"]);
    $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
    $kategori = mysqli_real_escape_string($conn, $_POST["kategori"]);
    $hargaB = mysqli_real_escape_string($conn, $_POST["hargaB"]);
    $hargaJ = mysqli_real_escape_string($conn, $_POST["hargaJ"]);
    $stok = mysqli_real_escape_string($conn, $_POST["stok"]);

    $order = "INSERT INTO barang (id_user, barcode, nama_barang, kategori, harga_beli, harga_jual, stok) VALUES ('$user', '$barcode', '$nama', '$kategori', '$hargaB', '$hargaJ', '$stok')";
    if (mysqli_query($conn, $order)) {
        http_response_code(200);
        $response = array("status" => "Success", "Message" => "Data Berhasil Dimasukkan");
        return $response;
    } else {
        http_response_code(500);
        $response = array("status" => "Error", "Message" => "Gagal Memasukkan Data Barang");
        return $response;
    }
}

// Mengedit Barang
function editBarang()
{
    header("Content-Type: application/json");
    global $conn;

    // Validate input values
    if (empty($_POST["id"]) || empty($_POST["user"]) || empty($_POST["barcode"]) || empty($_POST["nama"]) || empty($_POST["kategori"]) || empty($_POST["hargaB"]) || empty($_POST["hargaJ"]) || empty($_POST["stok"])) {
        http_response_code(400); // Bad request
        $response = array("Status" => "Rrror", "Message" => "Masukkan Seluruh Field.");
        return $response;
    }

    // Sanitize input values
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $user = mysqli_real_escape_string($conn, $_POST["user"]);
    $barcode = mysqli_real_escape_string($conn, $_POST["barcode"]);
    $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
    $kategori = mysqli_real_escape_string($conn, $_POST["kategori"]);
    $hargaB = mysqli_real_escape_string($conn, $_POST["hargaB"]);
    $hargaJ = mysqli_real_escape_string($conn, $_POST["hargaJ"]);
    $stok = mysqli_real_escape_string($conn, $_POST["stok"]);

    // Construct the UPDATE SQL statement
    $sql = "UPDATE barang SET id_user='$user', barcode='$barcode', nama_barang='$nama', kategori='$kategori', harga_beli='$hargaB', harga_jual='$hargaJ', stok='$stok' WHERE id_barang=$id";

    // Execute the SQL statement
    if (mysqli_query($conn, $sql)) {
        http_response_code(200); // OK
        $response = array("Status" => "Success", "Message" => "Data Telah Diupdate");
        return $response;
    } else {
        http_response_code(500); // Internal server error
        $response = array("Status" => "Error", "Message" => "Data Tidak Ditemukan");
        return $response;
    }
}

// Menghapus Barang
function deleteBarang()
{
    header("Content-Type: application/json");
    global $conn;

    if (empty($_POST['id'])) {
        http_response_code(400);
        $response = array("Status" => "Error", "Message", "Masukkan Seluruh Field");
        return $response;
    }

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $sql = "DELETE FROM barang WHERE id_barang = '$id'";

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