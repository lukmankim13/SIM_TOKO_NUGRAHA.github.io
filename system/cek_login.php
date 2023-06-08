<?php 
	session_start();
	require "proses.php";

	//connet ulang to db
	$server = 'localhost';
	$user = 'root';
	$psw = '';
	$dbname = 'db_penjualan';
	$con = mysqli_connect("$server","$user","$psw","$dbname");
	
	if(isset($_POST['submit'])){
		
		$username = $_POST['username'];
		$password = $_POST['password'];

		// to prevent from mysqli injection
		$username = stripcslashes($username);
		$password = stripcslashes($password);
		$username= mysqli_real_escape_string($con,$username);
		$password= mysqli_real_escape_string($con,$password);
		 
		$result = $db->get("*","petugas","WHERE username='$username' AND password='$password'");
		$row = $result->rowCount();
		$data = $result->fetch();
		if( $row > 0){
			$_SESSION['login']=$data['id_petugas'];
			$_SESSION['login_id'] = $data['id_petugas'];
			$_SESSION['username'] = $data['username'];
			$_SESSION['level'] = $data['level'];
			echo "<script>document.location.href='../index.php'</script>";
		}else{
			echo "<script>alert('Username atau Password Salah')</script>";
		    echo "<script>document.location.href='../login.php'</script>";
		}
	}
 ?>