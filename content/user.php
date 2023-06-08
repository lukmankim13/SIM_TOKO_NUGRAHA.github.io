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
        <h1>User</h1>
    </div>
    <div class="isi-content">
        <input type="text" id="searchInput" placeholder="Cari...">
        <a href="index.php?p=f_user" class="link-tambah-barang">Tambah</a>
        <div class="judul-home">
            <div class="divtabel">
                <table id="myTableUser" class="tabel98">
                    <thead>
                        <tr>
                            <th>No.</th> <!-- Added column for serial number -->
                            <th>ID Petugas</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $qw = $db->get("*", "petugas", "ORDER BY id_petugas ASC");
                        $nomer = 1;
                        foreach ($qw as $tamp_user) {
                        ?>
                        <tr>
                            <td><?= $nomer++; ?></td> <!-- Display the serial number -->
                            <td><?= $tamp_user['id_petugas']; ?></td>
                            <td><?= $tamp_user['username'] ?></td>
                            <td><?= $tamp_user['password']; ?></td>
                            <td><?= $tamp_user['level']; ?></td>
                            <td>
                                <a href="crud/hapus_user.php?idu=<?= $tamp_user['id_petugas']; ?>" class="btn btn-merah"
                                    onclick="return confirm('Yakin Ingin Menghapus ?')"><i class="fa fa-trash-alt"></i>
                                    Hapus</a>
                                <a href="index.php?p=f_user&id_user=<?= $tamp_user['id_petugas']; ?>"
                                    class="btn btn-kuning"><i class="fa fa-user-edit"></i> Edit</a>
                            </td>
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
    <script src="assets/js/searchUser.js"></script>
</body>

</html>