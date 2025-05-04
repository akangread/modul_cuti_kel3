<?php
require_once 'Config/DB.php';

class Periksa
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT 
            p.id, p.tanggal, p.berat, p.tinggi, p.tensi, p.keterangan,
            ps.nama as nama_pasien, pm.nama as nama_paramedik
            FROM periksa p
            LEFT JOIN pasien ps ON ps.id = p.pasien_id
            LEFT JOIN paramedik pm ON pm.id = p.paramedik_id
        ");
        $data = $stmt->fetchAll();

        return $data;
    }

    public function show($id)
    {
        $stmt = $this->pdo->query("SELECT 
            p.id, p.tanggal, p.berat, p.tinggi, p.tensi, p.keterangan, p.pasien_id, p.paramedik_id,
            ps.nama as nama_pasien, pm.nama as nama_paramedik
            FROM periksa p
            LEFT JOIN pasien ps ON ps.id = p.pasien_id
            LEFT JOIN paramedik pm ON pm.id = p.paramedik_id
            WHERE p.id=$id
        ");
        $data = $stmt->fetch();
        return $data;
    }

    public function create($data)
    {
        $sql = "INSERT INTO periksa (tanggal, berat, tinggi, tensi, keterangan, pasien_id, paramedik_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['tanggal'],
            $data['berat'],
            $data['tinggi'],
            $data['tensi'],
            $data['keterangan'],
            $data['pasien_id'],
            $data['paramedik_id']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE periksa SET tanggal=:tanggal, berat=:berat, tinggi=:tinggi, tensi=:tensi, keterangan=:keterangan, pasien_id=:pasien_id, paramedik_id=:paramedik_id WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':tanggal', $data['tanggal']);
        $stmt->bindParam(':berat', $data['berat']);
        $stmt->bindParam(':tinggi', $data['tinggi']);
        $stmt->bindParam(':tensi', $data['tensi']);
        $stmt->bindParam(':keterangan', $data['keterangan']);
        $stmt->bindParam(':pasien_id', $data['pasien_id']);
        $stmt->bindParam(':paramedik_id', $data['paramedik_id']);
        $stmt->bindParam(':id', $id);
        
        $stmt->execute();
        return $this->show($id);
    }

    public function delete($id)
    {
        $row = $this->show($id);
        $sql = "DELETE FROM periksa WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $row;
    }
}

$periksa = new Periksa($pdo);
