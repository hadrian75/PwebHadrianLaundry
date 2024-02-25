<?php
$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT tb_paket. *, tb_outlet.nama as namaOutlet, tb_outlet.id as idOutlet  FROM tb_paket INNER JOIN tb_outlet ON tb_paket.id_outlet = tb_outlet.id WHERE tb_paket.id ='$id'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>

<body>
        <form action="edit/prosesEditUser.php" method="POST" class="bg-gray-600 max-w-xl mx-auto p-10 mt-5">
            <input type="text" hidden name="id" value="<?= $data['id']?>">
            <div class="mb-5">
    <label for="idOutlet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Outlet</label>
    <select name="idOutlet" id="idOutlet" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <?php
    $paketSql = mysqli_query($koneksi, "SELECT * FROM tb_outlet");
    while($dataOutlet = mysqli_fetch_assoc($paketSql)){
    ?>
    <option value="<?=$data['id'] ?>" <?php if($data["idOutlet"] == $dataOutlet["id"]){echo "selected";} ?>><?=$dataOutlet["nama"]?></option>
    <?php } ?>
    </select>
        </div>
        <div class="mb-5">
    <label for="jenis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Paket</label>
    <select name="jenis" id="jenis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option value="" selected hidden>Pilih Role</option>
        <option value="admin" <?php echo ($data["role"] == "admin") ? 'selected' : ''; ?>>Admin</option>
        <option value="kasir" <?php echo ($data["role"] == "kasir") ? 'selected' : ''; ?>>Kasir</option>
        <option value="owner" <?php echo ($data["role"] == "owner") ? 'selected' : ''; ?>>Owner</option>
    </select>
</div>

  
  <div class="mb-5">
    <label for="namaPaket" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Paket</label>
    <input type="text" name="namaPaket" id="namaPaket"  class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 p-2" placeholder="Isi Alamat Outlet" value="<?=$data["nama_paket"]?>">
  </div>
  <div class="mb-5">
    <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Paket</label>
    <input type="text" name="harga" id="harga"  class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 p-2" placeholder="Isi Alamat Outlet" value="<?=$data["harga"]?>">
  </div>

  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>

</body>

</html>