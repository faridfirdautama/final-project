<?php

class Barang_model
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllBarang()
    {
        $this->db->query("SELECT * FROM data_barang");
        return $this->db->resultSet();
    }

    public function getDetailBarang($id)
    {
        $this->db->query("SELECT * FROM data_barang WHERE id = '$id'");
        return $this->db->single();
    }

    public function countBarang()
    {
        $this->db->query("SELECT COUNT(*) FROM data_barang");
        return $this->db->numRows();
    }

    public function tambahBarang($data)
    {
        $kode_barang = htmlspecialchars($data['kode_barang']);
        $nama_barang = htmlspecialchars($data['nama_barang']);
        $tipe_barang = htmlspecialchars($data['tipe_barang']);
        $jmlh_stok = htmlspecialchars($data['jmlh_stok']);
        $lokasi = htmlspecialchars($data['lokasi']);
        $tgl_regist = date('Y-m-d');

        $query = "INSERT INTO data_barang VALUES
        (null, :kode_barang, :nama_barang, :tipe_barang, :jmlh_stok, :lokasi, :tgl_regist)";

        $this->db->query($query);
        $fields = [
            'kode_barang' => $kode_barang,
            'nama_barang' =>  $nama_barang,
            'tipe_barang' => $tipe_barang,
            'jmlh_stok' =>  $jmlh_stok,
            'lokasi' => $lokasi,
            'tgl_regist' => $tgl_regist
        ];
        $this->db->binds($fields);

        try {
            $this->db->execute();
        } catch (\PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                return 0;
                die;
            }
        }

        return $this->db->rowCount();
    }

    public function ubahBarang($id, $data)
    {
        $kode_barang = htmlspecialchars($data['kode_barang']);
        $nama_barang = htmlspecialchars($data['nama_barang']);
        $tipe_barang = htmlspecialchars($data['tipe_barang']);
        $jmlh_stok = htmlspecialchars($data['jmlh_stok']);
        $lokasi = htmlspecialchars($data['lokasi']);
        $tgl_regist = date('Y-m-d');

        $sql = "UPDATE data_barang SET
                kode_barang = :kode_barang,
                nama_barang = :nama_barang,
                tipe_barang = :tipe_barang,
                jmlh_stok = :jmlh_stok,
                lokasi = :lokasi,
                tgl_regist = :tgl_regist
                WHERE id = :id";

        $this->db->query($sql);
        $fields = [
            'kode_barang' => $kode_barang,
            'nama_barang' =>  $nama_barang,
            'tipe_barang' => $tipe_barang,
            'jmlh_stok' =>  $jmlh_stok,
            'lokasi' => $lokasi,
            'tgl_regist' => $tgl_regist,
            'id' => $id
        ];
        $this->db->binds($fields);

        try {
            $this->db->execute();
        } catch (\PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                return 0;
                die;
            }
        }

        return $this->db->rowCount();
    }

    public function hapusBarang($id)
    {
        //Cek apakah id buku ada dalam database
        $this->db->query("SELECT id FROM data_barang WHERE id = '$id'");
        $row = $this->db->numRows();
        //Jika row berisikan nilai 0 maka tidak ada buku yang ingin dihapus dalam database
        if ($row == 0) {
            return 0;
        }

        $this->db->query("DELETE FROM data_barang WHERE id = :id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return 1;
    }
}
