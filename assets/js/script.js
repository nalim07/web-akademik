
// Script untuk memantau perubahan pada select filterKelas
document.getElementById('filterKelas').addEventListener('change', function() {
    var selectedKelas = this.value;

    // Kirim permintaan AJAX ke server untuk memperbarui data siswa
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_data_siswa.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status == 200) {
            // Update tabel data siswa dengan respons dari server
            document.getElementById('dataTable').innerHTML = xhr.responseText;
        }
    };
    xhr.send('selectedKelas=' + selectedKelas);
});

