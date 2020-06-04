<?php 

class Buku_model {

    private $table = 'buku';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getPreviewAll() {
        $this->db->query("SELECT b.id, b.kode_buku, b.judul_buku, b.stok, r.nama_rak, k.nama_kategori
                            FROM buku b
                            JOIN rak r 
                                ON b.rak_id = r.id
                            JOIN kategori_buku k
                                ON b.kategori_buku_id = k.id");
        return $this->db->resultSet();
    }
    public function getAvailableBook() {
        $query = "SELECT b.id, b.judul_buku, b.stok
                    FROM buku b
                    WHERE b.stok > 0";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getById($id) {
        $this->db->query("SELECT b.id, b.gambar, b.kode_buku, b.judul_buku, b.overview_buku, b.penulis_buku, b.penerbit_buku, b.tanggal_terbit, b.stok, b.tanggal_input, r.id as rak_id, r.nama_rak,k.id as kategori_id, k.nama_kategori
                            FROM buku b
                            JOIN rak r 
                                ON b.rak_id = r.id
                            JOIN kategori_buku k
                                ON b.kategori_buku_id = k.id
                            WHERE b.id = :id
                            LIMIT 1");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getAllCategories() {
        $this->db->query("SELECT * FROM kategori_buku");
        return $this->db->resultSet();
    }
    public function getCategoryById($id) {
        $this->db->query("SELECT * FROM kategori_buku WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function getAllRak() {
        $this->db->query("SELECT r.id, r.nama_rak, r.lokasi_rak_id, l.id as lokasi_id, l.nama_lokasi, l.detail_lokasi FROM rak r JOIN lokasi_rak l ON r.lokasi_rak_id = l.id");
        return $this->db->resultSet();
    }
    public function getRakById($id) {
        $this->db->query("SELECT r.id, r.nama_rak, r.lokasi_rak_id, l.id as lokasi_id, l.nama_lokasi, l.detail_lokasi 
                            FROM rak r 
                            JOIN lokasi_rak l 
                                ON r.lokasi_rak_id = l.id
                            WHERE r.id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function getAllLocation() {
        $this->db->query("SELECT * FROM lokasi_rak");
        return $this->db->resultSet();
    }
    public function getLocationById($id) {
        $this->db->query("SELECT * FROM lokasi_rak WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function add($data, $data_file = 'null') {

        if ( !is_null($data_file) ) {

            $file = $this->upload($data_file);

            if (!$file) {
                return false;
            };
            
        }

        $query = "INSERT INTO $this->table
                    VALUES
                    ('', :judul_buku, '$file', :kode_buku, :overview_buku, :penulis_buku, :penerbit_buku, :tanggal_terbit, :stok, :rak_id, :kategori_buku_id, :tanggal_input)";

        // v = validate
        $v_kode_buku = Form_validation::validate($data['kode_buku'], 'Kode Buku' ,'required|min_length_6');
        $v_judul_buku = Form_validation::validate($data['judul_buku'], 'Judul Buku' ,'required|min_length_6');
        $v_overview_buku = Form_validation::validate($data['overview_buku'], 'Overview Buku' ,'required|min_length_6');
        $v_penulis_buku = Form_validation::validate($data['penulis_buku'], 'Penulis Buku' ,'required');
        $v_penerbit_buku = Form_validation::validate($data['penerbit_buku'], 'Penerbt Buku' ,'required');
        $v_tanggal_terbit = Form_validation::validate($data['tanggal_terbit'], 'Tanggal Terbit' ,'required');
        $v_stok = Form_validation::validate($data['stok'], 'Stok Buku' ,'required|min_0');
        $v_rak_id = Form_validation::validate($data['rak_id'], 'Rak Buku' ,'required');
        $v_kategori_buku_id = Form_validation::validate($data['kategori_buku_id'], 'Kategoir Buku' ,'required');
        $v_tanggal_input = Form_validation::validate($data['tanggal_input'], 'Tanggal Input' ,'required');
        switch(true) {
            case ( strlen($v_kode_buku) > 2 ) :
                Flasher::setFlash('Gagal', $v_kode_buku, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_judul_buku) > 2 ) :
                Flasher::setFlash('Gagal', $v_judul_buku, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_overview_buku) > 2 ) :
                Flasher::setFlash('Gagal', $v_overview_buku, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_penulis_buku) > 2 ) :
                Flasher::setFlash('Gagal', $v_penulis_buku, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_penerbit_buku) > 2 ) :
                Flasher::setFlash('Gagal', $v_penerbit_buku, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_tanggal_terbit) > 2 ) :
                Flasher::setFlash('Gagal', $v_tanggal_terbit, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_stok) > 2 ) :
                Flasher::setFlash('Gagal', $v_stok, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_rak_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_rak_id, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_kategori_buku_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_kategori_buku_id, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_tanggal_input) > 2 ) :
                Flasher::setFlash('Gagal', $v_tanggal_input, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            default:
                break;
        }
        $this->db->query($query);
        $this->db->bind('kode_buku', $data['kode_buku']);
        $this->db->bind('judul_buku', $data['judul_buku']);
        $this->db->bind('overview_buku', $data['overview_buku']);
        $this->db->bind('penulis_buku', $data['penulis_buku']);
        $this->db->bind('penerbit_buku', $data['penerbit_buku']);
        $this->db->bind('tanggal_terbit', $data['tanggal_terbit']);
        $this->db->bind('stok', $data['stok']);
        $this->db->bind('rak_id', $data['rak_id']);
        $this->db->bind('kategori_buku_id', $data['kategori_buku_id']);
        $this->db->bind('tanggal_input', $data['tanggal_input']);
        

        $this->db->execute();

        return $this->db->rowCount();
        
    }

