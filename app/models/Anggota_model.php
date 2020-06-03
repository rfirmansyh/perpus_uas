<?php 

class Anggota_model {

    private $table = 'anggota';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAll() {
        $this->db->query("SELECT ag.*,ast.nama_status FROM anggota ag JOIN anggota_status ast ON ag.anggota_status_id = ast.id");
        return $this->db->resultSet();
    }
    public function getAllJenisKelamin() {
        $this->db->query("SELECT * FROM jenis_kelamin");
        return $this->db->resultSet();
    }
    public function getAllStatus() {
        $this->db->query("SELECT * FROM anggota_status");
        return $this->db->resultSet();
    }
    public function getAllRole() {
        $this->db->query("SELECT * FROM petugas_role");
        return $this->db->resultSet();
    }

    public function getAllPetugas() {
        $query = "SELECT pg.*, pgr.nama_role, ags.nama_status, jk.nama_jenis
                    FROM petugas pg
                    JOIN petugas_role pgr
                        ON pg.petugas_role_id = pgr.id
                    JOIN anggota_status ags
                        ON pg.anggota_status_id = ags.id
                    JOIN jenis_kelamin jk
                        ON pg.jenis_kelamin_id = jk.id";
        $this->db->query($query);
        return $this->db->resultSet();           
    }

