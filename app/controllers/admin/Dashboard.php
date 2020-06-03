<?php 

class Dashboard extends Controller {


    public function index() {
        $data['title'] = 'Dashboard';
        $data['total_book'] = $this->getTotalBook()["SUM(buku.stok)"];
        $data['total_anggota'] = $this->getTotalAnggota()["COUNT(anggota.id)"];
        $data['total_peminjaman'] = $this->getTotalPeminjaman()["COUNT(peminjaman.id)"];
        $this->view('admin/_layouts/header', $data);
        $this->view('admin/dashboard', $data);
    }

    public function getPeminjamanEveryMonth() {
        $db = new Database;
        $db->query("SELECT MONTHNAME(pm.tanggal_pinjam) as bulan, COUNT(pm.buku_id) AS total_buku FROM peminjaman pm GROUP BY MONTHNAME(pm.tanggal_pinjam) UNION ALL SELECT 'SUM', COUNT(pm.buku_id) FROM peminjaman pm");
        echo json_encode($db->resultSet());
    }

    public function getTotalBook() {
        $db = new Database;
        $db->query("SELECT SUM(buku.stok) FROM buku");
        return $db->single();
    }

    public function getTotalAnggota() {
        $db = new Database;
        $db->query("SELECT COUNT(anggota.id) FROM anggota");
        return $db->single();   
    }

    public function getTotalPeminjaman() {
        $db = new Database;
        $db->query("SELECT COUNT(peminjaman.id) from peminjaman");
        return $db->single();   
    }

 
 
 
}