    public function addCategory($data) {
        $query = "INSERT INTO kategori_buku
                    VALUES
                    ('', :nama_kategori)";
        $v_nama_kategori = Form_validation::validate($data['nama_kategori'], 'Nama Kategori' ,'required');
        if ( strlen($v_nama_kategori) > 2 ) {
            Flasher::setFlash('Gagal', $v_nama_kategori, 'danger');
            header('Location: '.BASE_URL.'admin/kategori/');
            return false;
        }

        $this->db->query($query);
        $this->db->bind('nama_kategori', $data['nama_kategori']);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function addRak($data) {
        $query = "INSERT INTO rak
                    VALUES
                    ('', :nama_rak, :lokasi_rak_id)";
        $v_nama_rak = Form_validation::validate($data['nama_rak'], 'Nama Rak' ,'required');    
        $v_lokasi_rak_id = Form_validation::validate($data['lokasi_rak_id'], 'Lokasi Rak' ,'required');    
        switch(true) {
            case ( strlen($v_nama_rak) > 2 ) :
                Flasher::setFlash('Gagal', $v_nama_rak, 'danger');
                header('Location: '.BASE_URL.'admin/rak/');
                return false;
            case ( strlen($v_lokasi_rak_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_lokasi_rak_id, 'danger');
                header('Location: '.BASE_URL.'admin/rak/');
                return false;
            default:
                break;
        }
        $this->db->query($query);
        $this->db->bind('nama_rak', $data['nama_rak']);
        $this->db->bind('lokasi_rak_id', $data['lokasi_rak_id']);
        $this->db->execute();

        return $this->db->rowCount();
    }
    public function addLocation($data) {
        $query = "INSERT INTO lokasi_rak
                    VALUES
                    ('', :nama_lokasi, :detail_lokasi)";
        $v_nama_lokasi = Form_validation::validate($data['nama_lokasi'], 'Nama Lokasi' ,'required');    
        $v_detail_lokasi = Form_validation::validate($data['detail_lokasi'], 'Detail Lokasi Rak' ,'required');    
        switch(true) {
            case ( strlen($v_nama_lokasi) > 2 ) :
                Flasher::setFlash('Gagal', $v_nama_lokasi, 'danger');
                header('Location: '.BASE_URL.'admin/lokasi/');
                return false;
            case ( strlen($v_detail_lokasi) > 2 ) :
                Flasher::setFlash('Gagal', $v_detail_lokasi, 'danger');
                header('Location: '.BASE_URL.'admin/lokasi/');
                return false;
            default:
                break;
        }
        $this->db->query($query);
        $this->db->bind('nama_lokasi', $data['nama_lokasi']);
        $this->db->bind('detail_lokasi', $data['detail_lokasi']);
        $this->db->execute();

        return $this->db->rowCount();            
    }


    public function update($data, $data_file = 'null') {

        $file_old = htmlspecialchars($data['gambar_buku_lama']);

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

        $query = "UPDATE $this->table SET
                    gambar = :gambar,
                    kode_buku = :kode_buku,
                    judul_buku = :judul_buku,
                    overview_buku = :overview_buku,
                    penulis_buku = :penulis_buku,
                    penerbit_buku = :penerbit_buku,
                    tanggal_terbit = :tanggal_terbit,
                    stok = :stok,
                    rak_id = :rak_id,
                    kategori_buku_id = :kategori_buku_id,
                    tanggal_input = :tanggal_input
                WHERE id = :id";

        // v = validate
        $v_kode_buku = Form_validation::validate($data['kode_buku'], 'Kode Buku' ,'required|min_length_6');
        $v_judul_buku = Form_validation::validate($data['judul_buku'], 'Judul Buku' ,'required|min_length_6');
        $v_overview_buku = Form_validation::validate($data['overview_buku'], 'Overview Buku' ,'required|min_length_6');
        $v_penulis_buku = Form_validation::validate($data['penulis_buku'], 'Penulis Buku' ,'required');
        $v_penerbit_buku = Form_validation::validate($data['penerbit_buku'], 'Penerbt Buku' ,'required');
        $v_tanggal_terbit = Form_validation::validate($data['tanggal_terbit'], 'Tanggal Terbit' ,'required');
        $v_stok = Form_validation::validate($data['stok'], 'Stok Buku' ,'required|min_0');
        $v_rak_id = Form_validation::validate($data['rak_id'], 'Rak Buku' ,'required');
        $v_kategori_buku_id = Form_validation::validate($data['kategori_buku_id'], 'Kategoir Buku' ,'required');
        $v_tanggal_input = Form_validation::validate($data['tanggal_input'], 'Tanggal Input' ,'required');
        switch(true) {
            case ( strlen($v_kode_buku) > 2 ) :
                Flasher::setFlash('Gagal', $v_kode_buku, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_judul_buku) > 2 ) :
                Flasher::setFlash('Gagal', $v_judul_buku, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_overview_buku) > 2 ) :
                Flasher::setFlash('Gagal', $v_overview_buku, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_penulis_buku) > 2 ) :
                Flasher::setFlash('Gagal', $v_penulis_buku, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_penerbit_buku) > 2 ) :
                Flasher::setFlash('Gagal', $v_penerbit_buku, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_tanggal_terbit) > 2 ) :
                Flasher::setFlash('Gagal', $v_tanggal_terbit, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_stok) > 2 ) :
                Flasher::setFlash('Gagal', $v_stok, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_rak_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_rak_id, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_kategori_buku_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_kategori_buku_id, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            case ( strlen($v_tanggal_input) > 2 ) :
                Flasher::setFlash('Gagal', $v_tanggal_input, 'danger');
                header('Location: '.BASE_URL.'admin/buku/');
                return false;
            default:
                break;
        }
        $this->db->query($query);
        $this->db->bind('gambar', $file);
        $this->db->bind('kode_buku', $data['kode_buku']);
        $this->db->bind('judul_buku', $data['judul_buku']);
        $this->db->bind('overview_buku', $data['overview_buku']);
        $this->db->bind('penulis_buku', $data['penulis_buku']);
        $this->db->bind('penerbit_buku', $data['penerbit_buku']);
        $this->db->bind('tanggal_terbit', $data['tanggal_terbit']);
        $this->db->bind('stok', $data['stok']);
        $this->db->bind('rak_id', $data['rak_id']);
        $this->db->bind('kategori_buku_id', $data['kategori_buku_id']);
        $this->db->bind('tanggal_input', $data['tanggal_input']);
        $this->db->bind('id', $data['id_buku']);
        

        $this->db->execute();

        return $this->db->rowCount();
        
    }
    public function updateCategory($data) {
        $query = "UPDATE kategori_buku SET
                    nama_kategori = :nama_kategori
                WHERE id = :id";
        $v_nama_kategori = Form_validation::validate($data['nama_kategori'], 'Nama Kategori' ,'required');
        if ( strlen($v_nama_kategori) > 2 ) {
            Flasher::setFlash('Gagal', $v_nama_kategori, 'danger');
            header('Location: '.BASE_URL.'admin/kategori/');
            return false;
        }
        $this->db->query($query);
        $this->db->bind('nama_kategori', $data['nama_kategori']);
        $this->db->bind('id', $data['kategori_id']);
        
        $this->db->execute();

        return $this->db->rowCount();
    }
    public function updateRak($data) {
        $query = "UPDATE rak SET
                    nama_rak = :nama_rak,
                    lokasi_rak_id = :lokasi_rak_id
                WHERE id = :id";
        $v_nama_rak = Form_validation::validate($data['nama_rak'], 'Nama Rak' ,'required');    
        $v_lokasi_rak_id = Form_validation::validate($data['lokasi_rak_id'], 'Lokasi Rak' ,'required');    
        switch(true) {
            case ( strlen($v_nama_rak) > 2 ) :
                Flasher::setFlash('Gagal', $v_nama_rak, 'danger');
                header('Location: '.BASE_URL.'admin/rak/');
                return false;
            case ( strlen($v_lokasi_rak_id) > 2 ) :
                Flasher::setFlash('Gagal', $v_lokasi_rak_id, 'danger');
                header('Location: '.BASE_URL.'admin/rak/');
                return false;
            default:
                break;
        }
        $this->db->query($query);
        $this->db->bind('nama_rak', $data['nama_rak']);
        $this->db->bind('lokasi_rak_id', $data['lokasi_rak_id']);
        $this->db->bind('id', $data['rak_id']);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function updateLocation($data) {
        $query = "UPDATE lokasi_rak SET
                    nama_lokasi = :nama_lokasi,
                    detail_lokasi = :detail_lokasi
                WHERE id = :id";
        $v_nama_lokasi = Form_validation::validate($data['nama_lokasi'], 'Nama Lokasi' ,'required');    
        $v_detail_lokasi = Form_validation::validate($data['detail_lokasi'], 'Detail Lokasi Rak' ,'required');    
        switch(true) {
            case ( strlen($v_nama_lokasi) > 2 ) :
                Flasher::setFlash('Gagal', $v_nama_lokasi, 'danger');
                header('Location: '.BASE_URL.'admin/lokasi/');
                return false;
            case ( strlen($v_detail_lokasi) > 2 ) :
                Flasher::setFlash('Gagal', $v_detail_lokasi, 'danger');
                header('Location: '.BASE_URL.'admin/lokasi/');
                return false;
            default:
                break;
        }
        $this->db->query($query);
        $this->db->bind('nama_lokasi', $data['nama_lokasi']);
        $this->db->bind('detail_lokasi', $data['detail_lokasi']);
        $this->db->bind('id', $data['lokasi_id']);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function delete($id) {
        $query = "DELETE FROM buku WHERE buku.id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function deleteCategoryById($id) {
        $query = "DELETE FROM kategori_buku WHERE kategori_buku.id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function deleteRakById($id) {
        $query = "DELETE FROM rak WHERE rak.id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function deleteLocationById($id) {
        $query = "DELETE FROM lokasi_rak WHERE lokasi_rak.id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function validation_result($value) {
        if ( strlen($value) > 2 ) {
            Flasher::setFlash('Gagal', $value, 'danger');
            header('Location: '.BASE_URL.'admin/buku/');
            return false;
        } 
    }


    public function upload($file) {
        
        $file_name = $file['name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        $file_tmp = $file['tmp_name'];

        // cek apakah tidak ada gambar yang diupload
        if ( $file_error === 4 ) {
            Flasher::setFlash('Gagal', 'Data Buku gagal ditambahkan, Harap Pilih File', 'danger');
            header('Location: '.BASE_URL.'admin/buku/');
            return false;
        }

        $file_valid_ext = ['jpg', 'jpeg', 'png'];
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        if ( !in_array($file_ext, $file_valid_ext) ) {
            Flasher::setFlash('Gagal', 'Data Buku gagal ditambahkan, Extensi File Tidak valid, pastikan ekstensi <strong> jpg, jpeg atau png</strong>', 'danger');
            header('Location: '.BASE_URL.'admin/buku/');
            return false;
        }

        if ( $file_size > 1000000 ) {
            Flasher::setFlash('Gagal', 'Data Buku gagal ditambahkan, Ukuran File Terlalu Besar <strong> Max 1 MB </strong>', 'danger');
            header('Location: '.BASE_URL.'admin/buku/');
            return false;
        }

        $file_new_name = uniqid();
        $file_new_name .= '.';
        $file_new_name .= $file_ext;

        move_uploaded_file($file_tmp, '../public/uploads/'.$file_new_name); 

        return $file_new_name;
    }

}