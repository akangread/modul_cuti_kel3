<?php
require_once 'Config/DB.php';

class Pengajuan
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Menampilkan semua pengajuan
    public function index()
    {
        $stmt = $this->pdo->query("SELECT * FROM pengajuan_id");
        return $stmt->fetchAll();
    }

    // Menampilkan pengajuan berdasarkan ID
    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM pengajuan_id WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Membuat pengajuan baru
    public function create($data)
    {
        $sql = "INSERT INTO pengajuan_id (tanggal_awal, tanggal_akhir, jumlah, ket, status, pegawai_nip) 
                VALUES (:tanggal_awal, :tanggal_akhir, :jumlah, :ket, :status, :pegawai_nip)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tanggal_awal', $data['tanggal_awal']);
        $stmt->bindParam(':tanggal_akhir', $data['tanggal_akhir']);
        $stmt->bindParam(':jumlah', $data['jumlah']);
        $stmt->bindParam(':ket', $data['ket']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':pegawai_nip', $data['pegawai_nip']);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    // Mengupdate data pengajuan
    public function update($id, $data)
    {
        $sql = "UPDATE pengajuan_id SET tanggal_awal = :tanggal_awal, tanggal_akhir = :tanggal_akhir, 
                jumlah = :jumlah, ket = :ket, status = :status, pegawai_nip = :pegawai_nip 
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tanggal_awal', $data['tanggal_awal']);
        $stmt->bindParam(':tanggal_akhir', $data['tanggal_akhir']);
        $stmt->bindParam(':jumlah', $data['jumlah']);
        $stmt->bindParam(':ket', $data['ket']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':pegawai_nip', $data['pegawai_nip']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $this->show($id);
    }

    // Menghapus pengajuan berdasarkan ID
    public function delete($id)
    {
        $row = $this->show($id);
        $stmt = $this->pdo->prepare("DELETE FROM pengajuan_id WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $row;
    }
}
