<?php
	include "../config.php";

	//baca id data yang akan dihapus
	$id = $_GET['id'];

	//hapus data
	$hapus = mysqli_query($conn, "delete from users where id='$id'");

	//jika berhasil terhapus tampilkan pesan Terhapus
	//kemudian kembali ke data siswa
	if($hapus)
	{
		echo "
			<script>
				alert('Terhapus');
				location.replace('datasiswa.php');
			</script>
		";
	}
	else
	{
		echo "
			<script>
				alert('Gagal Terhapus');
				location.replace('datasiswa.php');
			</script>
		";
	}

	$id = $_GET['id'];

	//hapus data
	$hapus = mysqli_query($conn, "delete from siswa where id='$id'");

	//jika berhasil terhapus tampilkan pesan Terhapus
	//kemudian kembali ke data siswa
	if($hapus)
	{
		echo "
			<script>
				alert('Terhapus');
				location.replace('datasiswa.php');
			</script>
		";
	}
	else
	{
		echo "
			<script>
				alert('Gagal Terhapus');
				location.replace('datasiswa.php');
			</script>
		";
	}

?>