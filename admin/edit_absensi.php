<!-- proses penyimpanan -->

<?php 
	include "../config.php";

	//jika tombol simpan diklik
	if(isset($_POST['btnSimpan']))
	{
		//baca isi inputan form
		$mode = $_POST['mode'];

		//simpan ke tabel karyawan
		$simpan = mysqli_query($conn, "update status set mode='$mode'");
		//jika berhasil tersimpan, tampilkan pesan Tersimpan,
		//kembali ke data karyawan
		if($simpan)
		{
			echo "
				<script>
					alert('Tersimpan');
				</script>
			";
		}
		else
		{
			echo "
				<script>
					alert('Gagal Tersimpan');
				</script>
			";
		}

	}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="../images/check.png" type="image/x-icon">
	<?php include "header.php"; ?>
	<title>Absen - edit mode</title>
</head>
<body>

	<?php include "menu.php"; ?>

	<!-- isi -->
	<div class="container-fluid">
		<h3>edit mode</h3>

		<!-- form input -->
		<form method="POST">
			<div class="form-group">
				<label>No. Status</label>
				<input type="text" name="mode" id="mode" placeholder="pilih mode" class="form-control" style="width: 200px">
			</div>
			</div>

			<button class="btn btn-primary" name="btnSimpan" id="btnSimpan">Simpan</button>
		</form>
	</div>

	<?php include "../footer.php"; ?>

</body>
</html>