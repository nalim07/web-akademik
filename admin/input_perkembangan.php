<?php
require_once '../koneksi.php';
session_start();
//sesi ketika login
if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

// proses input data nilai
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_siswa = $_POST['nama_siswa'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    $semester = $_POST['semester'];
    $catatan_perkembangan = $_POST['catatan_perkembangan'];
    $pengetahuan_islam = $_POST['pengetahuan_islam'];
    $perkembangan_fisik_motorik = $_POST['perkembangan_fisik_motorik'];
    $perkembangan_kognitif = $_POST['perkembangan_kognitif'];
    $perkembangan_bahasa = $_POST['perkembangan_bahasa'];
    $perkembangan_sosial_emosional = $_POST['perkembangan_sosial_emosional'];
    $perkembangan_seni = $_POST['perkembangan_seni'];
    $berat_badan = $_POST['berat_badan'];
    $tinggi_badan = $_POST['tinggi_badan'];
    $lingkar_kepala = $_POST['lingkar_kepala'];
    $lingkar_lengan = $_POST['lingkar_lengan'];
    $rambut = $_POST['rambut'];
    $mata = $_POST['mata'];
    $telinga = $_POST['telinga'];
    $hidung = $_POST['hidung'];
    $mulut = $_POST['mulut'];
    $gigi = $_POST['gigi'];
    $kulit = $_POST['kulit'];
    $kuku = $_POST['kuku'];
    $tangan = $_POST['tangan'];
    $kaki = $_POST['kaki'];
    $sakit = $_POST['sakit'];
    $izin = $_POST['izin'];
    $tanpa_keterangan = $_POST['tanpa_keterangan'];

    $sql = "INSERT INTO tbl_nilai (nama_siswa, nis, kelas, semester, catatan_perkembangan, pengetahuan_islam, perkembangan_seni, perkembangan_fisik_motorik, perkembangan_kognitif, perkembangan_bahasa, perkembangan_sosial_emosional, berat_badan, tinggi_badan, lingkar_kepala, lingkar_lengan, rambut, mata, telinga, hidung, mulut, gigi, kulit, kuku, tangan, kaki, sakit, izin, tanpa_keterangan) 
            VALUES ('$nama_siswa', '$nis', '$kelas', '$semester', '$catatan_perkembangan', '$pengetahuan_islam', '$perkembangan_seni', '$perkembangan_fisik_motorik', '$perkembangan_kognitif', '$perkembangan_bahasa', '$perkembangan_sosial_emosional', '$berat_badan', '$tinggi_badan', '$lingkar_kepala', '$lingkar_lengan', '$rambut', '$mata', '$telinga', '$hidung', '$mulut', '$gigi', '$kulit', '$kuku', '$tangan', '$kaki', '$sakit', '$izin', '$tanpa_keterangan')";

    if (mysqli_query($conn, $sql)) {
        $alert_message = '<div class="alert alert-info" role="alert">Data berhasil disimpan</div>';
    header("Refresh:3");
    } else {
        $alert_message = '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . mysqli_error($conn) . '</div>';
    }
    
}

$title = "Input Perkembangan";
require_once 'template_admin/header.php';
require_once 'template_admin/navbar.php';
?>

