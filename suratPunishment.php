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

// Format tanggal Indonesia
function formatTanggalIndonesia($tanggal)
{
    $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
    $formatter->setPattern('EEEE, d MMMM yyyy');
    return $formatter->format(new DateTime($tanggal));
}

// Tanggal hari ini
$tanggal_hari_ini = formatTanggalIndonesia(date('Y-m-d'));

if (isset($_GET['pelanggaran_id'])) {
    $pelanggaran_id = $_GET['pelanggaran_id'];

    $query = "SELECT d.nama AS dosen, k.nama_kelas, k.prodi, m.nama AS mahasiswa, m.nim, p.pelanggaran, rp.tanggal
              FROM riwayat_pelaporan AS rp
              INNER JOIN mahasiswa AS m ON m.mahasiswa_id = rp.mahasiswa_id
              INNER JOIN kelas AS k ON k.kelas_id = m.kelas_id
              INNER JOIN dosen AS d ON d.dosen_id = k.dosen_id
              INNER JOIN pelanggaran AS p ON rp.pelanggaran_id = p.pelanggaran_id
              INNER JOIN [user] AS u ON m.user_id = u.user_id
              WHERE rp.status NOT IN ('Selesai') AND rp.pelaporan_id = ?";
    $params = array($pelanggaran_id);
    $stmt = sqlsrv_prepare($conn, $query, $params);

    if (!$stmt) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($stmt)) {
        $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        if ($data) {
            $dosen = htmlspecialchars($data['dosen']);
            $nama_kelas = htmlspecialchars($data['nama_kelas']);
            $prodi = htmlspecialchars($data['prodi']);
            $mahasiswa = htmlspecialchars($data['mahasiswa']);
            $nim = htmlspecialchars($data['nim']);
            $pelanggaran = htmlspecialchars($data['pelanggaran']);

            // HTML untuk PDF
            $html = "<html lang='id'><body>
            <div style='font-family: Arial, sans-serif; font-size: 14px;'>
                <div style='text-align: center; position: relative;'>
                                    <div style='position: absolute; top: 0; left: 0;'>
                        <img src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSgOk1o9DKh__qOFazj2DSIJx7nP6Ei4C_eHA&s' alt='Logo' style='width: 110px; height: auto;'>
                    </div>
                    <div style='margin-left: 100px;'>
                        <h3 style='margin: 0; font-size: 18px;'>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</h3>
                        <h3 style='margin: 0; font-size: 18px;'>JURUSAN TEKNOLOGI INFORMASI</h3>
                        <h3 style='margin: 0; font-size: 18px;'>POLITEKNIK NEGERI MALANG</h3>
                        <p style='margin: 0; font-size: 12px;'>Jl. Soekarno Hatta No.9 Jatimulyo, Lowokwaru, Malang, 65141</p>
                        <p style='margin: 0; font-size: 12px;'>Telp. (0341) 404424 - 404425, Fax (0341) 404420</p>
                        <p style='margin: 0; font-size: 12px;'>http://www.polinema.ac.id</p>
                    </div>
                    <hr style='margin-top: 10px; height: 2px; background-color: black;'>
                </div>
    
                <h2 style='text-align: center; margin-top: 20px; font-size: 18px;'>BERITA ACARA</h2>
                <h3 style='text-align: center; font-size: 16px;'>PERTEMUAN DPA DENGAN WALI MAHASISWA</h3>
    
                <p>Pada hari ini, {$tanggal_hari_ini}, telah bertemu Dosen Pembina Akademik (DPA):</p>
                <p>Nama: {$dosen}</p>
                <p>DPA Kelas: {$nama_kelas}</p>
    
                <p>Melakukan pertemuan dengan orang tua/wali mahasiswa:</p>
                <p>Nama: {$mahasiswa}</p>
                <p>NIM/Kelas: {$nim} / {$nama_kelas}</p>
    
                <p>Pertemuan dilakukan karena mahasiswa yang bersangkutan:</p>
                <ol>
                    <li>Menerima status SP1 / SP2 / SP3 / SPK / PS</li>
                    <li>Melanggar Tata Tertib: {$pelanggaran}</li>
                    <li>Mendapat nilai tengah semester/akhir semester ...............</li>
                </ol>
    
                <p>Hasil pertemuan memberikan rekomendasi sebagai berikut:</p>
                <p>.....................................................................................................................................................</p>
                <p>.....................................................................................................................................................</p>
    
                <table style='width: 100%; margin-top: 40px; font-size: 14px;'>
                    <tr>
                        <td style='text-align: left; width: 33%;'>
                            <p>DPA</p>
                            <p style='margin-top: 100px;'>.........................................</p>
                            <p style='margin-bottom: 155px'>NIP.</p>
                        </td>
                        <td style='text-align: center; width: 33%; padding-top: 100px;'>
                            <p>Mengetahui</p>
                            <p>Kaprodi D4-SIB</p>
                            <p style='margin-top: 90px;'>Hendra Pradibta, S.E., M.Sc.</p>
                            <p>NIP. 198305212006041003</p>
                        </td>
    
                        <td style='text-align: right; width: 33%;'>
                            <p>Malang, ..........</p>
                            <p>Mahasiswa</p>
                            <p style='margin-top: 80px; margin-bottom: 200px'>.........................................</p>
                        </td>
                    </tr>
                </table>
            </div>
        </body></html>";

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
                alert('Data pelanggaran tidak ditemukan.');
                window.location.href = 'punishmentMhs.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Gagal mengeksekusi query.');
            window.location.href = 'punishmentMhs.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Pelaporan ID tidak ditemukan.');
        window.location.href = 'punishmentMhs.php';
    </script>";
}
