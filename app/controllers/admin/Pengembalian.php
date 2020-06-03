<?php 

class Pengembalian extends Controller {
    public function index() {
        $data['title'] = 'Pengembalian';
        $data['pengembalian_all'] = $this->model('Perpustakaan_model')->getAllPengembalian();
        $data['peminjaman_all_with'] = $this->model('Perpustakaan_model')->getAllPeminjamanWithBookAndUser();
        $this->view('admin/_layouts/header', $data);
        $this->view('admin/pengembalian', $data);
    }

    public function getTanggalKembaliByPeminjamanId() {
        $tanggal_kembali_peminjaman = $this->model('Perpustakaan_model')->getPeminjamanTanggalKembali($_POST['id']);
        echo json_encode($tanggal_kembali_peminjaman);
    }

    public function detail($id) {
        echo json_encode($this->model('Perpustakaan_model')->getPeminjamanDetailById($id));
    }

    public function tambah() {
        if ( $this->model('Perpustakaan_model')->addPengembalian($_POST) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Pengembalian berhasil ditambahkan', 'success');
            header('Location: '.BASE_URL.'admin/pengembalian/');
            exit;
        }
    }

    public function hapus($id, $peminjaman_id) {
        if ( $this->model('Perpustakaan_model')->deletePengembalian($id, $peminjaman_id) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Pengembalian berhasil Dihapus', 'warning');
            header('Location: '.BASE_URL.'admin/pengembalian/');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Data Pengembalian Gagal Dihapus', 'warning');
            header('Location: '.BASE_URL.'admin/pengembalian/');
            exit;
        }
    }
}