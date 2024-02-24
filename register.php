

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
</head>

<body>
        <form action="prosesRegisterEnkripsi.php" method="POST" class="bg-gray-600 max-w-xl mx-auto p-10 mt-5 rounded-md">
        <h1 class="text-white text-2xl mb-5">Registrasi User</h1>

            <div class="mb-5">
    <label for="namaLengkap" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
    <input type="text" id="namaLengkap" name="namaLengkap" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Isi Nama Lengkap..." required>
  </div>
            <div class="mb-5">
    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
    <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Isi Username..." required>
  </div>
            <div class="mb-5">
    <label for="pass" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
    <input type="password" id="pass" name="pass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="&#8226&#8226&#8226&#8226&#8226&#8226&#8226&#8226&#8226" required>
  </div>
          <div class="mb-5">
    <label for="idOutlet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Outlet</label>
    <select name="idOutlet" id="idOutlet" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option value="" selected hidden>Pilih Outlet</option>
    <?php
    $paketSql = mysqli_query($koneksi, "SELECT * FROM tb_outlet");
    while($data = mysqli_fetch_assoc($paketSql)){
    ?>
    <option value="<?=$data['id'] ?>"><?=$data["nama"]?></option>
    <?php } ?>
    </select>
        </div>
            <div class="mb-5">
    <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
    <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option value="" selected hidden>Pilih Role</option>
    <option value="kasir">Kasir</option>
    <option value="owner">Owner</option>
    <option value="admin">Admin</option>
            </select>
  </div>

  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>

</body>

</html>