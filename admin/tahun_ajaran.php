<?php
include '../koneksi.php';
session_start();
//sesi ketika login
if (!isset($_SESSION["sslogin"])) {
    header("location: ../auth/login.php");
    exit;
}

// Proses Tambah Tahun Ajaran
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'create') {
        $tahun_ajaran = $_POST['tahun_ajaran'];
        $query = "INSERT INTO tbl_ta (tahun_ajaran, status) VALUES ('$tahun_ajaran', 'inactive')";
        mysqli_query($conn, $query);
    } elseif ($_POST['action'] == 'edit') {
        $id = $_POST['id'];
        $tahun_ajaran = $_POST['tahun_ajaran'];
        $query = "UPDATE tbl_ta SET tahun_ajaran='$tahun_ajaran' WHERE id='$id'";
        mysqli_query($conn, $query);
    } elseif ($_POST['action'] == 'delete') {
        $id = $_POST['id'];
        $query = "DELETE FROM tbl_ta WHERE id='$id'";
        if (mysqli_query($conn, $query)) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } elseif ($_POST['action'] == 'toggle_status') {
        $id = $_POST['id'];
        $status = $_POST['status'];
        if ($status == 'active') {
            // Nonaktifkan semua tahun ajaran lain
            mysqli_query($conn, "UPDATE tbl_ta SET status='inactive' WHERE status='active'");
        }
        $query = "UPDATE tbl_ta SET status='$status' WHERE id='$id'";
        mysqli_query($conn, $query);
    }
    header("Location: tahun_ajaran.php");
    exit;
}

$title = "Tahun Ajaran";
require_once 'template_admin/header.php';
require_once 'template_admin/navbar.php';

?>

<div class="container-fluid">
    <!-- Page Heading -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tahun Ajaran</li>
        </ol>
    </nav>
    <!-- Tabel Tahun Ajaran -->
    <div class="card shadow mb-5">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <h6 class="mt-2 font-weight-bold text-primary text-start">Tabel Tahun Ajaran</h6>
                <button class="btn btn-outline-success" data-toggle="modal" data-target="#createModal" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .10rem; --bs-btn-font-size: .75rem;"><i class="bi bi-plus-circle"></i>Tambah Tahun Ajaran</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Tahun Ajaran</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM tbl_ta";
                        $sql = mysqli_query($conn, $query);
                        $no = 1;
                        while ($result = mysqli_fetch_assoc($sql)) {
                            echo "<tr class='text-center'>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $result['tahun_ajaran'] . "</td>";
                            echo "<td>" . ucfirst($result['status']) . "</td>";
                            echo "<td>";
                            echo "<button class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editModal' data-id='" . $result['id'] . "' data-tahun='" . $result['tahun_ajaran'] . "'><i class='bi bi-pencil-square' title='Edit'></i></button>&nbsp;";
                            echo "<a href='proses_ta.php?action=delete&id=" . $result['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus tahun ajaran ini?\")'><i class='bi bi-trash' title='Hapus'></i></a>&nbsp;";
                            echo "<form action='tahun_ajaran.php' method='POST' style='display:inline;'>";
                            echo "<input type='hidden' name='id' value='" . $result['id'] . "'>";
                            echo "<input type='hidden' name='action' value='toggle_status'>";
                            echo "<input type='hidden' name='status' value='" . ($result['status'] == 'active' ? 'inactive' : 'active') . "'>";
                            echo "<button type='submit' class='btn btn-warning btn-sm'>" . ($result['status'] == 'active' ? 'Nonaktifkan' : 'Aktifkan') . "</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create Tahun Ajaran -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="tahun_ajaran.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Tahun Ajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <input type="hidden" name="action" value="create">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Tahun Ajaran -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="tahun_ajaran.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Tahun Ajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_tahun_ajaran">Tahun Ajaran</label>
                        <input type="text" class="form-control" id="edit_tahun_ajaran" name="tahun_ajaran" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <input type="hidden" name="action" value="edit">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete Tahun Ajaran -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="proses_ta.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Tahun Ajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus tahun ajaran ini?</p>
                    <input type="hidden" id="delete_id" name="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <input type="hidden" name="action" value="delete">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var tahun = button.data('tahun');
        var modal = $(this);
        modal.find('.modal-body #edit_id').val(id);
        modal.find('.modal-body #edit_tahun_ajaran').val(tahun);
    });

    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        modal.find('form').attr('action', 'proses_ta.php');
        modal.find('.modal-body #delete_id').val(id);
    });
</script>


<?php
require_once 'template_admin/footer.php';
?>