<?php
include "../koneksi.php";

// Assuming you're using $_POST for user input
$id = $_POST['id'];
$id_outlet = $_POST['idOutlet'];
$jenis = $_POST['jenis'];
$nama_paket = $_POST['namaPaket'];
$harga = $_POST['harga'];

// Create a prepared statement
$query = "UPDATE tb_paket SET id_outlet=?, jenis=?, nama_paket=?, harga=? WHERE id=?";
$stmt = mysqli_prepare($koneksi, $query);

// Bind parameters to the prepared statement
mysqli_stmt_bind_param($stmt, "isssi", $id_outlet, $jenis, $nama_paket, $harga, $id);

// Execute the statement
$hasil = mysqli_stmt_execute($stmt);

// Check for success
if (!$hasil) {
    echo "Gagal Edit Data Paket: " . mysqli_stmt_error($stmt);
} else {
    header('Location:../dashboard.php?page=paket');
    exit;
}

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>
