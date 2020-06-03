<?php 

class Profil extends Controller {
    public function index() {
        $data['title'] = 'Profil Saya';
        $data['profile'] = $this->model('Anggota_model')->getPetugasById($_SESSION['petugas']['petugas_id']);
        $this->view('admin/_layouts/header', $data);
        $this->view('admin/profil', $data);
    }

    public function updateProfil() {
        if ( $this->model('Anggota_model')->updateProfil($_POST) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Profil berhasil Diubah', 'success');
            header('Location: '.BASE_URL.'admin/profil');
            exit;
        } else {
            Flasher::setFlash('Berhasil', 'Data Profil berhasil Diubah', 'success');
            header('Location: '.BASE_URL.'admin/profil');
            exit;
        }
    }

    public function updateImage() {
        if ( $this->model('Anggota_model')->updateImage($_POST, $_FILES['gambar']) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Gambar berhasil Diubah', 'success');
            header('Location: '.BASE_URL.'admin/profil');
            exit;
        } else {
            Flasher::setFlash('Berhasil', 'Data Gambar berhasil Diubah', 'success');
            header('Location: '.BASE_URL.'admin/profil');
            exit;
        }
    }

    public function updatePassword() {
        if ( $this->model('Anggota_model')->updatePasswordProfil($_POST) > 0  ) {
            Flasher::setFlash('Berhasil', 'Password berhasil Diubah', 'success');
            header('Location: '.BASE_URL.'admin/profil/');
            exit;
        } else {
            Flasher::setFlash('Berhasil', 'Password berhasil Diubah', 'success');
            header('Location: '.BASE_URL.'admin/profil/');
            exit;
        }
    }
}