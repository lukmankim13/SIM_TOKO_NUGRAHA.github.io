<?php include 'system/proses.php'; 
    
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

?>
<div class="judul-content">
    <h1>Laporan Per Bulan</h1>
</div>
<div class="isi-content">

    <div class="judul-home">
        <div class="divtabel">
            <form action="index.php?p=laporan_perbulan" method="POST">
                <table>
                    <tr>
                        <td>
                            <center><label>Bulan</label></center>
                        </td>

                        <td>
                            <center><label>Tahun</label></center>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="bulan" id="bulan" class="text" style="width: 200px;">
                                <option <?php if($_POST['bulan']=="01"){echo "selected";} ?> value="01">Januari</option>
                                <option <?php if($_POST['bulan']=="02"){echo "selected";} ?> value="02">Februari
                                </option>
                                <option <?php if($_POST['bulan']=="03"){echo "selected";} ?> value="03">Maret</option>
                                <option <?php if($_POST['bulan']=="04"){echo "selected";} ?> value="04">April</option>
                                <option <?php if($_POST['bulan']=="05"){echo "selected";} ?> value="05">Mei</option>
                                <option <?php if($_POST['bulan']=="06"){echo "selected";} ?> value="06">Juni</option>
                                <option <?php if($_POST['bulan']=="07"){echo "selected";} ?> value="07">Juli</option>
                                <option <?php if($_POST['bulan']=="08"){echo "selected";} ?> value="08">Agustus</option>
                                <option <?php if($_POST['bulan']=="09"){echo "selected";} ?> value="09">September
                                </option>
                                <option <?php if($_POST['bulan']=="10"){echo "selected";} ?> value="10">Oktober</option>
                                <option <?php if($_POST['bulan']=="11"){echo "selected";} ?> value="11">November
                                </option>
                                <option <?php if($_POST['bulan']=="12"){echo "selected";} ?> value="12">Desember
                                </option>
                            </select>
                        </td>
                        <td>
                            <select name="tahun" id="tahun" class="text" style="width: 200px;">
                                <?php 
									$qr = $db->get("tanggal","transaksi"," GROUP BY DATE_FORMAT(tanggal, '%Y')");
									while($d=$qr->fetch()) :
										$data = explode('-', $d['tanggal']);
										$tahun = $data[0];
								 ?>
                                <option value="<?php echo $tahun; ?>"><?php echo $tahun; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </td>
                        <td>
                            <input type="submit" name="carilb" class="inputbutton success" value="Cari"
                                style="color:black">
                        </td>
                        <?php 
							$bulan = $_POST['bulan'];
							$tahun = $_POST['tahun'];
						 ?>
                        <td>
                            <input type="button" name="cari" class="inputbutton danger" value="Cetak"
                                style="color:black" onclick="cetak()">

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
						if(isset($_POST['carilb'])){
							$qw = $db->get("transaksi.id_transaksi, transaksi.tanggal, petugas.username, detail_transaksi.jumlah_beli, detail_transaksi.subtotal, barang.id_brg, barang.modal, barang.harga","transaksi" ,"INNER JOIN petugas ON transaksi.id_petugas = petugas.id_petugas INNER JOIN detail_transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi INNER JOIN barang ON detail_transaksi.id_brg = barang.id_brg WHERE month(transaksi.tanggal) = '$bulan' AND year(transaksi.tanggal)='$tahun'");
						}else{
                            $qw = $db->get("transaksi.id_transaksi, transaksi.tanggal, petugas.username, detail_transaksi.jumlah_beli, detail_transaksi.subtotal, barang.id_brg, barang.modal, barang.harga","transaksi" ,"INNER JOIN petugas ON transaksi.id_petugas = petugas.id_petugas INNER JOIN detail_transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi INNER JOIN barang ON detail_transaksi.id_brg = barang.id_brg");
						}
						
						foreach($qw as $tampil){
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
                            <button type="submit" name="hapus" class="btn btn-merah"
                                onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i class="fa fa-trash-alt"></i>
                                Hapus</button>
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
<footer class="credit">
    <div>
        <p>&copy; 2023 <a href="#">Kelompok 9</a>. All rights reserved.</p>
    </div>
</footer>
<script type="text/javascript">
function cetak() {
    bulan = $('#bulan').val();
    tahun = $('#tahun').val();

    window.open("content/print_perbulan.php?bulan=" + bulan + "&" + "tahun=" + tahun);
}
</script>