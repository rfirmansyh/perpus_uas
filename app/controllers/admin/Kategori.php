<?php 

class Kategori extends Controller {

    public function index() {
        $data['title'] = 'Kategori';
        $data['categories'] = $this->model('Buku_model')->getAllCategories();
        $this->view('admin/_layouts/header', $data);
        $this->view('admin/kategori', $data);
    }

    public function detail($id) {
        echo json_encode($this->model('Buku_model')->getCategoryById($id));
    }

    public function tambah() {
        if ( $this->model('Buku_model')->addCategory($_POST) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Kategori berhasil ditambahkan', 'success');
            header('Location: '.BASE_URL.'admin/kategori/');
            exit;
        }
    }

    public function hapus($id) {
        if ( $this->model('Buku_model')->deleteCategoryById($id) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Kategori berhasil Dihapus', 'warning');
            header('Location: '.BASE_URL.'admin/kategori/');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Data Kategori Gagal Dihapus', 'warning');
            header('Location: '.BASE_URL.'admin/kategori/');
            exit;
        }
    }

    public function ubah() {
        if ( $this->model('Buku_model')->updateCategory($_POST) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Kategori berhasil Diubah', 'warning');
            header('Location: '.BASE_URL.'admin/kategori/');
            exit;
        } else {
            Flasher::setFlash('Berhasil', 'Data Kategori berhasil Diubah', 'warning');
            header('Location: '.BASE_URL.'admin/kategori/');
            exit;
        }
    }


}