

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan</title>
</head>

<body>
        <form action="tambah/prosesTambahMember.php" method="POST" class="bg-gray-600 max-w-xl mx-auto p-10 mt-5 rounded-md">
            <h1 class="text-white text-2xl mb-5">Registrasi Pelanggan</h1>
            <div class="mb-5">
    <label for="namaMember" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Member</label>
    <input type="text" id="namaMember" name="namaMember" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Isi Nama Outlet Anda" required>
  </div>
  <div class="mb-5">
<label for="alamatMember" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
<input type="text" id="alamatMember" name="alamat" rows="5" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 p-2" placeholder="Isi Alamat Outlet">
</div>
            <div class="mb-5">
    <label for="telp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telepon</label>
    <input type="text" id="telp" name="telepon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Isi Nomor Outlet" required>
</div>
    <div class="mb-5">
<label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
<select name="gender" id="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
<option value="" selected hidden>Pilih Gender</option>
    <option value="male">Laki - laki</option>
    <option value="female">Perempuan</option>
</select>
</div>

  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>

</body>

</html>