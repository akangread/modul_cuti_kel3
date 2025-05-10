<?php
// Mulai output buffering untuk mencegah pengiriman output sebelum header
ob_start();

// Inisialisasi objek atau proses yang dibutuhkan
require_once 'Controllers/Divisi.php';  
require_once 'Helpers/helper.php';

$divisi_id = isset($_GET['id']) ? $_GET['id'] : null;
$divisi = new Divisi($pdo);
$show_divisi = $divisi_id ? $divisi->show($divisi_id) : [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Validasi form
  if (empty($_POST['kode']) || empty($_POST['nama']) || empty($_POST['manager'])) {
    echo "<script>alert('Semua kolom wajib diisi!');</script>";
  } else {
    if ($_POST['type'] === 'create') {
      // Jika operasi create
      $divisi->create($_POST);
      echo "<script>alert('Data berhasil ditambahkan');</script>";
      echo "<script>window.location='?url=divisi';</script>"; // Redirect ke halaman divisi
      exit;
    } elseif ($_POST['type'] === 'update') {
      // Jika operasi update
      $divisi->update($divisi_id, $_POST);
      echo "<script>alert('Data berhasil diperbarui');</script>";
      echo "<script>window.location='?url=divisi';</script>"; // Redirect ke halaman divisi
      exit;
    }
  }
}

ob_end_flush(); // Menyelesaikan output buffering dan mengirim output ke browser
?>

<!-- HTML Content Here -->
<div class="container">
  <form method="post">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

    <div class="card">
      <div class="card-header">
        <div class="card-title">
          <?= $divisi_id ? 'Edit' : 'Tambah' ?> Divisi
        </div>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label for="kode">Kode Divisi</label>
          <input type="text" class="form-control" id="kode" name="kode" value="<?= htmlspecialchars($show_divisi['kode'] ?? '') ?>" required>
        </div>
        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($show_divisi['nama'] ?? '') ?>" required>
        </div>
        <div class="form-group">
          <label for="manager">Manager</label>
          <input type="text" class="form-control" id="manager" name="manager" value="<?= htmlspecialchars($show_divisi['manager'] ?? '') ?>" required>
        </div>
      </div>

      <div class="card-footer text-right">
        <input type="hidden" name="type" value="<?= $divisi_id ? 'update' : 'create' ?>">
        <input type="hidden" name="id" value="<?= $divisi_id ?>">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
</div>
