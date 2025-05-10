<?php
require_once 'Controllers/Pegawai.php';
require_once 'Controllers/Divisi.php';
require_once 'Helpers/helper.php';

$pegawai_id = $_GET['id'] ?? null;
$pegawai = new Pegawai($pdo);
$divisi = new Divisi($pdo);

$data_divisi = $divisi->index();
$show_pegawai = $pegawai_id ? $pegawai->show($pegawai_id) : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = [
            'nip' => $_POST['nip'],
            'gender' => $_POST['gender'],
            'tmp_lahir' => $_POST['tmp_lahir'],
            'tgl_lahir' => $_POST['tgl_lahir'],
            'telpon' => $_POST['telpon'],
            'alamat' => $_POST['alamat'],
            'divisi_id' => $_POST['divisi_id']
        ];

        if ($_POST['type'] === 'update' && !empty($_POST['nip'])) {
            $pegawai->update($_POST['nip'], $data);
            echo "<script>
                alert('Data pegawai berhasil diperbarui.');
                window.location.href = '?url=pegawai';
            </script>";
            exit;
        } else {
            $pegawai->create($data);
            echo "<script>
                alert('Data pegawai berhasil ditambahkan.');
                window.location.href = '?url=pegawai';
            </script>";
            exit;
        }
    } catch (Exception $e) {
        echo "<div style='color: red;'>Gagal memproses data pegawai: " . $e->getMessage() . "</div>";
    }
}
?>

<div class="container">
  <form method="POST">
    <div class="card">
      <div class="card-header">
        <div class="card-title">
          <?= $pegawai_id ? 'Edit Pegawai' : 'Tambah Pegawai' ?>
        </div>
      </div>
      <div class="card-body">
        <input type="hidden" name="type" value="<?= $pegawai_id ? 'update' : 'create' ?>">

        <div class="form-group">
          <label for="nip">NIP</label>
          <input type="text" name="nip" class="form-control" value="<?= htmlspecialchars(getSafeFormValue($show_pegawai, 'nip')) ?>" required>
        </div>

        <div class="form-group">
          <label for="gender">Jenis Kelamin</label>
          <select name="gender" class="form-control" required>
            <option value="L" <?= getSafeFormValue($show_pegawai, 'gender') == 'L' ? 'selected' : '' ?>>Laki-Laki</option>
            <option value="P" <?= getSafeFormValue($show_pegawai, 'gender') == 'P' ? 'selected' : '' ?>>Perempuan</option>
          </select>
        </div>

        <div class="form-group">
          <label for="tmp_lahir">Tempat Lahir</label>
          <input type="text" name="tmp_lahir" class="form-control" value="<?= htmlspecialchars(getSafeFormValue($show_pegawai, 'tmp_lahir')) ?>" required>
        </div>

        <div class="form-group">
          <label for="tgl_lahir">Tanggal Lahir</label>
          <input type="date" name="tgl_lahir" class="form-control" value="<?= htmlspecialchars(getSafeFormValue($show_pegawai, 'tgl_lahir')) ?>" required>
        </div>

        <div class="form-group">
          <label for="telpon">Telepon</label>
          <input type="text" name="telpon" class="form-control" value="<?= htmlspecialchars(getSafeFormValue($show_pegawai, 'telpon')) ?>" required>
        </div>

        <div class="form-group">
          <label for="alamat">Alamat</label>
          <textarea name="alamat" class="form-control" required><?= htmlspecialchars(getSafeFormValue($show_pegawai, 'alamat')) ?></textarea>
        </div>

        <div class="form-group">
          <label for="divisi_id">Divisi</label>
          <select name="divisi_id" class="form-control" required>
            <option value="">Pilih Divisi</option>
            <?php foreach ($data_divisi as $d): ?>
              <option value="<?= $d['id'] ?>" <?= getSafeFormValue($show_pegawai, 'divisi_id') == $d['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($d['nama']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

      </div>
      <div class="card-footer text-right">
        <input type="hidden" name="id" value="<?= $pegawai_id ?>">
        <button type="submit" class="btn btn-primary"><?= $pegawai_id ? 'Update' : 'Tambah' ?></button>
      </div>
    </div>
  </form>
</div>
