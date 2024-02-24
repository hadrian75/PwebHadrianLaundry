

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Paket</title>
</head>

<body>
        <form action="tambah/prosesTambahPaket.php" method="POST" class="bg-gray-600 max-w-xl mx-auto p-10 mt-5 rounded-md">
        <h1 class="text-white text-2xl mb-5">Tambah Paket</h1>

            <div class="mb-5">
    <label for="namaPaket" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Paket</label>
    <input type="text" id="namaPaket" name="namaPaket" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Isi Nama Paket Anda" required>
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
    <label for="jenisPaket" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Paket</label>
    <select name="jenisPaket" id="jenisPaket" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="">
        <option value="" selected hidden>Pilih Jenis</option>
        <option value="kiloan" >Kiloan</option>
        <option value="selimut" >Selimut</option>
        <option value="bed_cover" >Bed Cover</option>
        <option value="kaos" >Kaos</option>
        <option value="lain" >Lainnya</option>
    </select>
  </div>
            <div class="mb-5">
    <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Paket</label>
    <input type="text" id="harga" name="harga" rows="5" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 p-2" placeholder="Isi Harga Paket">
  </div>

  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>

</body>

</html>