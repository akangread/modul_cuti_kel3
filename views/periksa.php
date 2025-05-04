<?php
require_once 'Controllers/Periksa.php';
require_once 'Controllers/Pasien.php';
require_once 'Controllers/Paramedik.php';
require_once 'Helpers/helper.php';

$list_periksa = $periksa->index();
$periksa_id = isset($_GET['id']) ? $_GET['id'] : null;
$show_periksa = $periksa_id ? $periksa->show($periksa_id) : [];

$list_pasien = $pasien->index();
$list_paramedik = $paramedik->index();

if (isset($_POST['type'])) {
  if ($_POST['type'] == 'delete') {
    $row = $periksa->delete($_POST['id']);
    echo "<script>alert('Data $row[nama] berhasil dihapus')</script>";
    echo "<script>window.location='?url=periksa'</script>";
  }
}
?>

<div class="container">
  <div class="card">
    <div class="card-body">
      <div class="mb-2">
        <a class="btn btn-success btn-sm" href="?url=periksa-input">
          Tambah Pemeriksaan
        </a>
      </div>

      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Pasien</th>
            <th>Paramedik</th>
            <th>Tanggal</th>
            <th>Berat (kg)</th>
            <th>Tinggi (cm)</th>
            <th>Tensi</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($list_periksa as $row): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $row['nama_pasien'] ?></td>
              <td><?= $row['nama_paramedik'] ?></td>
              <td><?= $row['tanggal'] ?></td>
              <td><?= $row['berat'] ?></td>
              <td><?= $row['tinggi'] ?></td>
              <td><?= $row['tensi'] ?></td>
              <td><?= $row['keterangan'] ?></td>
              <td>
                <div class="d-flex">
                  <a href="?url=periksa-input&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning mr-2">Edit</a>
                  <form action="" method="post" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="type" value="delete">
                    <button class="btn btn-sm btn-danger">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr>
            <th>No</th>
            <th>Pasien</th>
            <th>Paramedik</th>
            <th>Tanggal</th>
            <th>Berat (kg)</th>
            <th>Tinggi (cm)</th>
            <th>Tensi</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>