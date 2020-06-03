<?php 

class Rak extends Controller {
 
    public function index() {
        $data['title'] = 'Rak';
        $data['rak_all'] = $this->model('Buku_model')->getAllRak();
        $data['lokasi_all'] = $this->model('Buku_model')->getAllLocation();
        $this->view('admin/_layouts/header', $data);
        $this->view('admin/rak', $data);
    }

    public function detail($id) {
        echo json_encode($this->model('Buku_model')->getRakById($id));
    }

    public function tambah() {
        if ( $this->model('Buku_model')->addRak($_POST) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Rak berhasil ditambahkan', 'success');
            header('Location: '.BASE_URL.'admin/rak/');
            exit;
        }
    }

    public function hapus($id) {
        if ( $this->model('Buku_model')->deleteRakById($id) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Rak berhasil Dihapus', 'warning');
            header('Location: '.BASE_URL.'admin/rak/');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Data Rak Gagal Dihapus', 'warning');
            header('Location: '.BASE_URL.'admin/rak/');
            exit;
        }
    }

    public function ubah() {
        if ( $this->model('Buku_model')->updateRak($_POST) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Rak berhasil Diubah', 'warning');
            header('Location: '.BASE_URL.'admin/rak/');
            exit;
        } else {
            Flasher::setFlash('Berhasil', 'Data Rak berhasil Diubah', 'warning');
            header('Location: '.BASE_URL.'admin/rak/');
            exit;
        }
    }

}