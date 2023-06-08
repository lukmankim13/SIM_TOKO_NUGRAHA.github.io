<div class="judul-content">
    <h1>Laporan Per Tanggal</h1>
</div>
<div class="isi-content">
    <div class="judul-home">
        <div class="divtabel">
            <form action="index.php?p=laporan_pertanggal" method="POST">
                <table>
                    <tr>
                        <td><label>Dari</label></td>
                        <td></td>
                        <td><label>Sampai</label></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="date" name="tgl_awal" class="text" id="tgl_awal" style="width: 200px;" value="<?php echo $_POST['tgl_awal']; ?>">
                        </td>
                        <td>s/d</td>
                        <td>
                            <input type="date" name="tgl_akhir" class="text" id="tgl_akhir" style="width: 200px;" value="<?php echo $_POST['tgl_akhir']; ?>">
                        </td>
                        <td>
                            <input type="submit" name="cari" class="inputbutton success" value="Cari" style='color:black'>
                        </td>
                        <?php 
                            $tgla = $_POST['tgl_awal'];
                            $tglk = $_POST['tgl_akhir'];
                         ?>
                        <td>
                            <input type="button" name="cari" class="inputbutton danger" value="Cetak" style="color:black" onclick="cetak()">
                        </td>
                    </tr>
                </table>
            </form>
            <table class="tabel98">
                <tr>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Petugas</th>
                    <th>Id Barang</th>
                    <th>Modal</th>
                    <th>Harga</th>
                    <th>Jumlah Beli</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                <?php 
                    include 'system/proses.php';

                    if (isset($_POST['hapus'])) {
                        $id_transaksi = $_POST['id_transaksi']; // Mendapatkan ID Transaksi dari form
                    
                        // Query untuk menghapus data berdasarkan ID Transaksi
                        $hapus = $db->delete("transaksi", "id_transaksi = '$id_transaksi'");
                    
                        if ($hapus) {
                            echo "Data berhasil dihapus";
                        } else {
                            echo "Gagal menghapus data";
                        }
                    }

                    if (isset($_POST['cari'])) {
                        $tgl_awal = $_POST['tgl_awal'];
                        $tgl_akhir = $_POST['tgl_akhir'];
                        $qw = $db->get("transaksi.id_transaksi, transaksi.tanggal, petugas.username, detail_transaksi.jumlah_beli, detail_transaksi.subtotal, barang.id_brg, barang.modal, barang.harga","transaksi" ,"INNER JOIN petugas ON transaksi.id_petugas = petugas.id_petugas INNER JOIN detail_transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi INNER JOIN barang ON detail_transaksi.id_brg = barang.id_brg WHERE transaksi.tanggal >= '$tgl_awal' AND transaksi.tanggal <= '$tgl_akhir'");
                    } else {
                        $qw = $db->get("transaksi.id_transaksi, transaksi.tanggal, petugas.username, detail_transaksi.jumlah_beli, detail_transaksi.subtotal, barang.id_brg, barang.modal, barang.harga","transaksi" ,"INNER JOIN petugas ON transaksi.id_petugas = petugas.id_petugas INNER JOIN detail_transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi INNER JOIN barang ON detail_transaksi.id_brg = barang.id_brg");
                    }

                    foreach($qw as $tampil) {
                ?>
                <tr>
                    <td><?php echo $tampil['id_transaksi']; ?></td>
                    <td><?php echo $tampil['tanggal']; ?></td>
                    <td><?php echo $tampil['username']; ?></td>
                    <td><?php echo $tampil['id_brg']; ?></td>
                    <td><?php echo $tampil['modal']; ?></td>
                    <td><?php echo $tampil['harga']; ?></td>
                    <td><?php echo $tampil['jumlah_beli']; ?></td>
                    <td><?php echo $tampil['subtotal']; ?></td>
                    <td>
                        <form action="" method="POST">
                            <input type="hidden" name="id_transaksi" value="<?php echo $tampil['id_transaksi']; ?>">
                            <button type="submit" name="hapus" class="btn btn-merah" onclick="return confirm('Yakin Ingin Menghapus Data ?')">
                                <i class="fa fa-trash-alt"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                <?php 
                    }
                ?>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
function cetak() {
    tl = $('#tgl_awal').val();
    tg = $('#tgl_akhir').val();

    window.open("content/print_pertanggal.php?tgl_awal=" + tl + "&" + "tgl_akhir=" + tg);
}
</script>
