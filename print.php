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

// Periksa apakah kelas telah dipilih
if(isset($_POST['kelas'])) {
    $kelas = $_POST['kelas'];
    // Query data absensi untuk kelas yang dipilih pada tanggal yang dipilih
    $sql_filter = "";
    if ($kelas != 'Staff') {
        $sql = mysqli_query($conn, "SELECT b.username, a.tanggal, a.jam_masuk, a.jam_istirahat, a.jam_kembali, a.jam_pulang, b.kelas FROM absensi a, users b WHERE a.password=b.password AND a.tanggal='$tanggal' AND b.kelas='$kelas'");
        // Buat judul file yang akan diunduh
        $filename = "laporan_rekap_absensi/Rekapitulasi_Absensi_$kelas $tanggal.xlsx";
    } else {
        $sql = mysqli_query($conn, "SELECT b.username, a.tanggal, a.jam_masuk, a.jam_istirahat, a.jam_kembali, a.jam_pulang, b.kelas FROM absensi a, users b WHERE a.password=b.password AND a.tanggal='$tanggal'");
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
        // Jika kelas tidak dipilih, tampilkan form input kelas
        echo '<div class="form-group">
        <form method="post">
        <label for="kelas">Kelas / Staff</label>
        <select class="form-control" id="kelas" name="kelas">
        <option value="Staff">Staff</option>
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
        <br>
        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal">
        <br>
        <input type="submit" name="submit" class="btn btn-primary" value="Print">
        </form>
        </div>';
        }?>