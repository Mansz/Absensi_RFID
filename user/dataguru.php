<?php 
include '../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Guru</title>
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
                        <h1 class="m-0">Data Guru</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form method="GET" action="">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="search" placeholder="Search by name" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                        </div>
                        <div class="col-md-4" style="float:right;margin-right:25px;">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="icon-calendar22"></i></div>
                                <select class="form-control" name="year">
                                    <option value="">Tahun</option>
                                    <?php 
                                    $current_year = date('Y');
                                    for ($i = $current_year; $i >= 2024; $i--) { ?>
                                        <option value="<?php echo $i; ?>" <?php echo (isset($_GET['year']) && $_GET['year'] == $i) ? 'selected' : ''; ?>>Tahun <?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Pencarian Nama</button>
                        </div>
                                <div class="d-flex justify-content-end">
                                    <a href="add.guru.php" class="btn btn-primary"><i class="fa fa-user"></i>Tambah Data</a>
                                    </div>

                    
                    </a>
                </div>
                    </div>
                </form>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="text-align: center">No.</th>
                        <th style="text-align: center">No Kartu</th>
                        <th style="text-align: center">Nama</th>
                        <th style="text-align: center">Jabatan</th>
                        <th style="text-align: center">Foto</th>
                        <th style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Koneksi ke database
                        include "../config.php";

                        // Pagination setup
                        $limit = 10;
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $start = ($page - 1) * $limit;

                        // Search and filter setup
                        $search = isset($_GET['search']) ? $_GET['search'] : '';
                        $year = isset($_GET['year']) ? $_GET['year'] : '';

                        // Query with search and filter
                        $query = "SELECT * FROM guru WHERE username LIKE '%$search%'";
                        if ($year) {
                            $query .= " AND YEAR(created_at) = '$year'";
                        }
                        $query .= " ORDER BY id DESC LIMIT $start, $limit";
                        $sql = mysqli_query($conn, $query);

                        // Count total records for pagination
                        $count_query = "SELECT COUNT(*) as total FROM guru WHERE username LIKE '%$search%'";
                        if ($year) {
                            $count_query .= " AND YEAR(created_at) = '$year'";
                        }
                        $count_result = mysqli_query($conn, $count_query);
                        $total = mysqli_fetch_assoc($count_result)['total'];
                        $pages = ceil($total / $limit);

                        $no = $start;
                        if ($sql->num_rows > 0) {
                            while ($row = $sql->fetch_assoc()) {
                                $no++;
                                echo "<tr>
                                <td style='text-align: center'>{$no}</td>
                                <td>{$row['password']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['jabatan']}</td>
                                <td style='text-align: center'> <img src='../foto/{$row['foto']}' width='100px' height='100px'></td>
                                <td style='text-align: center'>
                                    <a href='edit.guru.php?id={$row['id']}' class='btn btn-success'>
                                    <i class='fa fa-edit'></i> Edit</a>
                                    <a href='hapus.guru.php?id={$row['id']}' class='btn btn-warning'>
                                    <i class='fa fa-trash'></i> Hapus</a>
                                </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' style='text-align: center'>Tidak ada data</td></tr>";
                        }

                        $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $pages; $i++) { ?>
                    <li class="page-item <?php if($page == $i) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>&year=<?php echo $year; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>

        
    </div>

    <!-- REQUIRED SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
</body>
</html>
