<?php
require_once 'Controllers/JatahCuti.php';
require_once 'Controllers/Pegawai.php';

$jatahCuti = new JatahCuti($pdo);
$pegawai = new Pegawai($pdo);

// Ambil data pegawai untuk dropdown
$list_pegawai = $pegawai->index();

// Inisialisasi data kosong
$data = [
    'tahun' => '',
    'jumlah' => '',
    'pegawai_nip' => ''
];

// Cek apakah ini edit (ada parameter ?id=...)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = $jatahCuti->show($id);
}

// Proses form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = [
        'tahun' => $_POST['tahun'],
        'jumlah' => $_POST['jumlah'],
        'pegawai_nip' => $_POST['pegawai_nip']
    ];

    try {
        if (isset($_GET['id'])) {
            $jatahCuti->update($_GET['id'], $formData);
            echo "<script>alert('Data berhasil diperbarui!')</script>";
        } else {
            $jatahCuti->create($formData);
            echo "<script>alert('Data berhasil ditambahkan!')</script>";
        }
        echo "<script>window.location='?url=jatah_cuti'</script>";
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";
    }
}
?>

<div class="container">
  <div class="card">
    <div class="card-header">
      <h5><?= isset($_GET['id']) ? 'Edit' : 'Tambah' ?> Jatah Cuti</h5>
    </div>
    <div class="card-body">
      <form method="post">
        <div class="mb-3">
          <label for="tahun" class="form-label">Tahun</label>
          <input type="number" name="tahun" id="tahun" class="form-control" value="<?= htmlspecialchars($data['tahun']) ?>" required>
        </div>
        <div class="mb-3">
          <label for="jumlah" class="form-label">Jumlah Cuti</label>
          <input type="number" name="jumlah" id="jumlah" class="form-control" value="<?= htmlspecialchars($data['jumlah']) ?>" required>
        </div>
        <div class="mb-3">
          <label for="pegawai_nip" class="form-label">NIP Pegawai</label>
          <select name="pegawai_nip" id="pegawai_nip" class="form-select" required>
            <option value="">-- Pilih NIP Pegawai --</option>
            <?php foreach ($list_pegawai as $pg): ?>
              <option value="<?= $pg['nip'] ?>" <?= $pg['nip'] === $data['pegawai_nip'] ? 'selected' : '' ?>>
                <?= $pg['nip'] ?> - <?= htmlspecialchars($pg['tmp_lahir']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="?url=jatah_cuti" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
