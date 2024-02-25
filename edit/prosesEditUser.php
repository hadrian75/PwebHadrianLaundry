<?php
include '../koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$id_outlet = $_POST['idOutlet'];
$role = $_POST['role'];
$password = $_POST['pass'];
$passConfirm = $_POST['passConfirm'];

// Hash the password
$pass_hash = password_hash($password, PASSWORD_DEFAULT);

$sqluser = "SELECT * FROM tb_user WHERE id = ?";
$stmtuser = mysqli_prepare($koneksi, $sqluser);
mysqli_stmt_bind_param($stmtuser, "i", $id);
mysqli_stmt_execute($stmtuser);
$result = mysqli_stmt_get_result($stmtuser);
$data = mysqli_fetch_assoc($result);

if ($data) {
    if (password_verify($passConfirm, $data["password"])) {
        // Prepare the SQL statement
        $sql = "UPDATE tb_user SET nama = ?, username = ?, password = ?, id_outlet = ?, role = ? WHERE id = ?";
        $stmt = mysqli_prepare($koneksi, $sql);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "sssisi", $nama, $username, $pass_hash, $id_outlet, $role, $id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Successful update
            header('Location:../dashboard.php?page=editUser');
            exit;
        } else {
            // Error handling
            error_log("Update User Failed: " . mysqli_stmt_error($stmt));
            header('Location:../dashboard.php?page=editUser&error=update_failed');
            exit;
        }
    } else {
        // Wrong password
        header('Location:../dashboard.php?page=editUser&error=wrong_password');
        exit;
    }
} else {
    // User not found
    header('Location:../dashboard.php?page=editUser&error=user_not_found');
    exit;
}

// Close statements
mysqli_stmt_close($stmtuser);
mysqli_stmt_close($stmt);

// Close connection
mysqli_close($koneksi);
?>
