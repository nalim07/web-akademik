<?php
include '../koneksi.php';
require '../vendor/autoload.php';

// include autoloader
// require_once '../dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// Set memory limit and execution time
ini_set('memory_limit', '512M');
ini_set('max_execution_time', 300);

// Jika terjadi error load pada print pdf, jalankan ini. Dengan cara ctrl + / (untuk membuka komentar)
// ob_clean();
// flush();

// instantiate and use the dompdf class
$dompdf = new Dompdf();

// Enable remote file access
$options = $dompdf->getOptions();
$options->set('isRemoteEnabled', true);
$dompdf->setOptions($options);

// Ambil ID dari parameter URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query untuk mengambil data sesuai ID
$query = "SELECT nama_siswa, nis, kelas, semester, catatan_perkembangan, pengetahuan_islam, perkembangan_seni, perkembangan_fisik_motorik, perkembangan_kognitif, perkembangan_bahasa, perkembangan_sosial_emosional, berat_badan, tinggi_badan, lingkar_kepala, lingkar_lengan, rambut, mata, telinga, hidung, mulut, gigi, kulit, kuku, tangan, kaki, sakit, izin, tanpa_keterangan FROM tbl_nilai WHERE id = $id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nama_anak = $row['nama_siswa'];
    $nomor_induk = $row['nis'];
    $kelas = $row['kelas'];
    $semester = $row['semester'];
    $catatan = $row['catatan_perkembangan'];
    $pengetahuan_islam = $row['pengetahuan_islam'];
    $perkembangan_fisik_motorik = $row['perkembangan_fisik_motorik'];
    $perkembangan_kognitif = $row['perkembangan_kognitif'];
    $perkembangan_bahasa = $row['perkembangan_bahasa'];
    $perkembangan_sosial_emosional = $row['perkembangan_sosial_emosional'];
    $perkembangan_seni = $row['perkembangan_seni'];
    $berat_badan = $row['berat_badan'];
    $tinggi_badan = $row['tinggi_badan'];
    $lingkar_kepala = $row['lingkar_kepala'];
    $lingkar_lengan = $row['lingkar_lengan'];
    $rambut = $row['rambut'];
    $mata = $row['mata'];
    $telinga = $row['telinga'];
    $hidung = $row['hidung'];
    $mulut = $row['mulut'];
    $gigi = $row['gigi'];
    $kulit = $row['kulit'];
    $kuku = $row['kuku'];
    $tangan = $row['tangan'];
    $kaki = $row['kaki'];
    $sakit = $row['sakit'];
    $izin = $row['izin'];
    $tanpa_keterangan = $row['tanpa_keterangan'];
} else {
    die("Data tidak ditemukan.");
}

// Mengatur locale ke bahasa Indonesia
$fmt = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'd MMMM yyyy');

// Mendapatkan tanggal saat ini dalam format Indonesia
$tanggal_sekarang = $fmt->format(time());

