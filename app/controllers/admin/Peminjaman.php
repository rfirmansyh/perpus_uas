<?php 

class Peminjaman extends Controller {
    public function index() {
        $data['title'] = 'Peminjaman';
        $data['peminjaman_all'] = $this->model('Perpustakaan_model')->getAllPeminjamanFiltered();
        $data['buku_available_all'] = $this->model('Buku_model')->getAvailableBook();
        $data['anggota_active_all'] = $this->model('Anggota_model')->getActiveAnggota();
        $data['petugas_active_all'] = $this->model('Anggota_model')->getActivePetugas();
        $this->view('admin/_layouts/header', $data);
        $this->view('admin/peminjaman', $data);
    }

    public function detail($id) {
        echo json_encode($this->model('Perpustakaan_model')->getPeminjamanById($id));
    }

    public function tambah() {
        if ( $this->model('Perpustakaan_model')->addPeminjaman($_POST) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Peminjaman berhasil ditambahkan', 'success');
            header('Location: '.BASE_URL.'admin/peminjaman/');
            exit;
        }
    }

    public function ubah() {
        if ( $this->model('Perpustakaan_model')->updatePeminjaman($_POST) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Peminjaman berhasil Diubah', 'warning');
            header('Location: '.BASE_URL.'admin/peminjaman/');
            exit;
        } else {
            Flasher::setFlash('Berhasil', 'Data Peminjaman berhasil Diubah', 'warning');
            header('Location: '.BASE_URL.'admin/peminjaman/');
            exit;
        }
    }

    public function hapus($id, $buku_id) {
        if ( $this->model('Perpustakaan_model')->deletePeminjaman($id, $buku_id) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Peminjaman berhasil Dihapus', 'warning');
            header('Location: '.BASE_URL.'admin/peminjaman/');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Data Peminjaman Gagal Dihapus', 'warning');
            header('Location: '.BASE_URL.'admin/peminjaman/');
            exit;
        }
    }

}