<?php
	include "../config.php";

	//baca id data yang akan dihapus
	$id = $_GET['id'];

	//hapus data
	$hapus = mysqli_query($conn, "delete from pengawas where id='$id'");

	//jika berhasil terhapus tampilkan pesan Terhapus
	//kemudian kembali ke data siswa
	if($hapus)
	{
		echo "
			<script>
				alert('Terhapus');
				location.replace('datauser.php');
			</script>
		";
	}
	else
	{
		echo "
			<script>
				alert('Gagal Terhapus');
				location.replace('datauser.php');
			</script>
		";
	}

	$id = $_GET['id'];

	//hapus data
	$hapus = mysqli_query($conn, "delete from pengawas where id='$id'");

	//jika berhasil terhapus tampilkan pesan Terhapus
	//kemudian kembali ke data siswa
	if($hapus)
	{
		echo "
			<script>
				alert('Terhapus');
				location.replace('datauser.php');
			</script>
		";
	}
	else
	{
		echo "
			<script>
				alert('Gagal Terhapus');
				location.replace('datauser.php');
			</script>
		";
	}

?>