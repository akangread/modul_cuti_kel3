<?php
require_once 'Controllers/Pengajuan.php';
require_once 'Helpers/helper.php';

$pengajuan = new Pengajuan($pdo);
$list_pengajuan = $pengajuan->index();

if (isset($_POST['type']) && $_POST['type'] === 'delete') {
    $row = $pengajuan->delete($_POST['id']);
    echo "<script>alert('Pengajuan dengan ID {$row['id']} berhasil dihapus')</script>";
    echo "<script>window.location='?url=pengajuan'</script>";
}
?>

<div class="container">
  <div class="card">
    <div class="card-body">
      <div class="mb-2">
        <a class="btn btn-success btn-sm" href="?url=pengajuan-input">Tambah Pengajuan</a>
      </div>

      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal Awal</th>
            <th>Tanggal Akhir</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th>Status</th>
            <th>NIP Pegawai</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($list_pengajuan as $row): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $row['tanggal_awal'] ?></td>
              <td><?= $row['tanggal_akhir'] ?></td>
              <td><?= $row['jumlah'] ?></td>
              <td><?= $row['ket'] ?></td>
              <td><?= $row['status'] ?></td>
              <td><?= $row['pegawai_nip'] ?></td>
              <td>
                <div class="d-flex">
                  <a href="?url=pengajuan-input&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning mr-2">Edit</a>
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
            <th>Tanggal Awal</th>
            <th>Tanggal Akhir</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th>Status</th>
            <th>NIP Pegawai</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
