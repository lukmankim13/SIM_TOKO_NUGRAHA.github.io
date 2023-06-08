<?php 
	include "system/proses.php";

    function format_rupiah($angka){
        $rupiah = number_format($angka,0,',','.');
        return $rupiah;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <div class="judul-content">
        <h1>Barang</h1>
    </div>
    <div class="isi-content">
        <input type="text" id="searchInput" placeholder="Cari...">
        <?php
		if($_SESSION['level']=="kasir") {
			echo '<td></td>';
		} else {
		 	echo '<a href="index.php?p=f_barang" class="link-tambah-barang">Tambah</a>';
		}
		?>
        <div class="judul-home">
            <div class="divtabel">
                <table id="myTable" class="tabel98">
                    <thead>
                        <tr>
                            <th>No</th> <!-- Added column for serial number -->
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Modal</th>
                            <th>Stok</th>
                            <th>Jenis Barang</th>
                            <?php
                            if($_SESSION['level']=="kasir"){
                                echo '';
                            }else{
                                echo '<th>Action</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
						$qw = $db->get("barang.id_brg, barang.nama_brg, jenis.nama_jenis, barang.harga, barang.modal, barang.stok","barang","INNER JOIN jenis on barang.id_jenis_brg = jenis.id_jenis ORDER BY barang.id_brg ASC");
						$nomer = 1;
						foreach($qw as $tamp_barang) {
					 ?>
                        <tr>
                            <td><?= $nomer++; ?></td> <!-- Display the serial number -->
                            <td><?= $tamp_barang['id_brg']; ?></td>
                            <td><?= $tamp_barang['nama_brg']; ?></td>
                            <td><?php echo "Rp" .number_format($tamp_barang['harga'],0,',','.'); ?></td>
                            <td><?php echo "Rp" .number_format($tamp_barang['modal'],0,',','.'); ?></td>
                            <td><?= $tamp_barang['stok']; ?></td>
                            <td><?= $tamp_barang['nama_jenis']; ?></td>

                            <?php
								if($_SESSION['level'] == 'kasir') {
									echo '';
                                } else {
                                    echo '<td>';
									echo '<a href="crud/hapus_barang.php?idb=' . $tamp_barang['id_brg'] . '" class="btn btn-merah" onclick="return confirm(\'Yakin Ingin Menghapus Data ?\')" disabled><i class="fa fa-trash-alt"></i> Hapus</a>';
                                    echo '<a href="index.php?p=f_barang&id_barang=' . $tamp_barang['id_brg'] . '" class="btn btn-kuning"><i class="fa fa-pen"></i> Edit</a>';
                                    echo '</td>';
                                }
								?>
                        </tr>
                        <?php 
						}
					 ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <footer class="credit">
        <div>
            <p>&copy; 2023 <a href="#">Kelompok 9</a>. All rights reserved.</p>
            <?php
// Mengambil data barang dari database
$qw = $db->get("barang.id_brg, barang.nama_brg, jenis.nama_jenis, barang.harga, barang.modal, barang.stok","barang","INNER JOIN jenis on barang.id_jenis_brg = jenis.id_jenis ORDER BY barang.id_brg ASC");
$nomer = 1;
$total_barang = 0; // Inisialisasi variabel total_barang

foreach($qw as $tamp_barang) {
    $total_barang += $tamp_barang['stok']; // Menambahkan nilai stok ke total_barang
    // ...
}

echo "Total Stok Barang: " . $total_barang;
?>

        </div>
    </footer>
    <script src="assets/js/searchbarang.js"></script>
</body>

</html>