    public function getActiveAnggota() {
        $this->db->query("SELECT ag.id, ag.nama_lengkap
                            FROM anggota ag
                            WHERE ag.anggota_status_id = 1");
        return $this->db->resultSet();
    }

    public function getActivePetugas() {
        $this->db->query("SELECT pg.id, pg.nama_lengkap
                            FROM petugas pg
                            WHERE pg.anggota_status_id = 1");
        return $this->db->resultSet();
    }


    public function getAnggotaById($id) {
        $query = "SELECT ag.id, ag.gambar, ag.nama_lengkap, ag.nisn, ag.tanggal_masuk, ag.tanggal_daftar, ag.no_hp, ag.jenis_kelamin_id, ag.anggota_status_id, ast.nama_status, jk.nama_jenis
                    FROM anggota ag
                    JOIN anggota_status ast
                        ON ag.anggota_status_id = ast.id
                    JOIN jenis_kelamin jk 
                        ON ag.jenis_kelamin_id = jk.id
                    WHERE ag.id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getPetugasById($id) {
        $query = "SELECT p.id, p.nama_lengkap, p.gambar, p.username, p.no_hp, p.tanggal_buat, p.jenis_kelamin_id, p.petugas_role_id, p.anggota_status_id, ast.nama_status, jk.nama_jenis, pg.nama_role
                    FROM petugas p
                    JOIN anggota_status ast
                        ON p.anggota_status_id = ast.id
                    JOIN jenis_kelamin jk 
                        ON p.jenis_kelamin_id = jk.id
                    JOIN petugas_role pg
                        ON p.petugas_role_id = pg.id
                    WHERE p.id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getPetugasByUsername($data) {
        $query = "SELECT * FROM petugas WHERE username = :username";
        $this->db->query($query);
        $this->db->bind('username', $data['username']);
        return $this->db->single();
    }

    public function addAnggota($data, $data_file = null) {

        $check_nisn = $this->db->checkAvailableByNisn('anggota', strtolower($data['nisn']));
        if ( $check_nisn ) {
            Flasher::setFlash('Gagal', 'nisn Sudah Ada', 'danger');
            header('Location: '.BASE_URL.'admin/anggota/');
            return false;
        }

        if ( !is_null($data_file) ) {

            $file = $this->upload($data_file);

            if (!$file) {
                return false;
            };
            
        }

        $query = "INSERT INTO $this->table
                    VALUES
                    ('', :nama_lengkap, '$file', :nisn, :password, :tanggal_masuk, :tanggal_daftar, :no_hp, :jenis_kelamin_id, :anggota_status_id)";

        // v = validate
        $v_nama_lengkap = Form_validation::validate($data['nama_lengkap'], 'Nama Lengkap' ,'required');
        $v_nisn = Form_validation::validate($data['nisn'], 'NISN' ,'required');
        $v_password = Form_validation::validate($data['password'], 'Password' ,'required');
        $v_password2 = Form_validation::validate($data['password2'], 'Konfirmasi Password' ,'required');
        $v_match_password = Form_validation::validatePassword($data['password'], $data['password2']);
        $v_tanggal_masuk = Form_validation::validate($data['tanggal_masuk'], 'Tanggal Masuk' ,'required');
        $v_tanggal_daftar = Form_validation::validate($data['tanggal_daftar'], 'Tangal Daftar' ,'required');
        $v_no_hp = Form_validation::validate($data['no_hp'], 'Nomor hp' ,'required');
        $v_jenis_kelamin_id = Form_validation::validate($data['jenis_kelamin_id'], 'Jenis Kelamin' ,'required');
        $v_anggota_status_id = Form_validation::validate($data['anggota_status_id'], 'Status' ,'required');
        switch(true) {
            case ( strlen($v_nama_lengkap) > 2 ) :
                Flasher::setFlash('Gagal', $v_nama_lengkap, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_nisn) > 2 ) :
                Flasher::setFlash('Gagal', $v_nisn, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_password) > 2 ) :
                Flasher::setFlash('Gagal', $v_password, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_password2) > 2 ) :
                Flasher::setFlash('Gagal', $v_password2, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_match_password) > 2 ) :
                Flasher::setFlash('Gagal', $v_match_password, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_tanggal_masuk) > 2 ) :
                Flasher::setFlash('Gagal', $v_tanggal_masuk, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_tanggal_daftar) > 2 ) :
                Flasher::setFlash('Gagal', $v_tanggal_daftar, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_no_hp) > 2 ) :
                Flasher::setFlash('Gagal', $v_no_hp, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_jenis_kelamin_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_jenis_kelamin_id, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_anggota_status_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_anggota_status_id, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            default:
                break;
        }
        $this->db->query($query);
        $this->db->bind('nama_lengkap', $data['nama_lengkap']);
        $this->db->bind('nisn', $data['nisn']);
        $this->db->bind('password', $data['password']);
        $this->db->bind('tanggal_masuk', $data['tanggal_masuk']);
        $this->db->bind('tanggal_daftar', $data['tanggal_daftar']);
        $this->db->bind('no_hp', $data['no_hp']);
        $this->db->bind('jenis_kelamin_id', $data['jenis_kelamin_id']);
        $this->db->bind('anggota_status_id', $data['anggota_status_id']);
        

        $this->db->execute();

        return $this->db->rowCount();
        
    }

    

    public function addPetugas($data, $data_file = null) {

        $check_username = $this->db->checkAvailableByUsername('petugas', strtolower($data['username']));
        if ( $check_username ) {
            Flasher::setFlash('Gagal', 'Username Sudah Ada', 'danger');
            header('Location: '.BASE_URL.'admin/petugas/');
            return false;
        }

        if ( !is_null($data_file) ) {

            $file = $this->upload($data_file);

            if (!$file) {
                return false;
            };
            
        }

        $query = "INSERT INTO petugas
                    VALUES
                    ('', :nama_lengkap, '$file', :username, :password, :no_hp, :tanggal_buat, :jenis_kelamin_id, :petugas_role_id, :anggota_status_id)";

        // v = validate
        $v_nama_lengkap = Form_validation::validate($data['nama_lengkap'], 'Nama Lengkap' ,'required');
        $v_username = Form_validation::validate($data['username'], 'Username' ,'required');
        $v_password = Form_validation::validate($data['password'], 'Password' ,'required');
        $v_password2 = Form_validation::validate($data['password2'], 'Konfirmasi Password' ,'required');
        $v_match_password = Form_validation::validatePassword($data['password'], $data['password2']);
        $v_no_hp = Form_validation::validate($data['no_hp'], 'Nomor hp' ,'required');
        $v_tanggal_buat = Form_validation::validate($data['tanggal_buat'], 'Tanggal Buat' ,'required');
        $v_jenis_kelamin_id = Form_validation::validate($data['jenis_kelamin_id'], 'Jenis Kelamin' ,'required');
        $v_petugas_role_id = Form_validation::validate($data['petugas_role_id'], 'Jenis Kelamin' ,'required');
        $v_anggota_status_id = Form_validation::validate($data['anggota_status_id'], 'Status' ,'required');

        switch(true) {
            case ( strlen($v_nama_lengkap) > 2 ) :
                Flasher::setFlash('Gagal', $v_nama_lengkap, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_username) > 2 ) :
                Flasher::setFlash('Gagal', $v_username, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_password) > 2 ) :
                Flasher::setFlash('Gagal', $v_password, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_password2) > 2 ) :
                Flasher::setFlash('Gagal', $v_password2, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_match_password) > 2 ) :
                Flasher::setFlash('Gagal', $v_match_password, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_no_hp) > 2 ) :
                Flasher::setFlash('Gagal', $v_no_hp, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_tanggal_buat) > 2 ) :
                Flasher::setFlash('Gagal', $v_tanggal_buat, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_jenis_kelamin_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_jenis_kelamin_id, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_petugas_role_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_petugas_role_id, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_anggota_status_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_anggota_status_id, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            default:
                break;
        }

        $this->db->query($query);
        $this->db->bind('nama_lengkap', $data['nama_lengkap']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind('no_hp', $data['no_hp']);
        $this->db->bind('tanggal_buat', $data['tanggal_buat']);
        $this->db->bind('jenis_kelamin_id', $data['jenis_kelamin_id']);
        $this->db->bind('petugas_role_id', $data['petugas_role_id']);
        $this->db->bind('anggota_status_id', $data['anggota_status_id']);
        

        $this->db->execute();

        return $this->db->rowCount();

    }


    public function updateAnggota($data, $data_file = null) {

        $file_old = htmlspecialchars($data['gambar_anggota_lama']);

        if ( !is_null($data_file) ) {

            if ( $data_file['error'] === 4 ) {
                $file = $file_old;
            } else {
                $file = $this->upload($data_file);
                if (!$file) {
                    return false;
                }
            }
            
        }

        $query = "UPDATE anggota SET
                    nama_lengkap = :nama_lengkap,
                    gambar = :gambar,
                    nisn = :nisn,
                    tanggal_masuk = :tanggal_masuk,
                    tanggal_daftar = :tanggal_daftar,
                    no_hp = :no_hp,
                    jenis_kelamin_id = :jenis_kelamin_id,
                    anggota_status_id = :anggota_status_id
                WHERE id = :id";

        // v = validate
        $v_nama_lengkap = Form_validation::validate($data['nama_lengkap'], 'Nama Lengkap' ,'required');
        $v_nisn = Form_validation::validate($data['nisn'], 'NISN' ,'required');
        $v_tanggal_masuk = Form_validation::validate($data['tanggal_masuk'], 'Tanggal Masuk' ,'required');
        $v_tanggal_daftar = Form_validation::validate($data['tanggal_daftar'], 'Tangal Daftar' ,'required');
        $v_no_hp = Form_validation::validate($data['no_hp'], 'Nomor hp' ,'required');
        $v_jenis_kelamin_id = Form_validation::validate($data['jenis_kelamin_id'], 'Jenis Kelamin' ,'required');
        $v_anggota_status_id = Form_validation::validate($data['anggota_status_id'], 'Status' ,'required');
        switch(true) {
            case ( strlen($v_nama_lengkap) > 2 ) :
                Flasher::setFlash('Gagal', $v_nama_lengkap, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_nisn) > 2 ) :
                Flasher::setFlash('Gagal', $v_nisn, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_tanggal_masuk) > 2 ) :
                Flasher::setFlash('Gagal', $v_tanggal_masuk, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_tanggal_daftar) > 2 ) :
                Flasher::setFlash('Gagal', $v_tanggal_daftar, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_no_hp) > 2 ) :
                Flasher::setFlash('Gagal', $v_no_hp, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_jenis_kelamin_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_jenis_kelamin_id, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_anggota_status_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_anggota_status_id, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            default:
                break;
        }
        $this->db->query($query);
        $this->db->bind('nama_lengkap', $data['nama_lengkap']);
        $this->db->bind('gambar', $file);
        $this->db->bind('nisn', $data['nisn']);
        $this->db->bind('tanggal_masuk', $data['tanggal_masuk']);
        $this->db->bind('tanggal_daftar', $data['tanggal_daftar']);
        $this->db->bind('no_hp', $data['no_hp']);
        $this->db->bind('jenis_kelamin_id', $data['jenis_kelamin_id']);
        $this->db->bind('anggota_status_id', $data['anggota_status_id']);
        $this->db->bind('id', $data['id_anggota']);
        

        $this->db->execute();

        return $this->db->rowCount();
        
    }

    public function updatePetugas($data, $data_file = null) {
        $file_old = htmlspecialchars($data['gambar_petugas_lama']);

        if ( !is_null($data_file) ) {

            if ( $data_file['error'] === 4 ) {
                $file = $file_old;
            } else {
                $file = $this->uploadPetugas($data_file);
                if (!$file) {
                    return false;
                }
            }
            
        }

        $query = "UPDATE petugas SET
                    nama_lengkap = :nama_lengkap,
                    gambar = :gambar,
                    username = :username,
                    no_hp = :no_hp,
                    tanggal_buat = :tanggal_buat,
                    jenis_kelamin_id = :jenis_kelamin_id,
                    petugas_role_id = :petugas_role_id,
                    anggota_status_id = :anggota_status_id
                WHERE petugas.id = :id";

        // v = validate
        $v_nama_lengkap = Form_validation::validate($data['nama_lengkap'], 'Nama Lengkap' ,'required');
        $v_username = Form_validation::validate($data['username'], 'Username' ,'required');
        $v_no_hp = Form_validation::validate($data['no_hp'], 'Nomor hp' ,'required');
        $v_tanggal_buat = Form_validation::validate($data['tanggal_buat'], 'Tanggal Buat' ,'required');
        $v_jenis_kelamin_id = Form_validation::validate($data['jenis_kelamin_id'], 'Jenis Kelamin' ,'required');
        $v_petugas_role_id = Form_validation::validate($data['petugas_role_id'], 'Jenis Kelamin' ,'required');
        $v_anggota_status_id = Form_validation::validate($data['anggota_status_id'], 'Status' ,'required');

        switch(true) {
            case ( strlen($v_nama_lengkap) > 2 ) :
                Flasher::setFlash('Gagal', $v_nama_lengkap, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_username) > 2 ) :
                Flasher::setFlash('Gagal', $v_username, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_no_hp) > 2 ) :
                Flasher::setFlash('Gagal', $v_no_hp, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_tanggal_buat) > 2 ) :
                Flasher::setFlash('Gagal', $v_tanggal_buat, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_jenis_kelamin_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_jenis_kelamin_id, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_petugas_role_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_petugas_role_id, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_anggota_status_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_anggota_status_id, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            default:
                break;
        }

        $this->db->query($query);
        $this->db->bind('nama_lengkap', $data['nama_lengkap']);
        $this->db->bind('gambar', $file);
        $this->db->bind('username', $data['username']);
        $this->db->bind('no_hp', $data['no_hp']);
        $this->db->bind('tanggal_buat', $data['tanggal_buat']);
        $this->db->bind('jenis_kelamin_id', $data['jenis_kelamin_id']);
        $this->db->bind('petugas_role_id', $data['petugas_role_id']);
        $this->db->bind('anggota_status_id', $data['anggota_status_id']);
        $this->db->bind('id', $data['id_petugas']);
        

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function updatePassword($data) {
        $query = "UPDATE anggota SET
                    anggota.password = :new_password
                WHERE id = :id";
        
        $v_password = Form_validation::validate($data['new-password'], 'Password Baru' ,'required');
        $v_password2 = Form_validation::validate($data['new-password2'], 'Konfirmasi Password Baru' ,'required');
        $v_match_password = Form_validation::validatePassword($data['new-password'], $data['new-password2']);
        switch(true) {
            case ( strlen($v_password) > 2 ) :
                Flasher::setFlash('Gagal', $v_password, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_password2) > 2 ) :
                Flasher::setFlash('Gagal', $v_password2, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            case ( strlen($v_match_password) > 2 ) :
                Flasher::setFlash('Gagal', $v_match_password, 'danger');
                header('Location: '.BASE_URL.'admin/anggota/');
                return false;
            default:
                break;
        }
        $this->db->query($query);
        $this->db->bind('new_password', password_hash($data['new-password'], PASSWORD_DEFAULT));
        $this->db->bind('id', $data['p_anggota_id']);
        

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function updatePasswordPetugas($data) {
        $query = "UPDATE petugas SET
                    petugas.password = :new_password
                WHERE id = :id";
        
        $v_password = Form_validation::validate($data['new-password'], 'Password Baru' ,'required');
        $v_password2 = Form_validation::validate($data['new-password2'], 'Konfirmasi Password Baru' ,'required');
        $v_match_password = Form_validation::validatePassword($data['new-password'], $data['new-password2']);
        switch(true) {
            case ( strlen($v_password) > 2 ) :
                Flasher::setFlash('Gagal', $v_password, 'danger');
                header('Location: '.BASE_URL.'admin/petugas/');
                return false;
            case ( strlen($v_password2) > 2 ) :
                Flasher::setFlash('Gagal', $v_password2, 'danger');
                header('Location: '.BASE_URL.'admin/petugas/');
                return false;
            case ( strlen($v_match_password) > 2 ) :
                Flasher::setFlash('Gagal', $v_match_password, 'danger');
                header('Location: '.BASE_URL.'admin/petugas/');
                return false;
            default:
                break;
        }
        $this->db->query($query);
        $this->db->bind('new_password', password_hash($data['new-password'], PASSWORD_DEFAULT));
        $this->db->bind('id', $data['p_anggota_id']);
        

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function updatePasswordProfil($data) {
        $query = "UPDATE petugas SET
                    petugas.password = :new_password
                WHERE id = :id";
        
        $v_password = Form_validation::validate($data['new-password'], 'Password Baru' ,'required');
        $v_password2 = Form_validation::validate($data['new-password2'], 'Konfirmasi Password Baru' ,'required');
        $v_match_password = Form_validation::validatePassword($data['new-password'], $data['new-password2']);
        switch(true) {
            case ( strlen($v_password) > 2 ) :
                Flasher::setFlash('Gagal', $v_password, 'danger');
                header('Location: '.BASE_URL.'admin/profil/');
                return false;
            case ( strlen($v_password2) > 2 ) :
                Flasher::setFlash('Gagal', $v_password2, 'danger');
                header('Location: '.BASE_URL.'admin/profil/');
                return false;
            case ( strlen($v_match_password) > 2 ) :
                Flasher::setFlash('Gagal', $v_match_password, 'danger');
                header('Location: '.BASE_URL.'admin/profil/');
                return false;
            default:
                break;
        }
        $this->db->query($query);
        $this->db->bind('new_password',  password_hash($data['new-password'], PASSWORD_DEFAULT));
        $this->db->bind('id', $data['id']);
        

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateProfil($data) {
        $query = "UPDATE petugas SET
                    nama_lengkap = :nama_lengkap,
                    username = :username,
                    no_hp = :no_hp
                WHERE petugas.id = :id";

        $v_nama_lengkap = Form_validation::validate($data['nama_lengkap'], 'Nama Lengkap' ,'required');
        $v_username = Form_validation::validate($data['username'], 'Username' ,'required');
        $v_no_hp = Form_validation::validate($data['no_hp'], 'Nomor hp' ,'required');

        switch(true) {
            case ( strlen($v_nama_lengkap) > 2 ) :
                Flasher::setFlash('Gagal', $v_nama_lengkap, 'danger');
                header('Location: '.BASE_URL.'admin/profil/');
                return false;
            case ( strlen($v_username) > 2 ) :
                Flasher::setFlash('Gagal', $v_username, 'danger');
                header('Location: '.BASE_URL.'admin/profil/');
                return false;
            case ( strlen($v_no_hp) > 2 ) :
                Flasher::setFlash('Gagal', $v_no_hp, 'danger');
                header('Location: '.BASE_URL.'admin/profil/');
                return false;
            default:
                break;
        }
        $this->db->query($query);
        $this->db->bind('nama_lengkap', $data['nama_lengkap']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('no_hp', $data['no_hp']);

        $this->db->bind('id', $data['id']);
        

        $this->db->execute();

        return $this->db->rowCount();

    }
    public function updateImage($data, $data_file = null) {
        $file_old = htmlspecialchars($data['gambar_lama']);

        if ( !is_null($data_file) ) {

            if ( $data_file['error'] === 4 ) {
                $file = $file_old;
            } else {
                $file = $this->uploadPetugas($data_file);
                if (!$file) {
                    return false;
                }
            }
            
        }

        $query = "UPDATE petugas SET
                    gambar = :gambar
                WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('gambar', $file);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function deleteAnggota($id) {
        $query = "DELETE FROM anggota WHERE anggota.id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function upload($file) {
        
        $file_name = $file['name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        $file_tmp = $file['tmp_name'];

        // cek apakah tidak ada gambar yang diupload
        if ( $file_error === 4 ) {
            Flasher::setFlash('Gagal', 'Data Anggota gagal ditambahkan, Harap Pilih File', 'danger');
            header('Location: '.BASE_URL.'admin/anggota/');
            return false;
        }

        $file_valid_ext = ['jpg', 'jpeg', 'png'];
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        if ( !in_array($file_ext, $file_valid_ext) ) {
            Flasher::setFlash('Gagal', 'Data Anggota gagal ditambahkan, Extensi File Tidak valid, pastikan ekstensi <strong> jpg, jpeg atau png</strong>', 'danger');
            header('Location: '.BASE_URL.'admin/anggota/');
            return false;
        }

        if ( $file_size > 1000000 ) {
            Flasher::setFlash('Gagal', 'Data Anggota gagal ditambahkan, Ukuran File Terlalu Besar <strong> Max 1 MB </strong>', 'danger');
            header('Location: '.BASE_URL.'admin/anggota/');
            return false;
        }

        $file_new_name = uniqid();
        $file_new_name .= '.';
        $file_new_name .= $file_ext;

        move_uploaded_file($file_tmp, '../public/uploads/'.$file_new_name); 

        return $file_new_name;
    }
    public function uploadPetugas($file) {
        
        $file_name = $file['name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        $file_tmp = $file['tmp_name'];

        // cek apakah tidak ada gambar yang diupload
        if ( $file_error === 4 ) {
            Flasher::setFlash('Gagal', 'Data Petugas gagal ditambahkan, Harap Pilih File', 'danger');
            header('Location: '.BASE_URL.'admin/petugas/');
            return false;
        }

        $file_valid_ext = ['jpg', 'jpeg', 'png'];
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        if ( !in_array($file_ext, $file_valid_ext) ) {
            Flasher::setFlash('Gagal', 'Data Petugas gagal ditambahkan, Extensi File Tidak valid, pastikan ekstensi <strong> jpg, jpeg atau png</strong>', 'danger');
            header('Location: '.BASE_URL.'admin/petugas/');
            return false;
        }

        if ( $file_size > 1000000 ) {
            Flasher::setFlash('Gagal', 'Data Petugas gagal ditambahkan, Ukuran File Terlalu Besar <strong> Max 1 MB </strong>', 'danger');
            header('Location: '.BASE_URL.'admin/petugas/');
            return false;
        }

        $file_new_name = uniqid();
        $file_new_name .= '.';
        $file_new_name .= $file_ext;

        move_uploaded_file($file_tmp, '../public/uploads/'.$file_new_name); 

        return $file_new_name;
    }


    public function getAvailableUsername($table, $username) {
        $check_username = $this->db->checkAvailableByUsername($table, strtolower($username));
        return $check_username;
    }
    public function getAvailableByNisn($table, $nisn) {
        $check_nisn = $this->db->checkAvailableByNisn($table, strtolower($nisn));
        return $check_nisn;
    }
}