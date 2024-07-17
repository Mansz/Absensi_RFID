<?php 
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="../images/check.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Absensi RFID</title>
    <link rel="icon" href="../images/.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
    <style>
        .login-text {
            font-size: 30px;
            font-weight: 900;
            text-align: center;
            margin-top: 20px;
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
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-user"></i>
                    <?php echo $_SESSION['username']; ?> <span class="caret"></span>
                </a>
            </li>
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
                        <a href="datauser.php" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p> Data User </p>
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
        
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <p class="login-text">Selamat Datang Di Dashboard Admin</p>
            </div>
            <div class="container-fluid mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST">
                                    <div class="form-group mb-3">
                                        <label for="mode">Silahkan Pilih Mode Absensi</label>
                                        <select class="form-control" id="mode" name="mode">
                                            <option value="1">Jam Masuk</option>
                                            <option value="2">Jam Istirahat</option>
                                            <option value="3">Jam Kembali</option>
                                            <option value="4">Jam Pulang</option>
                                        </select>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary" name="btnSimpan" id="btnSimpan">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    
    <!-- /.content-wrapper -->

    
    <?php
    include "../config.php";
    if(isset($_POST['btnSimpan'])) {
        $mode = $_POST['mode'];
        $simpan = mysqli_query($conn, "UPDATE status SET mode='$mode'");
        if($simpan) {
            echo "<script>alert('Tersimpan');</script>";
        } else {
            echo "<script>alert('Gagal Tersimpan');</script>";
        }
    }
    ?>

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5.3.0 -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>

</body>
</html>
