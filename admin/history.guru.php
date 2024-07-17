<?php 
 
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: tap.guru.php");
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Riwayat Absen Guru</title>
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
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Riwayat Absen Guru</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

    <!-- isi -->
    <div class="container-logout">
        <form method="post">
            <div class="form-group mb-3">
                <label for="jabatan">Jabatan</label>
                <select class="form-control" id="jabatan" name="jabatan">
                    <option value="Staff">Staff</option>
                    <option value="Wali Kelas">Wali Kelas</option>
                    <option value="Kepala Sekolah">Kepala Sekolah</option>
                    <option value="Bendahara">Bendahara</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="tanggal">Tanggal:</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal">
            </div>
            <div class="btn-container mb-3">
                <input type="submit" name="submit" class="btn btn-primary" value="Tampilkan">
                <button onclick="printTable()" class="btn btn-primary">Print</button>
            </div>
        </form>
    </div>
    <br>
    <?php
include "../config.php";

if (isset($_POST['submit'])) {
    $tanggal = $_POST['tanggal'];
    $jabatan = $_POST['jabatan'];

    if ($jabatan == 'Semua') {
        $sql = "SELECT b.username, a.tanggal, a.jam_masuk, a.jam_istirahat, a.jam_kembali, a.jam_pulang
                FROM absensi a, guru b
                WHERE a.password = b.password AND a.tanggal = '$tanggal'";
    } else {
        $sql = "SELECT b.username, a.tanggal, a.jam_masuk, a.jam_istirahat, a.jam_kembali, a.jam_pulang
                FROM absensi a, guru b
                WHERE a.password = b.password AND a.tanggal = '$tanggal' AND b.jabatan = '$jabatan'";
    }

    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
?>
        <div class="table-responsive">
            
            <table class="table table-bordered" id="attendanceTable">
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
        $no = 0;
        while ($data = mysqli_fetch_array($query)) {
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
<?php 
        } 
?>
                </tbody>
            </table>
        </div>
    </center>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.min.js"></script>
    <script>
            function printTable() {
                var printContents = document.getElementById('attendanceTable').outerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>
        <?php
    } else {
        echo "<h3>Tidak ada data pada jabatan $jabatan pada tanggal $tanggal</h3>";
    }
}
?>
</body>
</html>


