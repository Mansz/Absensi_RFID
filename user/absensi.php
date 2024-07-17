<?php 
 
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rekapitulasi Absen Siswa</title>
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
                        <h1 class="m-0">Rekapitulasi Absen Siswa</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <form method="post">
                    <div class="form-group mb-3">
                        <label for="kelas">Kelas</label>
                        <select class="form-control" id="kelas" name="kelas">
                            <option value="Semua">Semua</option>
                            <option value="7-A">7 A</option>
                            <option value="7-B">7 B</option>
                            <option value="7-C">7 C</option>
                            <option value="7-D">7 D</option>
                            <option value="7-E">7 E</option>
                            <option value="8-A">8 A</option>
                            <option value="8-B">8 B</option>
                            <option value="8-C">8 C</option>
                            <option value="8-D">8 D</option>
                            <option value="8-E">8 E</option>
                            <option value="9-A">9 A</option>
                            <option value="9-B">9 B</option>
                            <option value="9-C">9 C</option>
                            <option value="9-D">9 D</option>
                            <option value="9-E">9 E</option>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Tampilkan</button>
                </form>
            </div>
        </div>
    </div>
    <br>

    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px; text-align: center">No.</th>
                        <th style="text-align: center">Nama</th>
                        <th style="text-align: center">Tanggal</th>
                        <th style="text-align: center">Jam Masuk</th>
                        <th style="text-align: center">Jam Istirahat</th>
                        <th style="text-align: center">Jam Kembali</th>
                        <th style="text-align: center">Jam Pulang</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include "../config.php";
                        
                        
                        date_default_timezone_set('Asia/Jakarta');
                        $tanggal = date('Y-m-d');
                        if (isset($_POST['submit'])) {
                            $kelas = $_POST['kelas'];
                            if($kelas == 'Semua') {
                                $sql = mysqli_query($conn, "SELECT b.username, a.tanggal, a.jam_masuk, a.jam_istirahat, a.jam_kembali, a.jam_pulang
                                                            FROM absensi a, users b
                                                            WHERE a.password=b.password AND a.tanggal='$tanggal'");
                            } else {
                                $sql = mysqli_query($conn, "SELECT b.username, a.tanggal, a.jam_masuk, a.jam_istirahat, a.jam_kembali, a.jam_pulang
                                                            FROM absensi a, users b
                                                            WHERE a.password=b.password AND a.tanggal='$tanggal' AND b.kelas='$kelas'");
                            }
                        } else {
                            $sql = mysqli_query($conn, "SELECT b.username, a.tanggal, a.jam_masuk, a.jam_istirahat, a.jam_kembali, a.jam_pulang
                                                        FROM absensi a, users b
                                                        WHERE a.password=b.password AND a.tanggal='$tanggal'");
                        }
                        $no = 0;
                        while($data = mysqli_fetch_array($sql)) {
                            $no++;
                    ?>
                    <tr>
                        <td data-label="No."><?php echo $no; ?></td>
                        <td data-label="Nama"><?php echo $data['username']; ?></td>
                        <td data-label="Tanggal"><?php echo $data['tanggal']; ?></td>
                        <td data-label="Jam Masuk"><?php echo $data['jam_masuk']; ?></td>
                        <td data-label="Jam Istirahat"><?php echo $data['jam_istirahat']; ?></td>
                        <td data-label="Jam Kembali"><?php echo $data['jam_kembali']; ?></td>
                        <td data-label="Jam Pulang"><?php echo $data['jam_pulang']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    



    <!-- REQUIRED SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
</body>
</html>
