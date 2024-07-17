<?php
// Load PhpSpreadsheet Library
require 'vendor/autoload.php';
include 'config.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Dapatkan tanggal yang dipilih
if(isset($_POST['tanggal'])) {
    $tanggal = $_POST['tanggal'];
} else {
    // Jika tanggal tidak dipilih, gunakan tanggal saat ini
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date('Y-m-d');
}

// Periksa apakah jabatan telah dipilih
if(isset($_POST['jabatan'])) {
    $jabatan = $_POST['jabatan'];
    // Query data absensi untuk jabatan yang dipilih pada tanggal yang dipilih
    $sql_filter = "";
    if ($jabatan != 'Jabatan') {
        $sql = mysqli_query($conn, "SELECT b.username, a.tanggal, a.jam_masuk, a.jam_istirahat, a.jam_kembali, a.jam_pulang, b.jabatan FROM absensi a, jabatan b WHERE a.password=b.password AND a.tanggal='$tanggal' AND b.jabatan='$jabatan'");
        // Buat judul file yang akan diunduh
        $filename = "laporan_rekap_absensi/Rekapitulasi_Absensi_$jabatan $tanggal.xlsx";
    } else {
        $sql = mysqli_query($conn, "SELECT b.username, a.tanggal, a.jam_masuk, a.jam_istirahat, a.jam_kembali, a.jam_pulang, b.jabatan FROM absensi a, jabatan b WHERE a.password=b.password AND a.tanggal='$tanggal'");
        // Buat judul file yang akan diunduh
        $filename = "laporan_rekap_absensi/Rekapitulasi_Absensi_Staff_$tanggal.xlsx";
    }
    // Create New Spreadsheet
    $spreadsheet = new Spreadsheet();

    // Set Active Sheet
    $sheet = $spreadsheet->getActiveSheet();

    // Set Header
    $sheet->setCellValue('A1', 'No.')
          ->setCellValue('B1', 'Nama')
          ->setCellValue('C1', 'Tanggal')
          ->setCellValue('D1', 'Jam Masuk')
          ->setCellValue('E1', 'Jam Istirahat')
          ->setCellValue('F1', 'Jam Kembali')
          ->setCellValue('G1', 'Jam Pulang');

    // Set Data
    $no = 0;
    $row = 2;
    while($data = mysqli_fetch_array($sql))
    {
        $no++;
        $sheet->setCellValue('A'.$row, $no)
              ->setCellValue('B'.$row, $data['username'])
              ->setCellValue('C'.$row, $data['tanggal'])
              ->setCellValue('D'.$row, $data['jam_masuk'])
              ->setCellValue('E'.$row, $data['jam_istirahat'])
              ->setCellValue('F'.$row, $data['jam_kembali'])
              ->setCellValue('G'.$row, $data['jam_pulang']);
        $row++;
    }

    // Set Title
    $sheet->setTitle('Rekapitulasi Absensi');

    // Set Properties
    $spreadsheet->getProperties()->setCreator('BIMO')->setLastModifiedBy('BIMO')->setTitle('Rekapitulasi Absensi')->setSubject('Rekapitulasi Absensi')->setDescription('Rekapitulasi Absensi')->setKeywords('rekapitulasi, absensi, php, excel');

    // Create Excel File
    $writer = new Xlsx($spreadsheet);

    // Save Excel File
    $writer->save($filename);

    // Download Excel File
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
}else {
        // Jika jabatan tidak dipilih, tampilkan form input jabatan
        echo '<div class="form-group">
        <form method="post">
        <label for="jabatan">jabatan / Staff</label>
        <select class="form-control" id="jabatan" name="jabatan">
			<option value="Semua">Semua</option>
			<option value="Staff">Staff</option>
			<option value="Wali Kelas">Wal Kelas</option>
			<option value="Kepala Sekolah">Kepala Sekolah</option>
			<option value="Bendahara">Bendahara</option>
        </select>
        <br>
        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal">
        <br>
        <input type="submit" name="submit" class="btn btn-primary" value="Print">
        </form>
        </div>';
        }?>