<?php
require_once '../koneksi.php';
session_start();
//sesi ketika login
if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

$title = "Data Siswa";
require_once 'template_admin/header.php';
require_once 'template_admin/navbar.php';

// Query untuk mengambil data siswa dari tabel tbl_siswa
$query = "SELECT * FROM siswa_kelasa;";
$sql = mysqli_query($conn, $query);

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
        </ol>
    </nav>
    <!-- Tabel Data Siswa -->
    <div class="card shadow mb-5">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="mt-2 font-weight-bold text-primary text-start">Tabel Data Siswa</h6>
                <a class="btn btn-outline-success" href="tambahsiswa.php" role="button" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .10rem; --bs-btn-font-size: .75rem;"><i class="bi bi-person-fill-add"></i>Tambah Data</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <?php
                            $no = 1;
                            // Menampilkan data siswa dalam tabel
                            while ($result = mysqli_fetch_assoc($sql)) {
                                echo "<tr class='text-center'>";
                                echo "<td>" . $no;
                                $no++ . "</td>";
                                echo "<td>" . $result['nama_siswa'] . "</td>";
                                echo "<td>" . $result['nis'] . "</td>";
                                echo "<td>" . $result['kelas'] . "</td>";
                                echo "<td>" . $result['jenis_kelamin'] . "</td>";
                                echo "<td>" . $result['alamat'] . "</td>";
                                echo "<td>";
                                echo "<a href='detail_siswa.php?id_siswa=" . $result['id'] . "' class='btn btn-primary btn-sm'><i class='bi bi-person-lines-fill' title='Detail'></i></a>&nbsp;";
                                echo "<a class='btn btn-info btn-sm' id='btnEditSiswa' data-id_siswa='" . $result['id'] . "' data-bs-toggle='modal' data-bs-target='#modalEditSiswa' 
                                        data-nama_siswa='" . $result['nama_siswa'] . "'
                                        data-nis='" . $result['nis'] . "'
                                        data-tanggal_masuk='" . $result['tanggal_masuk'] . "'
                                        data-kelas='" . $result['kelas'] . "'
                                        data-tempat_lahir='" . $result['tempat_lahir'] . "'
                                        data-tanggal_lahir='" . $result['tanggal_lahir'] . "'
                                        data-jenis_kelamin='" . $result['jenis_kelamin'] . "'
                                        data-alamat='" . $result['alamat'] . "'
                                        data-desa_kelurahan='" . $result['desa_kelurahan'] . "'
                                        data-kecamatan='" . $result['kecamatan'] . "'
                                        data-kab_kota='" . $result['kab_kota'] . "'
                                        data-provinsi='" . $result['provinsi'] . "'
                                        data-agama='" . $result['agama'] . "'
                                        data-wali_siswa='" . $result['wali_siswa'] . "'
                                        data-no_hp_wali='" . $result['no_hp_wali'] . "'
                                        data-foto_siswa='" . $result['foto_siswa'] . "'><i class='bi bi-pencil-square' title='Edit'></i></a>&nbsp;";
                                echo "<a href='hapus_siswa.php?id=" . $result['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'><i class='bi bi-trash' title='hapus'></i></a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit Data Siswa -->
    <div class="modal fade" id="modalEditSiswa" tabindex="-1" aria-labelledby="modalEditSiswaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditSiswaLabel">Edit Data Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form in Modal -->
                    <form id="formEditSiswa" action="proses_edit_siswa.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="id_siswa" name="id_siswa">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nama_siswa" class="form-label">Nama Siswa</label>
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required>
                            </div>
                            <div class="col-md-6 ms-auto">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="text" class="form-control" id="nis" name="nis" required readonly onfocus="this.removeAttribute('readonly');">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="margin-top: 10px;">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                            </div>
                            <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                                <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="margin-top: 10px;">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                            </div>
                            <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                                <div>
                                    <label for="kelas" class="form-label">Kelas</label>
                                    <select class="form-control" id="kelas" name="kelas" required>
                                        <option value="">Pilih Kelas</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="margin-top: 10px;">
                                <label class="form-label">Jenis Kelamin</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="L" value="L" required>
                                    <label class="form-check-label" for="L">
                                        Laki-Laki
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="P" value="P" required>
                                    <label class="form-check-label" for="P">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-top: 10px;">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <select class="form-control" id="provinsi" name="provinsi" required>
                                    <option value="">Pilih Provinsi</option>
                                    <option value="Aceh">Aceh</option>
                                    <option value="Sumatera Utara">Sumatera Utara</option>
                                    <option value="Sumatera Barat">Sumatera Barat</option>
                                    <option value="Riau">Riau</option>
                                    <option value="Jambi">Jambi</option>
                                    <option value="Sumatera Selatan">Sumatera Selatan</option>
                                    <option value="Bengkulu">Bengkulu</option>
                                    <option value="Lampung">Lampung</option>
                                    <option value="Kepulauan Bangka Belitung">Kepulauan Bangka Belitung</option>
                                    <option value="Kepulauan Riau">Kepulauan Riau</option>
                                    <option value="Jawa Barat">Jawa Barat</option>
                                    <option value="Jawa Tengah">Jawa Tengah</option>
                                    <option value="Jawa Timur">Jawa Timur</option>
                                    <option value="Yogyakarta">Yogyakarta</option>
                                    <option value="Banten">Banten</option>
                                    <option value="Jakarta">Jakarta</option>
                                    <option value="Jawa Barat">Jawa Barat</option>
                                    <option value="Bali">Bali</option>
                                    <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                                    <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                                    <option value="Kalimantan Barat">Kalimantan Barat</option>
                                    <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                                    <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                                    <option value="Kalimantan Timur">Kalimantan Timur</option>
                                    <option value="Kalimantan Utara">Kalimantan Utara</option>
                                    <option value="Sulawesi Utara">Sulawesi Utara</option>
                                    <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                                    <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                    <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                                    <option value="Gorontalo">Gorontalo</option>
                                    <option value="Sulawesi Barat">Sulawesi Barat</option>
                                    <option value="Maluku">Maluku</option>
                                    <option value="Maluku Utara">Maluku Utara</option>
                                    <option value="Papua">Papua</option>
                                    <option value="Papua Barat">Papua Barat</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="margin-top: 10px;">
                                <label for="agama" class="form-label">Agama</label>
                                <select class="form-control" id="agama" name="agama" required>
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                            <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                                <label for="kab_kota" class="form-label">Kab/Kota</label>
                                <input type="text" class="form-control" id="kab_kota" name="kab_kota" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="margin-top: 10px;">
                                <label for="foto_siswa" class="form-label">Foto Siswa</label>
                                <input type="file" class="form-control" id="foto_siswa" name="foto_siswa">
                            </div>
                            <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="margin-top: 10px;">
                                <label for="wali_siswa" class="form-label">Wali Siswa</label>
                                <input type="text" class="form-control" id="wali_siswa" name="wali_siswa" required>
                            </div>
                            <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                                <label for="desa_kelurahan" class="form-label">Desa/Kelurahan</label>
                                <input type="text" class="form-control" id="desa_kelurahan" name="desa_kelurahan" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="margin-top: 10px;">
                                <label for="no_hp_wali" class="form-label">No. HP Wali</label>
                                <input type="text" class="form-control" id="no_hp_wali" name="no_hp_wali" required>
                            </div>
                            <div class="col-md-6 ms-auto" style="margin-top: 10px;">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" required>
                            </div>
                        </div>
                        <div class="modal-footer" style="margin-top: 20px;">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" name="edit">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<script>
    $(document).on("click", "#btnEditSiswa", function () {
            var id_siswa = $(this).data('id_siswa');
            var nama_siswa = $(this).data('nama_siswa');
            var nis = $(this).data('nis');
            var tanggal_masuk = $(this).data('tanggal_masuk');
            var kelas = $(this).data('kelas');
            var tempat_lahir = $(this).data('tempat_lahir');
            var tanggal_lahir = $(this).data('tanggal_lahir');
            var jenis_kelamin = $(this).data('jenis_kelamin');
            var alamat = $(this).data('alamat');
            var desa_kelurahan = $(this).data('desa_kelurahan');
            var kecamatan = $(this).data('kecamatan');
            var kab_kota = $(this).data('kab_kota');
            var provinsi = $(this).data('provinsi');
            var agama = $(this).data('agama');
            var wali_siswa = $(this).data('wali_siswa');
            var no_hp_wali = $(this).data('no_hp_wali');
            var foto_siswa = $(this).data('foto_siswa');

            $('#nama_siswa').val(nama_siswa);
            $('#nis').val(nis);
            $('#tanggal_masuk').val(tanggal_masuk);
            $('#kelas').val(kelas);
            $('#tempat_lahir').val(tempat_lahir);
            $('#tanggal_lahir').val(tanggal_lahir);
            $("input[name='jenis_kelamin'][value='" + jenis_kelamin + "']").prop("checked", true);
            $('#alamat').val(alamat);
            $('#desa_kelurahan').val(desa_kelurahan);
            $('#kecamatan').val(kecamatan);
            $('#kab_kota').val(kab_kota);
            $('#provinsi').val(provinsi);
            $('#agama').val(agama);
            $('#wali_siswa').val(wali_siswa);
            $('#no_hp_wali').val(no_hp_wali);
            $('#foto_siswa').val(foto_siswa);
    });
</script>

<?php
require_once 'template_admin/footer.php';
?>