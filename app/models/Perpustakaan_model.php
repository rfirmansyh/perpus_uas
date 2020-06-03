<?php

class Perpustakaan_model {

    private $table = 'pengembalian';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllPengembalian() {
        $this->db->query("SELECT * FROM pengembalian");
        return $this->db->resultSet();
    }

    public function getAllPeminjamanFiltered() {
        $query = "SELECT pm.id, ag.nama_lengkap,pm.buku_id,bk.judul_buku, pm.tanggal_pinjam, pm.tanggal_kembali, sp.nama_status
                    FROM peminjaman pm
                    JOIN anggota ag
                        ON pm.anggota_id = ag.id
                    JOIN buku bk
                        ON pm.buku_id = bk.id
                    JOIN status_peminjaman sp
                        ON pm.status_peminjaman_id = sp.id";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getAllPeminjamanWithBookAndUser() {
        $query = "SELECT pm.*, bk.judul_buku, ag.nama_lengkap
                    FROM peminjaman pm 
                    JOIN buku bk 
                        ON pm.buku_id = bk.id
                    JOIN anggota ag
                        ON pm.anggota_id = ag.id
                    WHERE pm.status_peminjaman_id = 1";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getPeminjamanById($id) {
        $this->db->query("SELECT pm.*, pg.nama_lengkap as petugas_nama FROM peminjaman pm JOIN petugas pg ON pm.petugas_id = pg.id WHERE pm.id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    
    public function getPeminjamanTanggalKembali($id) {
        $this->db->query("SELECT pm.tanggal_kembali FROM peminjaman pm WHERE pm.id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getPeminjamanDetailById($id) {
        $query = "SELECT pm.id, pm.tanggal_pinjam, pm.tanggal_kembali, pm.buku_id, bk.judul_buku, ag.nama_lengkap as nama_anggota, ag.gambar,ag.no_hp as anggota_nomor, pg.nama_lengkap as nama_petugas, pg.no_hp as petugas_nomor, sp.nama_status
                    FROM peminjaman pm
                    JOIN anggota ag
                        ON pm.anggota_id = ag.id
                    JOIN buku bk
                        ON pm.buku_id = bk.id
                    JOIN petugas pg
                        ON pm.petugas_id = pg.id
                    JOIN status_peminjaman sp
                        ON pm.status_peminjaman_id = sp.id
                    WHERE pm.id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }


    public function addPengembalian($data) {
        $query = "INSERT INTO pengembalian
                    VALUES
                    ('', :peminjaman_id, :tanggal_pengembalian, :denda);
                UPDATE peminjaman SET status_peminjaman_id = '2' WHERE peminjaman.id = :id;
                UPDATE buku bk 
                    JOIN peminjaman pm ON pm.buku_id = bk.id
                        SET bk.stok = (bk.stok + 1) WHERE bk.id = :peminjaman_buku_id";
        $v_peminjaman_id = Form_validation::validate($data['peminjaman_id'], 'Data Peminjaman' ,'required');    
        $v_tanggal_pengembalian = Form_validation::validate($data['tanggal_pengembalian'], 'Tanggal Pengembalian' ,'required');    
        switch(true) {
            case ( strlen($v_peminjaman_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_peminjaman_id, 'danger');
                header('Location: '.BASE_URL.'admin/pengembalian/');
                return false;
            case ( strlen($v_tanggal_pengembalian) > 2 ) :
                Flasher::setFlash('Gagal', $v_tanggal_pengembalian, 'danger');
                header('Location: '.BASE_URL.'admin/pengembalian/');
                return false;
            default:
                break;
        }
        $this->db->query($query);
        $this->db->bind('peminjaman_id', $data['peminjaman_id']);
        $this->db->bind('tanggal_pengembalian', $data['tanggal_pengembalian']);
        $this->db->bind('denda', $data['denda']); 
        $this->db->bind('id', $data['peminjaman_id']); 
        $this->db->bind('peminjaman_buku_id', $data['peminjaman_buku_id']); 
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function addPeminjaman($data) {
        $query = "INSERT INTO peminjaman
                    VALUES
                    ('', :tanggal_pinjam, :tanggal_kembali, :buku_id, :anggota_id, :petugas_id, '1');
                    UPDATE buku SET stok = (stok-1) WHERE id = :id";
        $v_tanggal_pinjam = Form_validation::validate($data['tanggal_pinjam'], 'Tanggal Pinjam', 'required');
        $v_tanggal_kembali = Form_validation::validate($data['tanggal_kembali'], 'Tanggal Kembali', 'required');
        $v_buku_id = Form_validation::validate($data['buku_id'], 'Data Buku', 'required');
        $v_anggota_id = Form_validation::validate($data['anggota_id'], 'Data Anggota', 'required');
        $v_petugas_id = Form_validation::validate($data['petugas_id'], 'Data Petugas', 'required');

        switch(true) {
            case ( strlen($v_tanggal_pinjam) > 2 ) :
                Flasher::setFlash('Gagal', $v_tanggal_pinjam, 'danger');
                header('Location: '.BASE_URL.'admin/peminjaman/');
                return false;
            case ( strlen($v_tanggal_kembali) > 2 ) :
                Flasher::setFlash('Gagal', $v_tanggal_kembali, 'danger');
                header('Location: '.BASE_URL.'admin/peminjaman/');
                return false;
            case ( strlen($v_buku_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_buku_id, 'danger');
                header('Location: '.BASE_URL.'admin/peminjaman/');
                return false;
            case ( strlen($v_anggota_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_anggota_id, 'danger');
                header('Location: '.BASE_URL.'admin/peminjaman/');
                return false;
            case ( strlen($v_petugas_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_petugas_id, 'danger');
                header('Location: '.BASE_URL.'admin/peminjaman/');
                return false;
            default:
                break;
        }

        $this->db->query($query);
        $this->db->bind('tanggal_pinjam', $data['tanggal_pinjam']);
        $this->db->bind('tanggal_kembali', $data['tanggal_kembali']);
        $this->db->bind('buku_id', $data['buku_id']);
        $this->db->bind('anggota_id', $data['anggota_id']);
        $this->db->bind('petugas_id', $data['petugas_id']); 
        $this->db->bind('id', $data['buku_id']); 
        $this->db->execute();

        return $this->db->rowCount();
    }



    public function deletePengembalian($id, $peminjaman_id) {
        $query = "DELETE FROM pengembalian WHERE id = :id;
                UPDATE peminjaman SET status_peminjaman_id = '1' WHERE peminjaman.id = :peminjaman_id";
        $this->db->query($query);
        $this->db->bind('id', $id); 
        $this->db->bind('peminjaman_id', $peminjaman_id); 
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function deletePeminjaman($id, $buku_id) {
        $query = "DELETE FROM peminjaman WHERE id = :id;
                    UPDATE buku SET stok = (stok+1) WHERE buku.id = :buku_id";
        $this->db->query($query);
        $this->db->bind('id', $id); 
        $this->db->bind('buku_id', $buku_id); 
        $this->db->execute();
        return $this->db->rowCount();
    }


    public function updatePeminjaman($data) {
        $query = "UPDATE peminjaman SET
                    tanggal_pinjam = :tanggal_pinjam,
                    tanggal_kembali = :tanggal_kembali,
                    buku_id = :buku_id,
                    anggota_id = :anggota_id,
                    petugas_id = :petugas_id
                WHERE id = :id;
                UPDATE buku SET stok = (stok+1) WHERE buku.id = :buku_old_id;
                UPDATE buku SET stok = (stok-1) WHERE buku.id = :buku_id";

        $v_tanggal_pinjam = Form_validation::validate($data['tanggal_pinjam'], 'Tanggal Pinjam' ,'required');
        $v_tanggal_kembali = Form_validation::validate($data['tanggal_kembali'], 'Tanggal Kembali' ,'required');
        $v_buku_id = Form_validation::validate($data['buku_id'], 'Data Buku' ,'required');
        $v_anggota_id = Form_validation::validate($data['anggota_id'], 'Data Anggota' ,'required');
        $v_petugas_id = Form_validation::validate($data['petugas_id'], 'Data Petugas' ,'required');

        switch(true) {
            case ( strlen($v_tanggal_pinjam) > 2 ) :
                Flasher::setFlash('Gagal', $v_tanggal_pinjam, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_tanggal_kembali) > 2 ) :
                Flasher::setFlash('Gagal', $v_tanggal_kembali, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_buku_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_buku_id, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_anggota_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_anggota_id, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_petugas_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_petugas_id, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            default:
                break;
        }

        $this->db->query($query);
        $this->db->bind('tanggal_pinjam', $data['tanggal_pinjam']);
        $this->db->bind('tanggal_kembali', $data['tanggal_kembali']);
        $this->db->bind('buku_id', $data['buku_id']);
        $this->db->bind('anggota_id', $data['anggota_id']);
        $this->db->bind('petugas_id', $data['petugas_id']);
        $this->db->bind('id', $data['peminjaman_id']);
        $this->db->bind('buku_id', $data['buku_id']);
        $this->db->bind('buku_old_id', $data['buku_old_id']);
        $this->db->execute();
        $this->db->rowCount();

    }

}