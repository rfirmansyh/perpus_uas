<?php 
if ( isset($_SESSION['petugas']) ) {
    header('Location: '.BASE_URL.'admin/dashboard');
    exit;
} 

class Login extends Controller {
    public function index() {
        $data['title'] = 'Login';
        $this->view('admin/login', $data);
    }

    public function do() {
        $result = $this->model('Anggota_model')->getPetugasByUsername($_POST);
        if ( password_verify($_POST['password'], $result['password']) && $result['anggota_status_id'] === '1' ) {
            $_SESSION['petugas'] = [
                'petugas_id' => $result['id'],
                'username' => $result['username'],
                'nama_lengkap' => $result['nama_lengkap'],
                'gambar' => $result['gambar'],
                'petugas_role_id' => $result['petugas_role_id']
            ];
            header('Location: '.BASE_URL.'admin/dashboard');
            exit;
        } else {
            $_SESSION['username'] = $_POST['username'];
            Flasher::setFlash('Gagal,', 'Username dan Password tidak Sesuai / Akun anda tidak Aktif, Silahkan Meminta Konfirmasi Admin untuk hal ini', 'danger');
            header('Location: '.BASE_URL.'admin/');
            exit;
        }
    }
}