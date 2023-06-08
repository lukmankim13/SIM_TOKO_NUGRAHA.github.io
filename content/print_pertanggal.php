<?php 
include '../system/proses.php';

function format_rupiah($angka){
    $rupiah = number_format($angka,0,',','.');
    return $rupiah;
}

$tgl_awal =  $_GET['tgl_awal'];
$tgl_akhir =  $_GET['tgl_akhir'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Print Laporan Per Tanggal</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/custom.css">
</head>
<body>
    <div class="judul-content">
    </div>
    <div class="isi-content">
        <div class="judul-home">
            <div class="divtabel">
                <h3 style="text-align: center; font-family: segoe ui;">Laporan Tanggal <?php echo $tgl_awal; ?> Sampai
                    <?php echo $tgl_akhir; ?></h3>
                <table class="tabel98">
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Petugas</th>
                        <th>Id Barang</th>
                        <th>Modal</th>
                        <th>Harga</th>
                        <th>Jumlah Beli</th>
                        <th>Pendapatan Kotor</th>
                        <th>Pendapatan Bersih</th> <!-- New column for profit -->
                    </tr>
                    <?php 
                        $qw = $db->get("transaksi.id_transaksi, transaksi.tanggal, petugas.username, detail_transaksi.jumlah_beli, detail_transaksi.subtotal, barang.id_brg, barang.modal, barang.harga","transaksi" ,"INNER JOIN petugas ON transaksi.id_petugas = petugas.id_petugas INNER JOIN detail_transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi INNER JOIN barang ON detail_transaksi.id_brg = barang.id_brg WHERE transaksi.tanggal >= '$tgl_awal' AND transaksi.tanggal <= '$tgl_akhir'");
                        $total_jumlah_beli = 0; // Total quantity sold
                        $total_pendapatan_kotor = 0; // Total gross revenue
                        $total_pendapatan_bersih = 0; // Total net profit

                        foreach($qw as $tampil){
                            // Calculate profit for each transaction
                            $modal = $tampil['modal'];
                            $total = $tampil['subtotal'];
                            $jml_beli = $tampil['jumlah_beli'];
                            $keuntungan = $total - ($modal * $jml_beli);

                            // Update total values
                            $total_jumlah_beli += $jml_beli;
                            $total_pendapatan_kotor += $total;
                            $total_pendapatan_bersih += $keuntungan;
                    ?>
                    <tr>
                        <td><?php echo $tampil['id_transaksi']; ?></td>
                        <td><?php echo $tampil['tanggal']; ?></td>
                        <td><?php echo $tampil['username']; ?></td>
                        <td><?php echo $tampil['id_brg']; ?></td>
                        <td><?php echo "Rp" .number_format($modal,0,',','.') ; ?></td>   
                        <td><?php echo "Rp" .number_format($tampil['harga'],0,',','.') ; ?></td>   
                        <td><?php echo $jml_beli; ?></td>
                        <td><?php echo "Rp" .number_format($total,0,',','.') ; ?></td> 
                        <td><?php echo "Rp" .number_format($keuntungan,0,',','.') ; ?></td> <!-- Display profit -->
                    </tr>
                    <?php 
                        }
                    ?>
                    <tr>
                        <td colspan="6" style="text-align: right; font-weight: bold;">Total : </td>
                        <td><?php echo $total_jumlah_beli; ?></td>
                        <td  style="font-weight: bold;"><?php echo "Rp" .number_format($total_pendapatan_kotor,0,',','.') ; ?></td>
                        <td  style="font-weight: bold;" ><?php echo "Rp" .number_format($total_pendapatan_bersih,0,',','.') ; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
window.print();
</script>