$html = "
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }
        .kop-surat h1 {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            font-size: 24px;
        }
        .kop-surat p {
            margin: 0;
            font-size: 14px;
        }
        .garis {
            border-bottom: 2px solid black;
            margin-top: 10px;
            clear: both;
        }
        .kop-surat img {
            position: absolute;
            left: -3%;
            top: 2%;
            transform: translateY(-50%);
            width: 100px;
        }
        .report-header {
            margin-bottom: 20px;
        }
        .report-header table {
            width: 100%;
        }
        .report-header th, .report-header td {
            text-align: left;
            padding: 5px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            font-size: 18px;
            margin: 0;
            border: 1px solid black;
            padding: 5px;
            background-color: #f2f2f2;
        }
        .section p {
            margin: 0;
            font-size: 14px;
        }
        .section ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            border: 1px solid black;
            border-top: none;
        }
        .section ul li {
            margin-bottom: 5px;
            padding: 5px;
            border-top: none;
        }
        .section ul li:last-child {
            border-bottom: none;
        }
        .growth-health-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .growth-health-table th, .growth-health-table td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        .growth-health-table th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .nested-table {
            width: 100%;
            border: none;
            text-align: top;
        }
        .nested-table td {
            padding: 3px;
            border: none;
        }
        .attendance-table {
            width: 100%;
            border-collapse: collapse;
        }
        .attendance-table th, .attendance-table td {
            border: 1px solid black;
            border-top: none;
            padding: 10px;
            text-align: left;
        }
        .attendance-table th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .signature-section {
            width: 100%;
            margin-top: 50px;
        }
        .signature-section td {
            vertical-align: top;
            padding: 20px;
        }
        .signature-section .left-signature {
            text-align: center;
        }
        .signature-section .right-signature {
            text-align: center;
            width: 50%;
            padding-left: 200px;
        }
        .signature-section .underline {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class='kop-surat'>
        <img src='http://localhost/web_akademik/assets/img/logo-tk.png' alt='logo'>
        <h1>TK. 'AISYIYAH BUSTANUL ATHFAL LABUAN</h1>
        <p>Sekretariat : Jl. Sumur Kopo Komplek Masjid Mujahidin</p>
        <p>Telp. (0253) 803336 Labuan 42264</p>
        <div class='garis'></div>
    </div>
    <div class='report-header'>
        <table>
            <tr>
                <th>Nama Anak</th>
                <td>: $nama_anak</td>
                <th>Usia</th>
                <td>: 5 - 6 tahun</td>
            </tr>
            <tr>
                <th>Nomor Induk</th>
                <td>: $nomor_induk</td>
                <th>Semester</th>
                <td>: $semester</td>
            </tr>
            <tr>
                <th>Kelas</th>
                <td>: $kelas</td>
            </tr>
        </table>
    </div>
    <div class='section'>
        <h2>A. Perkembangan Al-Islam: Nilai Agama dan Moral</h2>
        <ul>
            <li>$catatan</li>
        </ul>
    </div>
    <div class='section'>
        <h2>B. Pengetahuan Kemuhammadiyahan/Ke-Aisyiyahan</h2>
        <ul>
            <li>$pengetahuan_islam</li>
        </ul>
    </div>
    <div class='section'>
        <h2>C. Perkembangan Fisik Motorik</h2>
        <ul>
            <li>$perkembangan_fisik_motorik</li>
        </ul>
    </div>
    <div class='section'>
        <h2>D. Perkembangan Kognitif</h2>
        <ul>
            <li>$perkembangan_kognitif</li>
        </ul>
    </div>
    <div class='section'>
        <h2>E. Perkembangan Bahasa</h2>
        <ul>
            <li>$perkembangan_bahasa</li>
        </ul>
    </div>
    <div class='section'>
        <h2>F. Perkembangan Sosial Emosional</h2>
        <ul>
            <li>$perkembangan_sosial_emosional</li>
        </ul>
    </div>
    <div class='section'>
        <h2>G. Perkembangan Seni</h2>
        <ul>
            <li>$perkembangan_seni</li>
        </ul>
    </div>
    <div class='section'>
        <table class='growth-health-table'>
            <tr>
                <th style='width: 40%;'>Pertumbuhan Anak</th>
                <th style='width: 60%;'>Kesehatan/Kebersihan</th>
            </tr>
            <tr>
                <td>
                    <table class='nested-table'>
                        <tr>
                            <td>Tinggi Badan</td>
                            <td>: $tinggi_badan cm</td>
                        </tr>
                        <tr>
                            <td>Berat Badan</td>
                            <td>: $berat_badan kg</td>
                        </tr>
                        <tr>
                            <td>Lingkar Kepala</td>
                            <td>: $lingkar_kepala cm</td>
                        </tr>
                        <tr>
                            <td>Lingkar Lengan</td>
                            <td>: $lingkar_lengan cm</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class='nested-table'>
                        <tr>
                            <td style='width: 50%;'>
                                <table class='nested-table'>
                                    <tr>
                                        <td>a. Rambut</td>
                                        <td>: $rambut</td>
                                    </tr>
                                    <tr>
                                        <td>b. Mata</td>
                                        <td>: $mata</td>
                                    </tr>
                                    <tr>
                                        <td>c. Telinga</td>
                                        <td>: $telinga</td>
                                    </tr>
                                    <tr>
                                        <td>d. Hidung</td>
                                        <td>: $hidung</td>
                                    </tr>
                                    <tr>
                                        <td>e. Mulut</td>
                                        <td>: $mulut</td>
                                    </tr>
                                    <tr>
                                        <td>f. Gigi</td>
                                        <td>: $gigi</td>
                                    </tr>
                                </table>
                                </td>
                            <td style='width: 50%;'>
                                <table class='nested-table'>
                                    <tr>
                                        <td>Kulit</td>
                                        <td>: $kulit</td>
                                    </tr>
                                    <tr>
                                        <td>Kuku</td>
                                        <td>: $kuku</td>
                                    </tr>
                                    <tr>
                                        <td>Tangan</td>
                                        <td>: $tangan</td>
                                    </tr>
                                    <tr>
                                        <td>Kaki</td>
                                        <td>: $kaki</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <div class='section'>
        <h2>Kehadiran Anak</h2>
        <table class='attendance-table'>
            <tr>
                <th>Keterangan</th>
                <th>Jumlah Hari</th>
            </tr>
            <tr>
                <td>Sakit</td>
                <td>: $sakit hari</td>
            </tr>
            <tr>
                <td>Izin</td>
                <td>: $izin hari</td>
            </tr>
            <tr>
                <td>Tanpa Keterangan</td>
                <td>: $tanpa_keterangan hari</td>
            </tr>
        </table>
    </div>
    <div class='signature-section'>
        <table>
            <tr>
                <td class='left-signature'>
                    Mengetahui,<br>
                    Kepala Tk Aisyiyah Bustanul Athfal<br><br><br><br>
                    <span class='underline'>Nama Kepala TK</span><br>
                    NBM/KTA
                </td>
                <td class='right-signature'>
                    Labuan, $tanggal_sekarang<br>
                    Guru Kelas<br><br><br><br>
                    <span class='underline'>Nama Guru</span><br>
                    NBM/KTA
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
";

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("$nama_anak.pdf", array("Attachment" => 0));

// Tambahkan ini untuk debugging
file_put_contents('debug.html', $html);
file_put_contents('debug.html', $html);