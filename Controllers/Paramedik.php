<?php
require_once 'Config/DB.php';

class Paramedik
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT 
            p.*, uk.nama as nama_unit_kerja
            FROM paramedik p
            LEFT JOIN unit_kerja uk ON uk.id = p.unit_kerja_id
        ");
        $data = $stmt->fetchAll();

        return $data;
    }

    public function show($id)
    {
        $stmt = $this->pdo->query("SELECT 
            p.*, uk.nama as nama_unit_kerja
            FROM paramedik p
            LEFT JOIN unit_kerja uk ON uk.id = p.unit_kerja_id
            WHERE p.id=$id
        ");
        $data = $stmt->fetch();
        return $data;
    }

    public function create($data)
    {
        $sql = "INSERT INTO paramedik (nama, gender, tmp_lahir, tgl_lahir, kategori, telpon, alamat, unit_kerja_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['nama'], 
            $data['gender'], 
            $data['tmp_lahir'], 
            $data['tgl_lahir'], 
            $data['kategori'], 
            $data['telpon'], 
            $data['alamat'], 
            $data['unit_kerja_id']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE paramedik SET nama=:nama, gender=:gender, tmp_lahir=:tmp_lahir, tgl_lahir=:tgl_lahir, kategori=:kategori, telpon=:telpon, alamat=:alamat, unit_kerja_id=:unit_kerja_id WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':gender', $data['gender']);
        $stmt->bindParam(':tmp_lahir', $data['tmp_lahir']);
        $stmt->bindParam(':tgl_lahir', $data['tgl_lahir']);
        $stmt->bindParam(':kategori', $data['kategori']);
        $stmt->bindParam(':telpon', $data['telpon']);
        $stmt->bindParam(':alamat', $data['alamat']);
        $stmt->bindParam(':unit_kerja_id', $data['unit_kerja_id']);
        $stmt->bindParam(':id', $id);
        
        $stmt->execute();
        return $this->show($id);
    }

    public function delete($id)
    {
        $row = $this->show($id);
        $sql = "DELETE FROM paramedik WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $row;
    }
}

$paramedik = new Paramedik($pdo);
