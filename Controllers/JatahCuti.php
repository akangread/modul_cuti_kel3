<?php
require_once 'Config/DB.php';

class JatahCuti
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Menampilkan semua data jatah cuti
    public function index()
    {
        $stmt = $this->pdo->query("SELECT * FROM jatah_cuti");
        return $stmt->fetchAll();
    }

    // Menampilkan satu data berdasarkan ID
    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM jatah_cuti WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Menambah data jatah cuti dengan validasi nip pegawai
    public function create($data)
    {
        // Cek apakah NIP pegawai valid (ada di tabel pegawai)
        $check = $this->pdo->prepare("SELECT COUNT(*) FROM pegawai WHERE nip = :nip");
        $check->bindParam(':nip', $data['pegawai_nip']);
        $check->execute();

        if ($check->fetchColumn() == 0) {
            throw new Exception("Pegawai dengan NIP {$data['pegawai_nip']} tidak ditemukan.");
        }

        // Insert jika valid
        $sql = "INSERT INTO jatah_cuti (tahun, jumlah, pegawai_nip) 
                VALUES (:tahun, :jumlah, :pegawai_nip)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tahun', $data['tahun']);
        $stmt->bindParam(':jumlah', $data['jumlah']);
        $stmt->bindParam(':pegawai_nip', $data['pegawai_nip']);
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

    // Memperbarui data jatah cuti
    public function update($id, $data)
    {
        // Cek apakah NIP pegawai valid
        $check = $this->pdo->prepare("SELECT COUNT(*) FROM pegawai WHERE nip = :nip");
        $check->bindParam(':nip', $data['pegawai_nip']);
        $check->execute();

        if ($check->fetchColumn() == 0) {
            throw new Exception("Pegawai dengan NIP {$data['pegawai_nip']} tidak ditemukan.");
        }

        $sql = "UPDATE jatah_cuti 
                SET tahun = :tahun, jumlah = :jumlah, pegawai_nip = :pegawai_nip 
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tahun', $data['tahun']);
        $stmt->bindParam(':jumlah', $data['jumlah']);
        $stmt->bindParam(':pegawai_nip', $data['pegawai_nip']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $this->show($id);
    }

    // Menghapus data jatah cuti berdasarkan ID
    public function delete($id)
    {
        $row = $this->show($id);
        $stmt = $this->pdo->prepare("DELETE FROM jatah_cuti WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $row;
    }
}
?>
