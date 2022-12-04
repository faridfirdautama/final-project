<?php

class Admin extends Controller
{
    private $bukuModel;
    private $barangModel;
    private $penerbitModel;
    private $kategoriModel;
    private $peminjamanModel;
    private $userModel;
    private $payload;

    function __construct()
    {
        if (SessionManager::checkSession()) {
            $this->payload = SessionManager::getCurrentSession();
            if ($this->payload->role != 1) {
                header('Location: ' . BASEURL . '/login');
            }
        } else {
            header('Location: ' . BASEURL . '/login');
        }

        $this->bukuModel = $this->model('Buku_model');
        $this->barangModel = $this->model('Barang_model');
        $this->penerbitModel = $this->model('Penerbit_model');
        $this->kategoriModel = $this->model('Kategori_model');
        $this->peminjamanModel = $this->model('Peminjaman_model');
        $this->userModel = $this->model('User_model');
    }

    public function index()
    {
        $data['title'] = 'Home';
        $data['nama'] = $this->payload->nama;
        $data['jml_buku'] = $this->bukuModel->countBuku();
        $data['jml_member'] = $this->userModel->countMember();
        $data['belum_kembali'] = $this->peminjamanModel->countBelumKembali();

        $this->view('admin/header', $data);
        $this->view('admin/index', $data);
        $this->view('admin/footer');
    }

    public function daftar_barang()
    {
        $data['title'] = 'Barang';
        $data['nama'] = $this->payload->nama;
        $data['data_barang'] = $this->barangModel->getAllBarang();

        $this->view('admin/header', $data);
        $this->view('admin/daftar-barang', $data);
        $this->view('admin/footer');
    }

