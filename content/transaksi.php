<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <style>
        /* Gaya-gaya CSS lainnya */
    </style>
</head>
<body onload="buka_tab()">
    <?php
    include "system/proses.php";

    $tgl = date('Y-m-d');
    // Nomor Transaksi
    $connect = mysqli_connect("localhost", "root", "", "db_penjualan");
    $query = "SELECT max(id_transaksi) as maxKode FROM transaksi";
    $hasil = mysqli_query($connect, $query);
    $data = mysqli_fetch_array($hasil);
    $kodebarang = $data['maxKode'];
    $nourut = (int) substr($kodebarang, 3, 3);
    $nourut++;
    $char = "TR";
    $nomot = $char . sprintf("%03s", $nourut);
    $id_ptg = $_SESSION['login_id'];
    ?>

    <div class="judul-content">
        <h1>Transaksi</h1>
    </div>

    <div class="isi-content">
        <form action="crud/simpan_transaksi.php" method="POST">
            <input type="hidden" name="id_user" value="<?php echo $id_ptg; ?>">
            <br>

            <table>
                <!-- Isi form transaksi -->
                <tr>
                    <td><label>ID Transaksi</label></td>
                    <td><br></td>
                    <td><input type="text" name="id_transaksi" id="id_transaksi" class="text disable" readonly
                            value="<?= $nomot; ?>"></td>
                </tr>

                <tr>
                    <td><label>Tanggal Transaksi</label></td>
                    <td><br></td>
                    <td><input type="text" name="tanggal" id="tanggal" class="text disable" value="<?= $tgl; ?>"
                            readonly></td>
                </tr>

            </table>
            <table>
                <tr>
                    <td>
                        <center><label>ID Barang</label></center>
                    </td>
                    <td>
                        <center><label>Nama Barang</label></center>
                    </td>
                    <td>
                        <center><label>Harga</label></center>
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="text" name="id_barang" class="textkecil" id="id_barang" autocomplete="off"
                            onkeyup="idb()">
                    </td>
                    <td>
                        <input type="text" name="nama_barang" id="nama_barang" class="textkecil disable" readonly>
                    </td>
                    <td>
                        <input type="number" name="harga" id="harga" class="textkecil disable" oninput="formatInput()" readonly >
                    </td>
                </tr>

                <tr>
                    <td>
                        <center><label>Jumlah</label></center>
                    </td>
                    <td>
                        <center><label>Total</label></center>
                    </td>
                    <td></td>
                </tr>

                <tr>
                    <td>
                        <input type="number" name="jumlah" id="jumlah" class="textkecil" autocomplete="off" min="0"
                            onkeyup="t()">
                    </td>
                    <td>
                        <input type="number" name="total" id="total" class="textkecil disable" readonly>
                    </td>
                    <td>
                        <center><input type="button" name="simpan" class="simpantrans btn-biru" value="Simpan"
                                onclick="simpan_detail()"></center>
                    </td>
                </tr>

            </table>
            <!-- Table -->
            <!-- Table -->
            <div id="kotak-detail"></div>
            <br>

            <table>
                <tr>
                    <td>
                        <center><label for="subtotal">Sub Total</label></center>
                    </td>
                    <td>
                        <center><label for="totalbayar">Total Bayar</label></center>
                    </td>
                </tr>
                <tr>
                    <td><input type="number" name="subtotal" id="subtotal" class="textkecil disable" readonly>
                    </td>
                    <td><input type="number" name="totalbayar" id="totalbayar" class="textkecil disable"  readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        <center><label for="bayar">Bayar</label></center>
                    </td>
                    <td>
                        <center><label for="kembali">Kembali</label></center>
                    </td>
                </tr>
                <tr>
                    <td><input type="numberzzz" name="bayar" id="bayar" class="textkecil" onkeyup="byr()" oninput="formatInput()" required="" min="0">
                    </td>
                    <td><input type="number" name="kembali" id="kembali" class="textkecil disable" readonly>
                    </td>
                    <td><input type="submit" name="simpan" value="Transaksi" class="simpantrans"></td>
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

            var rupiah = document.getElementById('bayar');
            rupiah.addEventListener('keyup', function(e){
                rupiah.value = formatRupiah(this.value, 'Rp. ');
            })

            function formatRupiah(angka, prefix){
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split =number_string.split(' , '),
                sisa =split[0].length % 3,
                rupiah =split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                
                if(ribuan){
                    separator = sisa ? ' . ' : ' ' ;
                    rupiah +=separator +ribuan.join('. ');
                }

                rupiah = split[1] != underfined ? rupiah + ' , ' +split[1] : rupiah;
                return prefix ==underfined ? rupiah : (rupiah ? 'Rp. ' + rupiah : ' ');
            }

    </script>
</body>
</html>
