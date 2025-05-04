<?php
require_once 'Config/DB.php';

class Pasien
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT 
            p.*, k.nama as nama_kelurahan
            FROM pasien p
            LEFT JOIN kelurahan k ON k.id = p.kelurahan_id
        ");
        $data = $stmt->fetchAll();

        return $data;
    }

    public function show($id)
    {
        $stmt = $this->pdo->query("SELECT 
            p.*, k.nama as nama_kelurahan
            FROM pasien p
            LEFT JOIN kelurahan k ON k.id = p.kelurahan_id
            WHERE p.id=$id
        ");
        $data = $stmt->fetch();
        return $data;
    }

    public function create($data)
    {
        $sql = "INSERT INTO pasien (kode, nama, tmp_lahir, tgl_lahir, gender, email, alamat, kelurahan_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['kode'],
            $data['nama'],
            $data['tmp_lahir'],
            $data['tgl_lahir'],
            $data['gender'],
            $data['email'],
            $data['alamat'],
            $data['kelurahan_id']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE pasien SET kode=:kode, nama=:nama, tmp_lahir=:tmp_lahir, tgl_lahir=:tgl_lahir, gender=:gender, email=:email, alamat=:alamat, kelurahan_id=:kelurahan_id WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':kode', $data['kode']);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':tmp_lahir', $data['tmp_lahir']);
        $stmt->bindParam(':tgl_lahir', $data['tgl_lahir']);
        $stmt->bindParam(':gender', $data['gender']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':alamat', $data['alamat']);
        $stmt->bindParam(':kelurahan_id', $data['kelurahan_id']);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $this->show($id);
    }

    public function delete($id)
    {
        $row = $this->show($id);
        $sql = "DELETE FROM pasien WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $row;
    }

    public function getLatestPasien()
    {
        $stmt = $this->pdo->query("SELECT 
            p.*, k.nama as nama_kelurahan
            FROM pasien p
            LEFT JOIN kelurahan k ON k.id = p.kelurahan_id
            ORDER BY p.id DESC LIMIT 1
        ");
        $data = $stmt->fetch();
        return $data;
    }
}

$pasien = new Pasien($pdo);
