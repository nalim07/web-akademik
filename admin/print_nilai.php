<?php
include '../koneksi.php';
session_start();
//sesi ketika login
if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

$title = "Print Nilai";
require_once 'template_admin/header.php';
require_once 'template_admin/navbar.php';

?>

<div class="container-fluid">
    <!-- Page Heading -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Print Nilai</li>
        </ol>
    </nav>
    <!-- Filter Data Siswa -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="GET" action="">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="kelas">Kelas</label>
                        <select class="form-control" id="kelas" name="kelas">
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
                    <div class="form-group col-md-6">
                        <label for="semester">Semester</label>
                        <select class="form-control" id="semester" name="semester">
                            <option value="">Pilih Semester</option>
                            <option value="1">1 (Satu)</option>
                            <option value="2">2 (Dua)</option>
                            <!-- Tambahkan opsi semester lainnya sesuai kebutuhan -->
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Filter</button>
                <a href="print_nilai.php" class="btn btn-secondary mt-2">Hapus Filter</a>
            </form>
        </div>
        <div class="col-md-6">
            <form method="GET" action="">
                <div class="input-group mt-4">
                    <input type="text" class="form-control" placeholder="Cari Nama Siswa" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if (isset($_GET['kelas']) && $_GET['kelas'] != '' || isset($_GET['semester']) && $_GET['semester'] != '' || isset($_GET['search']) && $_GET['search'] != '') : ?>
        <div class="row mb-4">
            <div class="col-md-12">
                <span class="badge badge-info">Filter Aktif:
                    <?php
                    if (isset($_GET['kelas']) && $_GET['kelas'] != '') {
                        echo "Kelas: " . $_GET['kelas'] . " ";
                    }
                    if (isset($_GET['semester']) && $_GET['semester'] != '') {
                        echo "Semester: " . $_GET['semester'] . " ";
                    }
                    if (isset($_GET['search']) && $_GET['search'] != '') {
                        echo "Cari: " . $_GET['search'];
                    }
                    ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <!-- Tabel Data Nilai -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="mt-2 font-weight-bold text-primary text-start"><i class="bi bi-table"></i> Data Nilai Siswa</h6>
                    <!-- <a href="proses_print_all.php" class="btn btn-success btn-sm" title="Cetak Semua" target="_blank"><i class="fas fa-print"></i> Print Semua Data</a> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Semester</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $kelas = isset($_GET['kelas']) ? $_GET['kelas'] : '';
                                $semester = isset($_GET['semester']) ? $_GET['semester'] : '';
                                $search = isset($_GET['search']) ? $_GET['search'] : '';

                                // Pagination settings
                                $limit = 10;
                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $offset = ($page - 1) * $limit;

                                // Get total records
                                $total_query = "SELECT COUNT(*) as total FROM tbl_nilai WHERE 1=1";
                                if ($kelas != '') {
                                    $total_query .= " AND kelas='$kelas'";
                                }
                                if ($semester != '') {
                                    $total_query .= " AND semester='$semester'";
                                }
                                if ($search != '') {
                                    $total_query .= " AND nama_siswa LIKE '%$search%'";
                                }
                                $total_result = mysqli_query($conn, $total_query);
                                $total_row = mysqli_fetch_assoc($total_result);
                                $total_records = $total_row['total'];
                                $total_pages = ceil($total_records / $limit);

                                $query = "SELECT * FROM tbl_nilai WHERE 1=1";
                                if ($kelas != '') {
                                    $query .= " AND kelas='$kelas'";
                                }
                                if ($semester != '') {
                                    $query .= " AND semester='$semester'";
                                }
                                if ($search != '') {
                                    $query .= " AND nama_siswa LIKE '%$search%'";
                                }

                                // Fetch records with limit and offset
                                $query .= " LIMIT $limit OFFSET $offset";
                                $result = mysqli_query($conn, $query);
                                $no = $offset + 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $no++ . "</td>";
                                    echo "<td>" . $row['nis'] . "</td>";
                                    echo "<td>" . $row['nama_siswa'] . "</td>";
                                    echo "<td>" . $row['kelas'] . "</td>";
                                    echo "<td>" . $row['semester'] . "</td>";
                                    echo "<td class='text-center'>";
                                    // echo "<a href='view_nilai.php?id=" . $row['id'] . "' class='btn btn-info btn-sm' title='View'><i class='fas fa-eye'></i></a> ";
                                    echo "<a href='proses_print.php?id=" . $row['id'] . "' class='btn btn-success btn-sm' title='Cetak' target='_blank'><i class='fas fa-print'></i></a> ";
                                    echo "<a href='print_nilai.php?delete_id=" . $row['id'] . "' class='btn btn-danger btn-sm' title='Hapus' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'><i class='fas fa-trash'></i></a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            Showing <?php echo $offset + 1; ?> to <?php echo min($offset + $limit, $total_records); ?> of <?php echo $total_records; ?> entries
                        </div>
                        <div>
                            <nav>
                                <ul class="pagination">
                                    <?php if ($page > 1) : ?>
                                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>&kelas=<?php echo $kelas; ?>&semester=<?php echo $semester; ?>&search=<?php echo $search; ?>">Previous</a></li>
                                    <?php endif; ?>
                                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                        <li class="page-item <?php if ($i == $page) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>&kelas=<?php echo $kelas; ?>&semester=<?php echo $semester; ?>&search=<?php echo $search; ?>"><?php echo $i; ?></a></li>
                                    <?php endfor; ?>
                                    <?php if ($page < $total_pages) : ?>
                                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>&kelas=<?php echo $kelas; ?>&semester=<?php echo $semester; ?>&search=<?php echo $search; ?>">Next</a></li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM tbl_nilai WHERE id='$delete_id'";
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Data berhasil dihapus'); window.location.href='print_nilai.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }
}
?>

<?php
require_once 'template_admin/footer.php';
?>