<div class="container mt-5">
    <?php if (isset($alert_message)) echo $alert_message; ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="input_nilai.php">Menu Nilai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Input Perkembangan</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <h4 class="mt-2 font-weight-bold text-primary text-start">Input Perkembangan Siswa</h4>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_siswa">Nama Siswa</label>
                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nis">NIS</label>
                            <input type="text" class="form-control" id="nis" name="nis" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select class="form-control" id="kelas" name="kelas" required>
                                <option value="">Pilih Kelas</option>
                                <?php
                                $query_kelas = "SELECT nama_kelas FROM tbl_kelas";
                                $result_kelas = mysqli_query($conn, $query_kelas);
                                while ($row_kelas = mysqli_fetch_assoc($result_kelas)) {
                                    echo "<option value='" . $row_kelas['nama_kelas'] . "'>" . $row_kelas['nama_kelas'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select class="form-control" id="semester" name="semester" required>
                                <option value="">Pilih Semester</option>
                                <option value="1">1 (Satu)</option>
                                <option value="2">2 (Dua)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="catatan_perkembangan">A. Perkembangan Al Islam: Nilai Agama & Moral</label>
                            <textarea class="form-control" id="catatan_perkembangan" name="catatan_perkembangan" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="pengetahuan_islam">B. Pengetahuan Kemuhammadiyaan/Ke-Aisyahan</label>
                            <textarea class="form-control" id="pengetahuan_islam" name="pengetahuan_islam" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="perkembangan_fisik_motorik">C. Perkembangan Fisik Motorik</label>
                            <textarea class="form-control" id="perkembangan_fisik_motorik" name="perkembangan_fisik_motorik" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="perkembangan_kognitif">D. Perkembangan Kognitif</label>
                            <textarea class="form-control" id="perkembangan_kognitif" name="perkembangan_kognitif" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="perkembangan_bahasa">E. Perkembangan Bahasa</label>
                            <textarea class="form-control" id="perkembangan_bahasa" name="perkembangan_bahasa" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="perkembangan_sosial_emosional">F. Perkembangan Sosial Emosional</label>
                            <textarea class="form-control" id="perkembangan_sosial_emosional" name="perkembangan_sosial_emosional" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="perkembangan_seni">G. Perkembangan Seni</label>
                            <textarea class="form-control" id="perkembangan_seni" name="perkembangan_seni" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-group">
                            <div class="card">
                                <div class="card-header mb-3">Pertumbuhan Anak</div>
                                <div class="card-body">
                                    <div class="row g-3 align-items-center">
                                        <div class="row mb-3">
                                            <label for="berat_badan" class="col-sm-4 col-form-label">Berat Badan</label>
                                            <div class="col-md-2">
                                                <input type="number" class="form-control" id="berat_badan" name="berat_badan">
                                            </div>
                                            <label for="tinggi_badan" class="col-sm-4 col-form-label">Tinggi Badan</label>
                                            <div class="col-md-2">
                                                <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="lingkar_kepala" class="col-sm-4 col-form-label">Lingkar Kepala</label>
                                            <div class="col-md-2">
                                                <input type="number" class="form-control" id="lingkar_kepala" name="lingkar_kepala">
                                            </div>
                                            <label for="lingkar_lengan" class="col-sm-4 col-form-label">Lingkar Lengan</label>
                                            <div class="col-md-2">
                                                <input type="number" class="form-control" id="lingkar_lengan" name="lingkar_lengan">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header mb-3">Kesehatan/Kebersihan</div>
                    <div class="card-body">
                        <div class="row">
                            <h6 class="mb-2"><b>Bagian Kepala</b></h6>
                            <div class="col-md-2">
                                <label for="rambut">Rambut</label>
                                <input type="text" class="form-control form-control-sm" id="rambut" name="rambut">
                            </div>
                            <div class="col-md-2">
                                <label for="mata">Mata</label>
                                <input type="text" class="form-control form-control-sm" id="mata" name="mata">
                            </div>
                            <div class="col-md-2">
                                <label for="telinga">Telinga</label>
                                <input type="text" class="form-control form-control-sm" id="telinga" name="telinga">
                            </div>
                            <div class="col-md-2">
                                <label for="hidung">Hidung</label>
                                <input type="text" class="form-control form-control-sm" id="hidung" name="hidung">
                            </div>
                            <div class="col-md-2">
                                <label for="mulut">Mulut</label>
                                <input type="text" class="form-control form-control-sm" id="mulut" name="mulut">
                            </div>
                            <div class="col-md-2">
                                <label for="gigi">Gigi</label>
                                <input type="text" class="form-control form-control-sm" id="gigi" name="gigi">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label for="kulit">Kulit</label>
                                <input type="text" class="form-control form-control-sm" id="kulit" name="kulit">
                            </div>
                            <div class="col-md-3">
                                <label for="kuku">Kuku</label>
                                <input type="text" class="form-control form-control-sm" id="kuku" name="kuku">
                            </div>
                            <div class="col-md-3">
                                <label for="tangan">Tangan</label>
                                <input type="text" class="form-control form-control-sm" id="tangan" name="tangan">
                            </div>
                            <div class="col-md-3">
                                <label for="kaki">Kaki</label>
                                <input type="text" class="form-control form-control-sm" id="kaki" name="kaki">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header mb-3">Kehadiran</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="sakit">Sakit</label>
                                <input type="number" class="form-control form-control-sm" id="sakit" name="sakit">
                            </div>
                            <div class="col-md-4">
                                <label for="izin">Izin</label>
                                <input type="number" class="form-control form-control-sm" id="izin" name="izin">
                            </div>
                            <div class="col-md-4">
                                <label for="tanpa_keterangan">Tanpa Keterangan</label>
                                <input type="number" class="form-control form-control-sm" id="tanpa_keterangan" name="tanpa_keterangan">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="input_nilai.php" class="btn btn-secondary mt-3">Kembali</a>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- <script>
    setTimeout(function() {
        var alert = document.querySelector('.alert');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 5000); // 5000 ms = 5 detik
</script> -->

<?php
require_once 'template_admin/footer.php';
?>