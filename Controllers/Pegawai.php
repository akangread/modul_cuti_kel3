<?php
require_once 'Config/DB.php';  // Pastikan untuk memasukkan koneksi DB

class Pegawai
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Method untuk mengambil semua data pegawai
    public function index()
    {
        $sql = "SELECT pegawai.*, divisi.nama AS divisi 
                FROM pegawai 
                LEFT JOIN divisi ON pegawai.divisi_id = divisi.id";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    // Method untuk mengambil data pegawai berdasarkan ID
    public function show($nip) {
    $sql = "SELECT * FROM pegawai WHERE nip = :nip";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':nip' => $nip]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    // Method untuk memeriksa apakah NIP sudah ada
    public function existsNip($nip)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM pegawai WHERE nip = :nip");
        $stmt->bindParam(':nip', $nip);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Method untuk menambahkan pegawai baru
    public function create($data) {
    $sql = "INSERT INTO pegawai (
                nip, gender, tmp_lahir, tgl_lahir, telpon, alamat, divisi_id
            ) VALUES (
                :nip, :gender, :tmp_lahir, :tgl_lahir, :telpon, :alamat, :divisi_id
            )";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        ':nip' => $data['nip'],
        ':gender' => $data['gender'],
        ':tmp_lahir' => $data['tmp_lahir'],
        ':tgl_lahir' => $data['tgl_lahir'],
        ':telpon' => $data['telpon'],
        ':alamat' => $data['alamat'],
        ':divisi_id' => $data['divisi_id']
    ]);
}


    // Method untuk mengupdate data pegawai
    public function update($nip, $data) {
    $sql = "UPDATE pegawai SET 
                gender = :gender,
                tmp_lahir = :tmp_lahir,
                tgl_lahir = :tgl_lahir,
                telpon = :telpon,
                alamat = :alamat,
                divisi_id = :divisi_id
            WHERE nip = :nip";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        ':nip' => $nip,
        ':gender' => $data['gender'],
        ':tmp_lahir' => $data['tmp_lahir'],
        ':tgl_lahir' => $data['tgl_lahir'],
        ':telpon' => $data['telpon'],
        ':alamat' => $data['alamat'],
        ':divisi_id' => $data['divisi_id']
    ]);
}


    // Method untuk menghapus pegawai
    public function delete($nip)
{
    $row = $this->show($nip);
    if (!$row) {
        throw new Exception("Data pegawai tidak ditemukan.");
    }

    try {
        $stmt = $this->pdo->prepare("DELETE FROM pegawai WHERE nip = :nip");
        $stmt->bindParam(':nip', $nip);
        $stmt->execute();

        return $row; // kembalikan data sebelum dihapus, jika ingin ditampilkan
    } catch (PDOException $e) {
        // Tangani pelanggaran constraint foreign key
        if ($e->getCode() === '23000') {
            throw new Exception("Tidak dapat menghapus pegawai karena masih terhubung dengan data cuti.");
        }

        // Lempar kembali jika error bukan karena constraint
        throw $e;
    }
}

    }
?>