    public function tambah_barang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('Location: ' . BASEURL . '/admin/daftar-barang');
        }

        $this->barangModel->tambahBarang($_POST);
        Flasher::setFlash('Barang berhasil ditambahkan', 'success');
        header('Location: ' . BASEURL . '/admin/daftar-barang');
    }

    public function detail_barang($id = 0)
    {
        if ($id) {
            $data['title'] = 'Barang';
            $data['nama'] = $this->payload->nama;
            $data['data_barang'] = $this->barangModel->getDetailBarang($id);
            $this->view('admin/header', $data);
            $this->view('admin/detail-barang', $data);
            $this->view('admin/footer');
        } else {
            echo 'Harap menggunakan tombol yang ada untuk melihat detail barang';
        }
    }

    public function ubah_barang($id = 0)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->barangModel->ubahBarang($id, $_POST);
            Flasher::setFlash('Barang berhasil diubah', 'success');
            header('Location: ' . BASEURL . '/admin/daftar-barang');
        }

        if ($id) {
            $data['title'] = 'Barang';
            $data['nama'] = $this->payload->nama;
            $data['data_barang'] = $this->barangModel->getDetailBarang($id);

            $this->view('admin/header', $data);
            $this->view('admin/ubah-barang', $data);
            $this->view('admin/footer');
        } else {
            header('Location: ' . BASEURL . '/admin/daftar-barang');
        }
    }

    public function hapus_barang($id = 0)
    {
        if ($id) {
            $hapus = $this->barangModel->hapusBarang($id);
            if ($hapus == 0) {
                Flasher::setFlash('Barang tidak ditemukan', 'danger');
                header('Location: ' . BASEURL . '/admin/daftar-barang');
            } else {
                Flasher::setFlash('Barang berhasil dihapus', 'success');
                header('Location: ' . BASEURL . '/admin/daftar-barang');
            }
        } else {
            header('Location: ' . BASEURL . '/admin/daftar-barang');
        }
    }

    public function tambah_user() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('Location: ' . BASEURL . '/admin/daftar-user');
        }

        $nama = htmlspecialchars($_POST['nama']);
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password1 = $_POST['password1'];
        if ($password == $password1) {
            $row = $this->userModel->getUserByUsername($username);
            if ($row) {
                // User ada 
                Flasher::setFlash('Maaf, username sudah digunakan.', 'danger');
                header('Location: ' . BASEURL . '/admin/daftar-user');
            } else {
                $insert = $this->userModel->insert($nama, $username, $password);
                if ($insert) {
                    Flasher::setFlash('Register berhasil, silahkan login.', 'success');
                    header('Location: ' . BASEURL . '/admin/daftar-user');
                } else {
                    Flasher::setFlash('Gagal register.', 'danger');
                    header('Location: ' . BASEURL . '/admin/daftar-user');
                }
            }
        } else {
            Flasher::setFlash('Password dan konfirmasi password salah.', 'danger');
            header('Location: ' . BASEURL . '/admin/daftar-user');
        }
    }

    public function ubah_user($id = 0)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->userModel->ubahUser($id, $_POST);
            Flasher::setFlash('User berhasil diubah', 'success');
            header('Location: ' . BASEURL . '/admin/daftar-user');
        }

        if ($id) {
            $data['title'] = 'Register';
            $data['nama'] = $this->payload->nama;
            $data['users'] = $this->userModel->getDetailUser($id);

            $this->view('admin/header', $data);
            $this->view('admin/ubah-user', $data);
            $this->view('admin/footer');
        } else {
            header('Location: ' . BASEURL . '/admin/daftar-user');
        }
    }

    public function daftar_user()
    {
        $data['title'] = 'User';
        $data['nama'] = $this->payload->nama;
        $data['users'] = $this->userModel->getAllUser();

        $this->view('admin/header', $data);
        $this->view('admin/daftar-user', $data);
        $this->view('admin/footer');
    }

    public function detail_user($id = 0)
    {
        if ($id) {
            $data['title'] = 'User';
            $data['nama'] = $this->payload->nama;
            $data['users'] = $this->userModel->getDetailUser($id);
            $this->view('admin/header', $data);
            $this->view('admin/detail-user', $data);
            $this->view('admin/footer');
        } else {
            echo 'Harap menggunakan tombol yang ada untuk melihat detail user';
        }
    }

    public function hapus_user($id = 0)
    {
        if ($id) {
            $hapus = $this->userModel->hapusUser($id);
            if ($hapus == 0) {
                Flasher::setFlash('User tidak ditemukan', 'danger');
                header('Location: ' . BASEURL . '/admin/daftar-user');
            } else {
                Flasher::setFlash('User berhasil dihapus', 'success');
                header('Location: ' . BASEURL . '/admin/daftar-user');
            }
        } else {
            header('Location: ' . BASEURL . '/admin/daftar-user');
        }
    }

    public function input_peminjaman()
    {
        $data['title'] = 'Input Peminjaman';
        $data['nama'] = $this->payload->nama;
        $data['buku'] = $this->bukuModel->getAllBuku();
        $data['waktu'] = [
            [
                'waktu' => 3,
                'nama' => '3 Hari'
            ],
            [
                'waktu' => 7,
                'nama' => '7 Hari'
            ],
            [
                'waktu' => 14,
                'nama' => '14 Hari'
            ]
        ];

        $this->view('admin/header', $data);
        $this->view('admin/input-peminjaman', $data);
        $this->view('admin/footer');
    }

    public function daftar_pinjaman()
    {
        $data['title'] = 'Daftar Pinjaman';
        $data['nama'] = $this->payload->nama;
        $data['pinjaman'] = $this->peminjamanModel->getAllPinjaman();

        $this->view('admin/header', $data);
        $this->view('admin/daftar-pinjaman', $data);
        $this->view('admin/footer');
    }

    public function penerbit()
    {
        $data['title'] = 'Penerbit';
        $data['nama'] = $this->payload->nama;
        $data['penerbit'] = $this->penerbitModel->getAllPenerbit();

        $this->view('admin/header', $data);
        $this->view('admin/penerbit', $data);
        $this->view('admin/footer');
    }

    public function tambah_penerbit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('Location: ' . BASEURL . '/admin/penerbit');
        }

        $this->penerbitModel->insertPenerbit($_POST);
        Flasher::setFlash('Penerbit berhasil ditambah', 'success');
        header('Location: ' . BASEURL . '/admin/penerbit');
    }

    public function ubah_penerbit($id = 0)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->penerbitModel->updatePenerbit($id, $_POST);
            Flasher::setFlash('Penerbit berhasil diubah', 'success');
            header('Location: ' . BASEURL . '/admin/penerbit');
        }

        if (!$id) {
            header('Location: ' . BASEURL . '/admin/penerbit');
        }

        $data['title'] = 'Penerbit';
        $data['nama'] = $this->payload->nama;
        $data['penerbit'] = $this->penerbitModel->getPenerbitById($id);
        $this->view('admin/header', $data);
        $this->view('admin/ubah-penerbit', $data);
        $this->view('admin/footer');
    }

    public function hapus_penerbit($id = 0)
    {
        if (!$id) {
            header('Location: ' . BASEURL . '/admin/penerbit');
        }

        $hapus = $this->penerbitModel->hapusPenerbit($id);
        if ($hapus == 0) {
            Flasher::setFlash('Penerbit tidak ditemukan', 'danger');
            header('Location: ' . BASEURL . '/admin/penerbit');
        } else {
            Flasher::setFlash('Penerbit berhasil dihapus', 'success');
            header('Location: ' . BASEURL . '/admin/penerbit');
        }
    }

    public function kategori()
    {
        $data['title'] = 'Kategori';
        $data['nama'] = $this->payload->nama;
        $data['kategori'] = $this->kategoriModel->getAllKategori();
        $this->view('admin/header', $data);
        $this->view('admin/kategori', $data);
        $this->view('admin/footer');
    }

    public function tambah_kategori()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('Location: ' . BASEURL . '/admin/kategori');
        }

        $this->kategoriModel->tambahKategori($_POST);
        Flasher::setFlash('Kategori baru berhasil ditambah', 'success');
        header('Location: ' . BASEURL . '/admin/kategori');
    }

    public function ubah_kategori($id = 0)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->kategoriModel->updateKategori($id, $_POST);
            Flasher::setFlash('Kategori berhasil diubah', 'success');
            header('Location: ' . BASEURL . '/admin/kategori');
        }

        if (!$id) {
            header('Location: ' . BASEURL . '/admin/kategori');
        }

        $data['title'] = 'Kategori';
        $data['nama'] = $this->payload->nama;
        $data['kategori'] = $this->kategoriModel->getKategoriById($id);
        $this->view('admin/header', $data);
        $this->view('admin/ubah-kategori', $data);
        $this->view('admin/footer');
    }

    public function hapus_kategori($id)
    {
        if (!$id) {
            header('Location: ' . BASEURL . '/admin/kategori');
        }

        $hapus = $this->kategoriModel->hapusKategori($id);
        if ($hapus == 0) {
            Flasher::setFlash('Kategori tidak ditemukan', 'danger');
            header('Location: ' . BASEURL . '/admin/kategori');
        } else {
            Flasher::setFlash('Kategori berhasil dihapus', 'success');
            header('Location: ' . BASEURL . '/admin/kategori');
        }
    }

    public function about()
    {
        $data['title'] = 'About';
        $data['nama'] = $this->payload->nama;

        $this->view('admin/header', $data);
        $this->view('about/index', $data);
        $this->view('admin/footer');
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        setcookie('PPI-Login', '', time() - 3600 * 24 * 30, '/');
        header('Location: ' . BASEURL . '/login');
    }
}
