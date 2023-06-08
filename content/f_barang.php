<?php 

	include "system/proses.php";
	error_reporting(0);
	if (empty($_GET['id_barang'])){
		$connect = mysqli_connect("localhost", "root", "", "db_penjualan");
		$query = "SELECT max(id_brg) as maxKode FROM barang";
		$hasil = mysqli_query($connect, $query);
		$data = mysqli_fetch_array($hasil);
		$kodebarang = $data['maxKode'];
		$nourut = (int) substr($kodebarang, 3, 3);
		$nourut++;
		$char = "BR";
		$kodebarang = $char . sprintf("%03s", $nourut);
		$sub='simpan';
	}else{
		$kodebarang = $_GET['id_barang'];
		$sub='edit';
	}
	$qr = $db->get("*","barang","WHERE id_brg='$_GET[id_barang]'");
	$tampilnya=$qr->fetch();

	

 ?>



<div class="judul-content">
	<h1>Input Barang</h1>
</div>
<div class="isi-content">
	<form action="crud/simpan_barang.php" method="POST">
		<table>
			<tr>
				<td><label for="id_brg">ID Barang</label></td>
			</tr>
			<tr>
				<td><input type="text" name="id_brg" class="text disable" onkeyup="return validhuruf(this)" autocomplete="off" id="id_brg" value="<?php echo $kodebarang; ?>" readonly></td>
			</tr>


			<tr>
				<td><label for="nama_brg">Nama Barang</label></td>
			</tr>
			<tr>
				<td><input type="text" name="nama_brg" class="text" autocomplete="off" required="" id="nama_brg" value="<?php echo $tampilnya['nama_brg']; ?>" onkeypress="return huruf(event)" placeholder="Harap Memasukkan Nama Beserta Merk"></td>
			</tr>




			<tr>
				<td><label for="jns">Jenis Barang</label></td>
			</tr>
			<tr>
				<td>
					<select name="id_jenis" class="text" id="jns">
						<option value="" disabled selected>Pilih Jenis Barang</option>
						<?php 
							$qw=$db->get("*","jenis","ORDER BY id_jenis ASC");
							foreach( $qw as $tampil_opt ){
						 ?>
						<option <?php if($tampilnya['id_jenis_brg']==$tampil_opt['id_jenis']){echo "selected";}?> value="<?php echo $tampil_opt['id_jenis']; ?>"><?= $tampil_opt['nama_jenis']; ?></option>
						<?php 
							}
						 ?>
					</select>
				</td>
			</tr>
			

			<tr>
				<td><label for="modal">Harga Modal</label></td>
			</tr>
			<tr>
				<td><input type="number" name="modal" class="text" autocomplete="off" required="" id="modal" value="<?php echo $tampilnya['modal']; ?>" onkeypress="return wajibAngka(event)" placeholder="Nominal Rupiah" min="0"></td>
			</tr>


			<tr>
				<td><label for="hrg">Harga Jual Barang</label></td>
			</tr>
			<tr>
				<td><input type="number" name="harga" class="text" autocomplete="off" required="" id="hrg" value="<?php echo $tampilnya['harga']; ?>" onkeypress="return wajibAngka(event)" placeholder="Nominal Rupiah" min="0"></td>
			</tr>


			<tr>
				<td><label for="stok">Stok Barang</label></td>
			</tr>
			<tr>
				<td><input type="number" name="stok" class="text" autocomplete="off" required="" id="stok" value="<?php echo $tampilnya['stok']; ?>" placeholder="Masukkan Jumlah Stok Saat Ini" min="0"></td>
			</tr> 


			<tr>
				<td><input type="submit" name="<?php echo $sub; ?>" value="Simpan" class="simpan" required=""></td>
			</tr>


		</table>
	</form>
</div>
<footer class="credit">
  <div>
    <p>&copy; 2023 <a href="#">Kelompok 9</a>. All rights reserved.</p>
  </div>
</footer>


<script type="text/javascript">
      var rupiah = document.getElementById("");
      rupiah.addEventListener("keyup", function (e) {
        rupiah.value = formatRupiah(this.value, "Rp. ");
      });

      function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
          split = number_string.split(","),
          sisa = split[0].length % 3,
          rupiah = split[0].substr(0, sisa),
          ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
          separator = sisa ? "." : "";
          rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;
        return prefix === undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
      }
    </script>