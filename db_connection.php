<?php
$conn = mysqli_connect("localhost", "root", "", "db_tes_catatan");
if (mysqli_errno($conn)) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
