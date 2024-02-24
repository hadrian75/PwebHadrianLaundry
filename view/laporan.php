<?php
$_SESSION['beforePage'] = "laporan";
if (@$_GET['status'] == 'baru') {
    $status = "WHERE status = 'baru'";
} else if (@$_GET['status'] == 'proses') {
    $status = "WHERE status = 'proses'";
} else if (@$_GET['status'] == 'selesai') {
    $status = "WHERE status = 'selesai'";
} else if (@$_GET['status'] == 'diambil') {
    $status = "WHERE status = 'diambil'";
} else {
    $status = "";
}

if (@$_SESSION['role'] == 'admin' || @$_SESSION['role'] == 'owner') {
    $sql = "SELECT *, tb_outlet.id AS id_outlet_tb_outlet, tb_outlet.nama AS nama_outlet, tb_transaksi.id AS id_transaksi, tb_member.nama AS nama_member FROM tb_detail_transaksi INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi = tb_transaksi.id INNER JOIN tb_member ON tb_transaksi.id_member = tb_member.id INNER JOIN tb_paket ON tb_detail_transaksi.id_paket = tb_paket.id INNER JOIN tb_outlet ON tb_transaksi.id_outlet = tb_outlet.id INNER JOIN tb_user ON tb_transaksi.id_user = tb_user.id $status GROUP BY kode_invoice";
    $query = mysqli_query($koneksi, $sql);
} else {
    $sessionOutlet = $_SESSION['outlet'];
    if ($status != "") {
        $outlet = "AND tb_outlet.id = '$sessionOutlet'";
    } else {
        $outlet = "WHERE tb_outlet.id = '$sessionOutlet'";
    }
    $sql = "SELECT *, tb_outlet.id AS id_outlet_tb_outlet, tb_outlet.nama AS nama_outlet, tb_transaksi.id AS id_transaksi, tb_member.nama AS nama_member FROM tb_detail_transaksi INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi = tb_transaksi.id INNER JOIN tb_member ON tb_transaksi.id_member = tb_member.id INNER JOIN tb_paket ON tb_detail_transaksi.id_paket = tb_paket.id INNER JOIN tb_outlet ON tb_transaksi.id_outlet = tb_outlet.id INNER JOIN tb_user ON tb_transaksi.id_user = tb_user.id $status $outlet GROUP BY kode_invoice";
    $query = mysqli_query($koneksi, $sql);
}
?>
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center">
            <span class="text-xl font-bold">Report</span>
        </div>
        <div class="flex items-center">
            <select onchange="pilihStatus(this.options[this.selectedIndex].value)" class="px-2 py-1 border border-gray-300 rounded">
                <option value="" selected>All Status</option>
                <option value="baru" <?php if (@$_GET['status'] == 'baru') { echo "selected"; } ?>>New</option>
                <option value="proses" <?php if (@$_GET['status'] == 'proses') { echo "selected"; } ?>>Process</option>
                <option value="selesai" <?php if (@$_GET['status'] == 'selesai') { echo "selected"; } ?>>Done</option>
                <option value="diambil" <?php if (@$_GET['status'] == 'diambil') { echo "selected"; } ?>>Taked</option>
            </select>
            <script>
                function pilihStatus(value) {
                    window.location = "dashboard.php?page=laporan&status=" + value;
                }
            </script>
        </div>
    </div>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        <?php
        $query = mysqli_query($koneksi, $sql);

        while ($data = mysqli_fetch_row($query)) {
        ?>
            <div class="border border-gray-300 rounded p-4">
                <div class="flex items-center justify-between mb-2">
                    <span><?= $data['9'] ?></span>
                    <a class ="p-1"style="border: 2px solid <?php if ($data['18'] == 'belum_dibayar') { echo "#0096c7"; } else { echo "#38b000"; } ?>; color: <?php if ($data['18'] == 'belum_dibayar') { echo "#0096c7"; } else { echo "#38b000"; } ?>;" href="dashboard.php?page=detailTransaksi&idtransaksi=<?= $data['7'] ?>">See Detail</a>
                </div>
                <div class="mb-2">
                    <span><?php $idoutlet = $data['8']; $sqloutlet = "SELECT * FROM tb_outlet WHERE id = '$idoutlet'"; $queryoutlet = mysqli_query($koneksi, $sqloutlet); $dataoutlet = mysqli_fetch_assoc($queryoutlet); echo "Outlet Name : " . $dataoutlet['nama']; ?></span>
                </div>
                <div class="mb-2">
                    <span class="">
                        <?php
                        $pecah_string_tanggal = explode(" ", $data['12']);
                        $pecah_string_hari = explode("-", $pecah_string_tanggal[0]);
                        $pecah_string_jam = explode(":", $pecah_string_tanggal[1]);

                        echo "Deadline : " . $pecah_string_hari[2] . "-" . $pecah_string_hari[1] . "-" . $pecah_string_hari[0];
                        echo "<br>";
                        echo "Time : " . $pecah_string_jam[0] . ":" . $pecah_string_jam[1];
                        ?>
                    </span>
                    <span class="">
                        <?php
                        $idmember = $data['10'];
                        $sqlmember = "SELECT * FROM tb_member WHERE id = '$idmember'";
                        $querymember = mysqli_query($koneksi, $sqlmember);
                        $datamember = mysqli_fetch_assoc($querymember);

                        echo $datamember['nama'];
                        ?>
                    </span>
                </div>
                <div class="mb-2">
                    <span class="">
                        <?php
                        $id_transaksi = $data['7'];
                        $querypaket = mysqli_query($koneksi, "SELECT * FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket = tb_paket.id WHERE id_transaksi = '$id_transaksi'");
                        while ($datapaket = mysqli_fetch_assoc($querypaket)) {
                            echo $datapaket['nama_paket'];
                            echo "<br>";
                        }
                        ?>
                    </span>
                    <span class="">
                        <?php
                        $id_transaksi = $data['7'];
                        $grand_total = mysqli_fetch_row(mysqli_query($koneksi, "SELECT SUM(total_harga) FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket = tb_paket.id WHERE id_transaksi = '$id_transaksi'"));
                        $pajak = $grand_total[0] * $data['16'];
                        $diskon = $grand_total[0] * $data['15'];
                        $total_keseluruhan = ($grand_total[0] + $data['14'] + $pajak) - $diskon;

                        echo "Total : Rp. " . number_format($total_keseluruhan, 0, ',', '.');
                        ?>
                    </span>
                </div>
                <div class="mb-2" style="border: <?php if ($_SESSION['role'] == 'owner') { echo "none"; } ?>;">
                    <select <?php if ($_SESSION['role'] == 'owner') { echo "hidden"; } ?> onchange="gantiStatus(this.options[this.selectedIndex].value, <?= $data['1'] ?>)" class="px-2 py-1 border border-gray-300 rounded">
                        <option value="baru" <?php if ($data['17'] == 'baru') { echo "selected"; } ?>>New</option>
                        <option value="proses" <?php if ($data['17']  == 'proses') { echo "selected"; } ?>>Process</option>
                        <option value="selesai" <?php if ($data['17']  == 'selesai') { echo "selected"; } ?>>Done</option>
                        <option value="diambil" <?php if ($data['17']  == 'diambil') { echo "selected"; } ?>>Taked</option>
                    </select>
                    <script>
                        function gantiStatus(value, id) {
                            window.location = "dashboard.php?page=prosesStatusTransaksi&status=" + value + "&id=" + id;
                        }
                    </script>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
