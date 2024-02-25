<?php
include 'koneksi.php';

$id = $_GET['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$id_outlet = $_POST['id_outlet'];
$role = $_POST['role'];
$password = $_POST['password'];

$pass_hash = password_hash($password, PASSWORD_DEFAULT);

// Prepare the SQL statement
$sql = "UPDATE tb_user SET nama = ?, username = ?, password = ?, id_outlet = ?, role = ? WHERE id = ?";
$stmt = mysqli_prepare($connect, $sql);

// Bind parameters
mysqli_stmt_bind_param($stmt, "sssssi", $nama, $username, $pass_hash, $id_outlet, $role, $id);

// Execute the statement
if (mysqli_stmt_execute($stmt)) {
    // Successful update
    header('Location:../handlers/logout.php');
} else {
    // Error handling
    echo "Update Employee Failed : " . mysqli_stmt_error($stmt);
}

// Close statement
mysqli_stmt_close($stmt);

// Close connection
mysqli_close($connect);
?>
