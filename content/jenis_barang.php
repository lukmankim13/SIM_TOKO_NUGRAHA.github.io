<?php 
	include "system/proses.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div class="judul-content">
        <h1>Jenis Barang</h1>
    </div>
    <div class="isi-content">
        <input type="text" id="searchInput" placeholder="Cari...">
        <?php
		if ($_SESSION['level'] == "kasir") {
			echo '<td></td>';
		} else {
            echo '<a href="index.php?p=f_jenis" class="link-tambah-barang">Tambah</a>';
		}
		?>
        <div class="judul-home">
            <div class="divtabel">
                <table id="myTableJenisBarang" class="tabel98">
                    <thead>
                        <tr>
                            <th>No.</th> <!-- Added column for serial number -->
                            <th>ID Jenis</th>
                            <th>Jenis Barang</th>
                            <?php 
                             if ($_SESSION['level']=="kasir" ) { 
                                echo '';
                             }else{
                                echo '<th>Action</th>';
                             }
                             ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
						$qw = $db->get("*", "jenis", "ORDER BY id_jenis ASC");
						$nomer = 1;
						foreach ($qw as $tamp_jenis) {
					 ?>
                        <tr>
                            <td><?= $nomer++; ?></td> <!-- Display the serial number -->
                            <td><?= $tamp_jenis['id_jenis']; ?></td>
                            <td><?= $tamp_jenis['nama_jenis']; ?></td>
                            <?php
								if ($_SESSION['level'] == 'kasir') {
									echo '';
								} else {
                                    echo '<td>';
									echo '<a href="crud/hapus_jenis.php?idj=' . $tamp_jenis['id_jenis'] . '" class="btn btn-merah" onclick="return confirm(\'Yakin Ingin Menghapus Data ?\');"><i class="fa fa-trash-alt"></i> Hapus</a>';
									echo '<a href="index.php?p=f_jenis&id_jenis=' . $tamp_jenis['id_jenis'] . '" class="btn btn-kuning"><i class="fa fa-pen"></i> Edit</a>';
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
        </div>
    </footer>
    <script src="assets/js/searchJenisBarang.js"></script>
</body>

</html>