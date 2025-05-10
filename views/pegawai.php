<?php
require_once 'Controllers/Pegawai.php';

// Pastikan koneksi PDO sudah ada
$pdo = new PDO("mysql:host=localhost;dbname=mydb", "root", "");

// Inisialisasi objek Pegawai
$pegawai = new Pegawai($pdo);
$list_pegawai = $pegawai->index();

// Handle delete request
if (isset($_POST['type']) && $_POST['type'] === 'delete' && isset($_POST['nip'])) {
    $row = $pegawai->delete($_POST['nip']);
    echo "<script>alert('Data {$row['nama']} berhasil dihapus');</script>";
    echo "<script>window.location='?url=pegawai'</script>";
}
?>

<div class="container">
  <div class="card">
    <div class="card-body">
      <div class="mb-2">
        <a class="btn btn-success btn-sm" href="?url=pegawai-input">Tambah Pegawai</a>
      </div>

      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Gender</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Divisi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($list_pegawai as $row): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($row['nip']) ?></td>
              <td><?= htmlspecialchars($row['tmp_lahir']) ?></td>
              <td><?= htmlspecialchars($row['tgl_lahir']) ?></td>
              <td><?= $row['gender'] === 'L' ? 'Laki-Laki' : 'Perempuan' ?></td>
              <td><?= htmlspecialchars($row['telpon']) ?></td>
              <td><?= htmlspecialchars($row['alamat']) ?></td>
              <td><?= htmlspecialchars($row['divisi']) ?></td>
              <td>
                <a href="?url=pegawai-input&id=<?= htmlspecialchars($row['nip']) ?>" 
                   class="btn btn-sm btn-warning mr-2">Edit</a>
                <form action="" method="post" style="display:inline;" 
                      onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                  <input type="hidden" name="nip" value="<?= htmlspecialchars($row['nip']) ?>">
                  <input type="hidden" name="type" value="delete">
                  <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
