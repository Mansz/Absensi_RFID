<?php 
    include "../config.php";

    //baca ID data yang akan di edit
    $id = $_GET['id'];

    //baca data guru berdasarkan id
    $cari = mysqli_query($conn, "SELECT * FROM guru WHERE id='$id'");
    $hasil = mysqli_fetch_array($cari);

    //jika tombol simpan diklik
    if(isset($_POST['btnSimpan']))
    {
        //baca isi inputan form
        $password = $_POST['password'];
        $username = $_POST['username'];
        $jabatan = $_POST['jabatan'];

        // handle file upload
        $foto = $hasil['foto']; // default to existing photo
        if(isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != '') {
            $target_dir = "../foto/";
            $foto = basename($_FILES["foto"]["name"]);
            $target_file = $target_dir . $foto;
            move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
        }

        //simpan ke tabel guru dengan prepared statement
        $stmt = $conn->prepare("UPDATE guru SET password=?, username=?, jabatan=?, foto=? WHERE id=?");
        $stmt->bind_param("ssssi", $password, $username, $jabatan, $foto, $id);

        if($stmt->execute())
        {
            echo "
                <script>
                    alert('Tersimpan');
                    location.replace('dataguru.php');
                </script>
            ";
        }
        else
        {
            echo "
                <script>
                    alert('Gagal Tersimpan');
                    location.replace('dataguru.php');
                </script>
            ";
        }

        $stmt->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Guru</title>
    <link rel="icon" href="../images/pan2.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
    <style>
        .table thead th {
            background-color: #343a40;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f5f5f5;
        }
        .btn {
            margin: 5px;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-title {
            font-size: 2rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fa fa-sign-out"></i> Logout
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index.php" class="brand-link">
            <img src="../images/pan2.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">SISENSI</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">
                            <i class="nav-icon fa fa-home"></i>
                            <p> Home </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="datasiswa.php" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p> Data Siswa </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="dataguru.php" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p> Data Guru </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="absensi.php" class="nav-link">
                            <i class="nav-icon fa fa-calendar-check-o"></i>
                            <p> Rekap Siswa </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="absen.guru.php" class="nav-link">
                            <i class="nav-icon fa fa-calendar"></i>
                            <p> Rekap Guru </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="history.php" class="nav-link">
                            <i class="nav-icon fa fa-history"></i>
                            <p> Riwayat Siswa </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="history.guru.php" class="nav-link">
                            <i class="nav-icon fa fa-history"></i>
                            <p> Riwayat Guru </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> Edit Data Guru </h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container">
                <div class="form-container">
                    

                    <!-- form input -->
                    <form action="" method="POST" class="login-email" enctype="multipart/form-data">
                        <div class="form-group">
                            <h4>Nama</h4>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Nama Guru" style="width: 500px" value="<?php echo $hasil['username']; ?>">
                        </div>
                        <div class="form-group">
                            <h4>Jabatan</h4>
                            <input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="Jabatan" style="width: 500px" value="<?php echo $hasil['jabatan']; ?>">
                        </div>
                        <div class="form-group">
                            <h4>No. Kartu</h4>
                            <input type="text" name="password" id="password" class="form-control" placeholder="Nomor Kartu RFID" style="width: 300px" value="<?php echo $hasil['password']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <?php if ($hasil['foto'] != ''): ?>
                                <br>
                                <img src="../foto/<?php echo $hasil['foto']; ?>" alt="Foto Guru" width="100"><br>
                            <?php endif; ?>
                            <input type="file" name="foto" id="foto" class="form-control-file" style="width: 200px">
                        </div>

                        <button type="submit" class="btn btn-primary" name="btnSimpan" id="btnSimpan">Simpan</button>
                        <a href="index.php" class="btn btn-warning">Cancel</a>
                    </form>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5.3.0 -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>
</html>

