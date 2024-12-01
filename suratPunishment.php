<?php
require 'vendor/autoload.php'; // Autoload dari Composer

use Dompdf\Dompdf;
use Dompdf\Options;

// Konfigurasi DOMPDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true); // Untuk mendukung gambar dari URL

$dompdf = new Dompdf($options);

// Koneksi ke database
include "koneksi.php";

// Ambil data dari cookie atau session
$user_id = $_COOKIE['user_id'];

$query = "SELECT d.nama AS dosen, k.nama_kelas, k.prodi, m.nama AS mahasiswa, m.nim, p.pelanggaran 
          FROM riwayat_pelaporan AS rp
          INNER JOIN mahasiswa AS m ON m.mahasiswa_id = rp.mahasiswa_id
          INNER JOIN kelas AS k ON k.kelas_id = m.kelas_id
          INNER JOIN dosen AS d ON d.dosen_id = k.dosen_id
          INNER JOIN pelanggaran AS p ON rp.pelanggaran_id = p.pelanggaran_id
          INNER JOIN [user] AS u ON m.user_id = u.user_id
          WHERE rp.status NOT IN ('Selesai') AND u.user_id = ?";
$params = array($user_id);
$stmt = sqlsrv_prepare($conn, $query, $params);

if (!$stmt) {
    die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_execute($stmt)) {
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $dosen = $row['dosen'];
        $nama_kelas = $row['nama_kelas'];
        $prodi = $row['prodi'];
        $mahasiswa = $row['mahasiswa'];
        $nim = $row['nim'];
        $pelanggaran = $row['pelanggaran'];
    }
}
if (isset($pelanggaran)) {
    // HTML untuk PDF
    $html = "
    <!DOCTYPE html>
    <html lang='id'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Berita Acara DPA dan Mahasiswa</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; margin: 20px;}
            header { text-align: center; margin-bottom: 20px; }
            .float-left {
                            float: left;
                            width: 45%; /* Lebar proporsional */
                            text-align: center;
                        }
            .float-right {
                            float: right;
                            width: 45%; /* Lebar proporsional */
                            text-align: center;
                            margin-top: 42px;
                        }
            .kaprodi {
                        clear: both; /* Pastikan elemen ini berada di bawah elemen float */
                        text-align: center;
                        margin-top: 20px;
                    }
        </style>
    </head>
    <body>
        <header>
            <h3>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</h3>
            <h4>JURUSAN TEKNOLOGI INFORMASI</h4>
            <h4>POLITEKNIK NEGERI MALANG</h4>
            <p>Jl. Soekarno Hatta No.9, Jatimulyo, Lowokwaru, Malang, 65141<br>
               Telp. (0341) 404424 – 404425, Fax (0341) 404420<br>
               <a href='http://www.polinema.ac.id'>http://www.polinema.ac.id</a></p>
        </header>
        <hr>
        <div class='form-section'>
            <p>Pada hari ini, <u>………………</u>, tanggal <u>………………</u>, bulan <u>………………</u>, tahun <u>………………</u>, telah bertemu Dosen Pembina Akademik (DPA):</p>
            <p>Nama: {$dosen}</p>
            <p>DPA Kelas: {$prodi} - {$nama_kelas}</p>
            <p>Melakukan pertemuan dengan orang tua/wali mahasiswa:</p>
            <p>Nama: {$mahasiswa}</p>
            <p>NIM / Kelas: {$nim} / {$nama_kelas}</p>
        </div>
        <div class='form-section'>
            <p>Pertemuan dilakukan karena mahasiswa yang bersangkutan:</p>
            <ul>
                <li>Menerima status SP1 / SP2 / SP3 / SPK / PS</li>
                <li>Melanggar Tata Tertib {$pelanggaran}</li>
                <li>Mendapat nilai tengah semester / akhir semester <u>..............................</u></li>
            </ul>
            <p>Hasil pertemuan memberikan rekomendasi sebagai berikut:</p>
            <p><u>.....................................................................................................................................................</u></p>
            <p><u>.....................................................................................................................................................</u></p>
        </div>
        </br></br></br>
        <div class='signature-section'>
        <div class='float-left'>
                <p>Malang, <u>..............................</u></p>
                <p>DPA</p><br><br><br>
                <p>(....................................................)</p>
                <p>NIP.</p>
            </div>
            <div class='float-right'>
                <p>Mahasiswa</p><br><br><br>
                <p>(....................................................)</p>
            </div>
        </div>
            <div class='kaprodi'>
                <p>Mengetahui</p>
                <p>Kaprodi D4-SIB</p><br><br><br>
                <p>Hendra Pradibta, S.E., M.Sc.</p>
                <p>NIP. 198305212006041003</p>
            </div>
    </body>
    </html>
    ";

    // Load HTML ke DOMPDF
    $dompdf->loadHtml($html);

    // Atur ukuran kertas dan orientasi
    $dompdf->setPaper('A4', 'portrait');

    // Render HTML ke PDF
    $dompdf->render();

    // Output file PDF
    $dompdf->stream("Berita_Acara.pdf", array("Attachment" => false));
} else {
    echo "<script>
        alert('Tidak ada data pelanggaran untuk mahasiswa ini.');
        window.location.href = 'punishmentMhs.php';
    </script>";
}
