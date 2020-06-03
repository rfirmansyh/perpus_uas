<?php 



class Petugas extends Controller {

    public function index() {
        $data['title'] = 'Petugas';
        $data['petugas_all'] = $this->model('Anggota_model')->getAllPetugas();
        $data['jenis_kelamin_all'] = $this->model('Anggota_model')->getAllJenisKelamin();
        $data['status_all'] = $this->model('Anggota_model')->getAllStatus();
        $data['role_all'] = $this->model('Anggota_model')->getAllRole();
        $this->view('admin/_layouts/header', $data);
        $this->view('admin/petugas', $data);
    }

    public function detail($id) {
        echo json_encode($this->model('Anggota_model')->getPetugasById($id));
    }

    public function tambah() {
        if ( $this->model('Anggota_model')->addPetugas($_POST, $_FILES['gambar']) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Petugas berhasil ditambahkan', 'success');
            header('Location: '.BASE_URL.'admin/petugas/');
            exit;
        }
    }

    public function ubah() {
        if ( $this->model('Anggota_model')->updatePetugas($_POST, $_FILES['gambar']) > 0 ) {
            Flasher::setFlash('Berhasil', 'Data Petugas berhasil Diubah', 'warning');
            header('Location: '.BASE_URL.'admin/petugas');
            exit;
        } else {
            Flasher::setFlash('Berhasil', 'Data Petugas berhasil Diubah', 'warning');
            header('Location: '.BASE_URL.'admin/petugas');
            exit;
        }
    }

    public function ubahPassword() {
        if ( $this->model('Anggota_model')->updatePasswordPetugas($_POST) > 0  ) {
            Flasher::setFlash('Berhasil', 'Password Petugas berhasil Diubah', 'warning');
            header('Location: '.BASE_URL.'admin/petugas/');
            exit;
        } else {
            Flasher::setFlash('Berhasil', 'Password Petugas berhasil Diubah', 'warning');
            header('Location: '.BASE_URL.'admin/petugas/');
            exit;
        }
    }

    public function checkUsername() {
        echo json_encode($this->model('Anggota_model')->getAvailableUsername('petugas',$_POST['username']));
    }


}