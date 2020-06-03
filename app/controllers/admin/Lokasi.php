<?php 

class Lokasi extends Controller {
    public function index() {
        $data['title'] = 'Lokasi Rak';
        $data['lokasi_all'] = $this->model('Buku_model')->getAllLocation();
        $this->view('admin/_layouts/header', $data);
        $this->view('admin/lokasi', $data);
    }

    public function detail($id) {
        echo json_encode($this->model('Buku_model')->getLocationById($id));
    }

    public function tambah() {
        if ( $this->model('Buku_model')->addLocation($_POST) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Lokasi Rak Buku berhasil ditambahkan', 'success');
            header('Location: '.BASE_URL.'admin/lokasi/');
            exit;
        }
    }

    public function hapus($id) {
        if ( $this->model('Buku_model')->deleteLocationById($id) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Lokasi Rak Buku berhasil Dihapus', 'warning');
            header('Location: '.BASE_URL.'admin/lokasi/');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Data Lokasi Rak Buku Gagal Dihapus', 'warning');
            header('Location: '.BASE_URL.'admin/lokasi/');
            exit;
        }
    }

    public function ubah() {
        if ( $this->model('Buku_model')->updateLocation($_POST) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Lokasi Rak Buku berhasil Diubah', 'warning');
            header('Location: '.BASE_URL.'admin/lokasi/');
            exit;
        } else {
            Flasher::setFlash('Berhasil', 'Data Lokasi Rak Buku berhasil Diubah', 'warning');
            header('Location: '.BASE_URL.'admin/lokasi/');
            exit;
        }
    }

}