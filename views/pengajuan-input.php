<?php
require_once 'Controllers/Pengajuan.php';
require_once 'Controllers/Pegawai.php';

$pengajuan = new Pengajuan($pdo);
$pegawai = new Pegawai($pdo);

// Data pegawai untuk dropdown
$list_pegawai = $pegawai->index();

// Inisialisasi
$data = [
    'tanggal_awal' => '',
    'tanggal_akhir' => '',
    'jumlah' => '',
    'ket' => '',
    'status' => '',
    'pegawai_nip' => ''
];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = $pengajuan->show($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = [
        'tanggal_awal' => $_POST['tanggal_awal'],
        'tanggal_akhir' => $_POST['tanggal_akhir'],
        'jumlah' => $_POST['jumlah'],
        'ket' => $_POST['ket'],
        'status' => $_POST['status'],
        'pegawai_nip' => $_POST['pegawai_nip']
    ];

    try {
        if (isset($_GET['id'])) {
            $pengajuan->update($_GET['id'], $formData);
            echo "<script>alert('Data pengajuan berhasil diperbarui!'); window.location='?url=pengajuan';</script>";
        } else {
            $pengajuan->create($formData);
            echo "<script>alert('Data pengajuan berhasil ditambahkan!'); window.location='?url=pengajuan';</script>";
        }
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";
    }
}
?>

<div class="container">
  <div class="card">
    <div class="card-header">
      <h5><?= isset($_GET['id']) ? 'Edit' : 'Tambah' ?> Pengajuan Cuti</h5>
    </div>
    <div class="card-body">
      <form method="post">
        <div class="mb-3">
          <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
          <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="<?= htmlspecialchars($data['tanggal_awal']) ?>" required>
        </div>
        <div class="mb-3">
          <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
          <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="<?= htmlspecialchars($data['tanggal_akhir']) ?>" required>
        </div>
        <div class="mb-3">
          <label for="jumlah" class="form-label">Jumlah Hari</label>
          <input type="number" name="jumlah" id="jumlah" class="form-control" value="<?= htmlspecialchars($data['jumlah']) ?>" required>
        </div>
        <div class="mb-3">
          <label for="ket" class="form-label">Keterangan</label>
          <textarea name="ket" id="ket" class="form-control"><?= htmlspecialchars($data['ket']) ?></textarea>
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select name="status" id="status" class="form-select" required>
            <option value="diproses" <?= $data['status'] === 'diproses' ? 'selected' : '' ?>>Diproses</option>
            <option value="disetujui" <?= $data['status'] === 'disetujui' ? 'selected' : '' ?>>Disetujui</option>
            <option value="ditolak" <?= $data['status'] === 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="pegawai_nip" class="form-label">NIP Pegawai</label>
          <select name="pegawai_nip" id="pegawai_nip" class="form-select" required>
            <option value="">-- Pilih NIP Pegawai --</option>
            <?php foreach ($list_pegawai as $pg): ?>
              <option value="<?= $pg['nip'] ?>" <?= $pg['nip'] === $data['pegawai_nip'] ? 'selected' : '' ?>>
                <?= $pg['nip'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="?url=pengajuan" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>

