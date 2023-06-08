<?php 
	include "../system/proses.php";
	
	
	if(isset($_POST['simpan'])){
		$simpan=$db->insert("transaksi","'$_POST[id_transaksi]',
									'$_POST[tanggal]',
									'$_POST[id_user]',
									'$_POST[total]',
									'$_POST[bayar]'");
		if($simpan){
			echo "<script>alert('Transaksi Berhasil')</script>";
			echo "<script>document.location.href='../index.php?p=transaksi'</script>";
			

		}else{
			echo "<script>alert('Transaksi Gagal')</script>";
			echo "<script>document.location.href='../index.php?p=transaksi'</script>";
		}
	}
 ?>