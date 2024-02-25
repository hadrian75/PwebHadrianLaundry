<?php
include '../koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$id_outlet = $_POST['idOutlet'];
$role = $_POST['role'];
$password_lama = $_POST['passConfirm'];
$password = $_POST['password'];

// Prepare and execute query to fetch user data
$sqluser = "SELECT * FROM tb_user WHERE id = ?";
$stmtuser = mysqli_prepare($koneksi, $sqluser);
mysqli_stmt_bind_param($stmtuser, "i", $id);
mysqli_stmt_execute($stmtuser);
$resultuser = mysqli_stmt_get_result($stmtuser);
$userData = mysqli_fetch_assoc($resultuser);

// Verify old password
    // Old password verified, proceed with update

    // Check if a new password is provided
if (!empty($password)) {
if (password_verify($password_lama, $userData['password']) > 0) {

        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE tb_user SET nama = ?, username = ?, password = ?, id_outlet = ?, role = ? WHERE id = ?";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "sssisi", $nama, $username, $pass_hash, $id_outlet, $role, $id);
    }
    else {
        // Old password doesn't match, show error message
        echo "<script>alert('Old password is incorrect.');window.location.href='../dashboard.php?page=user'</script>";
    }
} else {
    // No new password provided
    $sql = "UPDATE tb_user SET nama = ?, username = ?, id_outlet = ?, role = ? WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "ssisi", $nama, $username, $id_outlet, $role, $id);
    
}
    
    // Execute the update query
    if (mysqli_stmt_execute($stmt)) {
        // Close statement
        mysqli_stmt_close($stmt);

        // Redirect to logout page
        header('Location:../dashboard.php?page=user');
        exit;
    } else {
        // Error handling for update query execution
        error_log("Failed to update user: " . mysqli_error($koneksi));
        echo "<script>alert('Failed to update user.');window.location.href='../dashboard.php?page=user'</script>";
    }

// Close statement and connection
mysqli_stmt_close($stmtuser);
mysqli_close($koneksi);
?>
