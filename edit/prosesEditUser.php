<?php
include '../koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$id_outlet = $_POST['idOutlet'];
$role = $_POST['role'];
$password = $_POST['pass'];
$passConfirm = $_POST['passConfirm'];

$pass_hash = password_hash($password, PASSWORD_DEFAULT);

$sqluser = "SELECT * FROM tb_user WHERE id = '$id'";
$queryuser = mysqli_query($koneksi, $sqluser);
$data = mysqli_fetch_assoc($queryuser);

// Prepare the SQL statement
if(password_verify($passConfirm, $data["password"])){
$sql = "UPDATE tb_user SET nama = ?, username = ?, password = ?, id_outlet = ?, role = ? WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $sql);

// Bind parameters
mysqli_stmt_bind_param($stmt, "sssssi", $nama, $username, $pass_hash, $id_outlet, $role, $id);

// Execute the statement
if (mysqli_stmt_execute($stmt)) {
    // Successful update
    header('Location:dashboard.php?page=editUser');
} else {
    // Error handling
    echo "Update User Failed : " . mysqli_stmt_error($stmt);
}

// Close statement
mysqli_stmt_close($stmt);

// Close koneksii
mysqli_close($koneksi);
} else{
    echo "Update User Failed Wrong Password ";
    header('Location:dashboard.php?page=editUser');
}
?>
