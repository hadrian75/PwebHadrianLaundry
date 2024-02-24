<?php
if (isset($_POST['selanjutnya'])) {
    $id_outlet = $_SESSION['id_outlet'];
    $nama_member = $_POST['id_member'];

    $kode_invoice = generateInvoiceCode($koneksi);
    $id_member = getMemberId($koneksi, $nama_member);
    $diskon = calculateDiscount($koneksi, $id_member);

    $transactionId = addTransaction($koneksi, $id_outlet, $kode_invoice, $id_member, $diskon);
    if ($transactionId) {
        $_SESSION['idtransaksi'] = $transactionId;
        header('Location: dashboard.php?page=detailTransaksi');
        exit;
    } else {
        echo "Failed to Add Transaction";
    }
}

function generateInvoiceCode($koneksi) {
    $today = date("Y/m/d");
    $query = "SELECT MAX(kode_invoice) AS last_invoice FROM tb_transaksi WHERE kode_invoice LIKE 'INV/$today/%'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    if ($data && $data['last_invoice']) {
        $invoiceNumber = (int)substr($data['last_invoice'], -1) + 1;
    } else {
        $invoiceNumber = 1;
    }

    return "INV/$today/$invoiceNumber";
}

function getMemberId($koneksi, $nama_member) {
    $stmt = $koneksi->prepare("SELECT id FROM tb_member WHERE nama = ?");
    $stmt->bind_param("s", $nama_member);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        return $row['id'];
    } else {
        return null; // Member not found or handle the error
    }
}

function calculateDiscount($koneksi, $id_member) {
    $stmt = $koneksi->prepare("SELECT COUNT(*) AS trans_count FROM tb_transaksi WHERE id_member = ?");
    $stmt->bind_param("i", $id_member);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data['trans_count'] > 0 && $data['trans_count'] % 3 == 0) {
        return 0.1; // 10% discount
    } else {
        return 0; // No discount
    }
}

function addTransaction($koneksi, $id_outlet, $kode_invoice, $id_member, $diskon) {
    date_default_timezone_set("Asia/Makassar");
    $tanggal = date('Y-m-d H:i:s');
    $tgl_bayar = "0000-00-00 00:00:00";
    // echo $tanggal;
    $batas_waktu = date('Y-m-d H:i:s', strtotime($tanggal . ' +3 days'));
    $biaya_tambahan = 0;
    $pajak = 0.0075;
    $status = "baru";
    $dibayar = "belum_dibayar";
    $id_user = $_SESSION['id_user'];

    $stmt = $koneksi->prepare("INSERT INTO tb_transaksi (id_outlet, kode_invoice, id_member, tgl,  batas_waktu,tgl_bayar,biaya_tambahan, diskon, pajak, status, dibayar, id_user) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isisssdddssi", $id_outlet, $kode_invoice, $id_member, $tanggal, $batas_waktu, $tgl_bayar, $biaya_tambahan, $diskon, $pajak, $status, $dibayar, $id_user);

    if ($stmt->execute()) {
        return $koneksi->insert_id; // Returns the last inserted ID
    } else {
        return false;
    }
}
?>

<div class="container mx-auto w-[400px] block translate-y-2/4">
    <div class="">
        <div class="">
            <span class="font-semibold "><h2 class="text-center">Transaksi</h2></span>
        </div>
    </div>
    <div class="">
        <div class="">
            <span class="font-semibold"><h1 class="text-center "><?= $_SESSION['nama_outlet'] ?></h1></span>
            <form action="" method="POST" class="bg-gray-800 p-10 rounded-lg">
                <div >
                    <input type="text" list="name_member" name="id_member" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="" placeholder="Nama Member" >
                    <datalist id="name_member"  required>
                        <?php
                        $sql = "SELECT * FROM tb_member";
                        $query = mysqli_query($koneksi, $sql);

                        while ($result = mysqli_fetch_assoc($query)) {
                        ?>
                            <option value="<?= $result['nama'] ?>"><?= $result['nama'] ?></option>
                        <?php
                        }
                        ?>
                    </datalist>
                </div>
                <?php
                if (@$_SESSION['idtransaksi']) {
                ?>
                <div class="flex justify-between items-center mt-10">
                    <div class="">
                        <input type="submit" class="bg-blue-600 hover:bg-blue-700 px-2 py-1 text-white text-[12px] rounded-md " value="SELANJUTNYA" name="selanjutnya">
                    </div>
                    <div class="">
                    <a href="dashboard.php?page=detailTransaksi" class="bg-yellow-400 hover:bg-yellow-500 px-2 py-1 text-white text-[12px] rounded-md ">
                        Back To Last Transaction
                    </a>

                    </div>
                 </div>
                <?php
                } else {
                ?>
                    <div class="flex justify-center items-center mt-10">
                        <input type="submit" value="SELANJUTNYA" class="bg-blue-600 hover:bg-blue-700 px-2 py-1 text-white text-[12px] rounded-md "   name="selanjutnya">
                    </div>
                <?php
                }
                ?>

            </form>
        </div>
    </div>
</div>