<?php
require_once 'Config/DB.php';

class UnitKerja
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT * FROM unit_kerja");
        $data = $stmt->fetchAll();
        return $data;
    }

    public function show($id)
    {
        $stmt = $this->pdo->query("SELECT * FROM unit_kerja WHERE id=$id");
        $data = $stmt->fetch();
        return $data;
    }

    public function create($data)
    {
        $sql = "INSERT INTO unit_kerja (id, nama) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$data['id'], $data['nama']]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data) {
        $sql = "UPDATE unit_kerja SET nama=:nama WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $this->show($id);
    }

    public function delete($id) {
        $row = $this->show($id);
        $sql = "DELETE FROM unit_kerja WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $row;
    }
}

$unitkerja = new UnitKerja($pdo);
