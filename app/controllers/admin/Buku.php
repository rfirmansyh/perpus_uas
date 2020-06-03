<?php 

class Buku extends Controller {
    

    public function index() {
        
        $data['buku_all'] = $this->model('Buku_model')->getPreviewAll();
        $data['category_all'] = $this->model('Buku_model')->getAllCategories();
        $data['rak'] = $this->model('Rak_model')->getAll();
        $data['title'] = 'buku';
        $this->view('admin/_layouts/header', $data);
        $this->view('admin/buku', $data);
    }

    public function detail($id) {
        echo json_encode($this->model('Buku_model')->getById($id));
    }

    

    public function tambah() {
        if ( $this->model('Buku_model')->add($_POST, $_FILES['gambar']) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Buku berhasil ditambahkan', 'success');
            header('Location: '.BASE_URL.'admin/buku/');
            exit;
        }
    }

    public function dataUbah() {
        echo json_encode($this->model('Buku_model')->getById($_POST['id']));
    }

    public function ubah() {
        if ( $this->model('Buku_model')->update($_POST, $_FILES['gambar']) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Buku berhasil Diubah', 'warning');
            header('Location: '.BASE_URL.'admin/buku/');
            exit;
        } else {
            Flasher::setFlash('Berhasil', 'Data Buku berhasil Diubah', 'warning');
            header('Location: '.BASE_URL.'admin/buku/');
            exit;
        }
    }

    public function hapus($id) {
        if ( $this->model('Buku_model')->delete($id) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Buku berhasil Dihapus', 'warning');
            header('Location: '.BASE_URL.'admin/buku/');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Data Buku Gagal Dihapus', 'warning');
            header('Location: '.BASE_URL.'admin/buku/');
            exit;
        }
    }

}