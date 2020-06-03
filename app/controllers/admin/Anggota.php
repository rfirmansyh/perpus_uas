<?php 

class Anggota extends Controller {
    public function index() {
        $data['title'] = 'Anggota';
        $data['anggota_all'] = $this->model('Anggota_model')->getAll();
        $data['jenis_kelamin_all'] = $this->model('Anggota_model')->getAllJenisKelamin();
        $data['status_all'] = $this->model('Anggota_model')->getAllStatus();
        $this->view('admin/_layouts/header', $data);
        $this->view('admin/anggota', $data);
    }

    public function detail($id) {
        echo json_encode($this->model('Anggota_model')->getAnggotaById($id));
    }

    public function tambah() {
        if ( $this->model('Anggota_model')->addAnggota($_POST, $_FILES['gambar']) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Anggota berhasil ditambahkan', 'success');
            header('Location: '.BASE_URL.'admin/anggota/');
            exit;
        }
    }

    public function ubah() {
        if ( $this->model('Anggota_model')->updateAnggota($_POST, $_FILES['gambar']) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Anggota berhasil Diubah', 'warning');
            header('Location: '.BASE_URL.'admin/anggota/');
            exit;
        } else {
            Flasher::setFlash('Berhasil', 'Data Anggota berhasil Diubah', 'warning');
            header('Location: '.BASE_URL.'admin/anggota/');
            exit;
        }
    }   

    public function ubahPassword() {
        if ( $this->model('Anggota_model')->updatePassword($_POST) > 0  ) {
            Flasher::setFlash('Berhasil', 'Password Anggota berhasil Diubah', 'warning');
            header('Location: '.BASE_URL.'admin/anggota/');
            exit;
        } else {
            Flasher::setFlash('Berhasil', 'Password Anggota berhasil Diubah', 'warning');
            header('Location: '.BASE_URL.'admin/anggota/');
            exit;
        }
    }

    public function hapus($id) {
        if ( $this->model('Anggota_model')->deleteAnggota($id) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Anggota berhasil Dihapus', 'warning');
            header('Location: '.BASE_URL.'admin/anggota/');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Data Anggota Gagal Dihapus', 'warning');
            header('Location: '.BASE_URL.'admin/anggota/');
            exit;
        }
    }

    public function checkNisn() {
        echo json_encode($this->model('Anggota_model')->getAvailableByNisn('anggota',$_POST['nisn']));
    }

}