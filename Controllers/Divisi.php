<?php
require_once 'Config/DB.php';

class Divisi
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT * FROM divisi");
        return $stmt->fetchAll();
    }
    
    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM divisi WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    

    public function create($data)
    {
        $sql = "INSERT INTO divisi (kode, nama, manager) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['kode'], 
            $data['nama'], 
            $data['manager']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE divisi SET kode=:kode, nama=:nama, manager=:manager WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':kode', $data['kode']);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':manager', $data['manager']);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $this->show($id);
    }

    public function delete($id)
    {
        $row = $this->show($id);
        $sql = "DELETE FROM divisi WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $row;
    }
}
