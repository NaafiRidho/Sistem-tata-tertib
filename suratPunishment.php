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
                        <img src='data:image/jpeg;base64,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' alt='Logo' style='width: 110px; height: auto;'>
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
