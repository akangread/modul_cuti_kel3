<?php
require_once 'Controllers/JatahCuti.php';
require_once 'Helpers/helper.php';

$jatah = new JatahCuti($pdo);
$list_cuti = $jatah->index();

if (isset($_POST['type']) && $_POST['type'] === 'delete') {
    $row = $jatah->delete($_POST['id']);
    echo "<script>alert('Data tahun {$row['tahun']} berhasil dihapus')</script>";
    echo "<script>window.location='?url=jatah-cuti'</script>";
}
?>

<div class="container">
  <div class="card">
    <div class="card-body">
      <div class="mb-2">
        <a class="btn btn-success btn-sm" href="?url=jatahcuti-input">Tambah Jatah Cuti</a>
      </div>

      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Tahun</th>
            <th>Jumlah</th>
            <th>NIP Pegawai</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($list_cuti as $row): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $row['tahun'] ?></td>
              <td><?= $row['jumlah'] ?></td>
              <td><?= $row['pegawai_nip'] ?></td>
              <td>
                <div class="d-flex">
                  <a href="?url=jatahcuti-input&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning mr-2">Edit</a>
                  <form action="" method="post" onsubmit="return confirm('Yakin ingin hapus data ini?')">
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
            <th>Tahun</th>
            <th>Jumlah</th>
            <th>NIP Pegawai</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
