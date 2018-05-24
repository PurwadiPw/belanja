<?php
include_once "models/Model.php";

class Controller
{
    public $model;
    public $session;

    public function __construct()
    {
        $this->model = new Model();

        // publik session
        $this->session = [
            'username'  => isset($_SESSION['username']) && !empty($_SESSION['username']) ? $_SESSION['username'] : false,
            'user_nama' => isset($_SESSION['user_nama']) && !empty($_SESSION['user_nama']) ? $_SESSION['user_nama'] : '',
        ];

        // ubah array post ke variable langsung
        foreach ($_POST as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function index()
    {
        require_once 'views/partials/header.php';
        require_once 'views/index.php';
        require_once 'views/partials/footer.php';
    }

    public function member()
    {
        $pesan = isset($_SESSION['pesan']) && !empty($_SESSION['pesan']) ? $_SESSION['pesan'] : false;
        require_once 'views/partials/header.php';
        if (isset($_SESSION['username']) && !empty($_SESSION['username']) && isset($_SESSION['level']) && $_SESSION['level'] == "member") {
            echo 'member area';
        } else {
            require_once 'views/auth_form.php';
        }
        require_once 'views/partials/footer.php';
        unset($_SESSION['pesan']);
    }

    public function auth()
    {
        if (isset($this->do_login)) {
            $auth = $this->model->select('user', ['user_username' => $this->username, 'user_password' => md5($this->user_password)]);
            if ($auth != null) {
                $_SESSION['user_id']     = $auth->user_id;
                $_SESSION['username']    = $auth->user_username;
                $_SESSION['user_nama']   = $auth->user_nama;
                $_SESSION['user_telp']   = $auth->user_telp;
                $_SESSION['user_alamat'] = $auth->user_alamat;
                $_SESSION['level']       = $auth->user_level;
            } else {
                $_SESSION['pesan'] = "Uppss..Username atau Password Salah. Coba Ulangi lagi.!!";
            }
        } elseif ($this->do_register) {
            if ($this->user_password != $this->user_password_repeat) {
                $_SESSION['pesan'] = "Uppss..password tidak sama!!";
            } else {
                $simpan_data_register = [
                    'user_username' => $this->user_username,
                    'user_nama' => $this->user_nama,
                    'user_email' => $this->user_email,
                    'user_password' => md5($this->user_password),
                    'user_level' => 'member',
                ];
                $this->model->insert('user', $simpan_data_register);
                $_SESSION['pesan'] = "Register berhasil!!";
            }
        }
        header("location:" . base_url . "/?page=member");
    }

    public function produk()
    {
        require_once 'views/partials/header.php';
        if (isset($_GET['i'])) {
            require_once 'views/produk_detail.php';
        } else {
            require_once 'views/produk_all.php';
        }
        require_once 'views/partials/footer.php';
    }

    public function cart()
    {
        // tambah
        if (!empty($this->proses) && $this->proses == "Beli") {
            // cek apakah udah ada barang di cart user ini
            $cek_cart = $this->model->select('jual', ['id_product' => $this->produk_id, 'temp_session' => session_id()]);
            // jika tidak ada insert baru jika ada tambah itemnya
            if ($cek_cart == null) {
                $no_penjualan = $this->model->noPenjualan();

                $simpan_data_cart = [
                    'no_penjualan' => $no_penjualan,
                    'id_product'   => $this->produk_id,
                    'quantity'     => 1,
                    'harga'        => $this->produk_harga,
                    'temp_session' => session_id(),
                ];
                $this->model->insert('jual', $simpan_data_cart);
            } else {
                // cek apakah permintaan melebihi stok. jika iya tolak jika tidak tambah qty nya
                if ($cek_cart->quantity >= $this->produk_stok) {
                    $_SESSION['pesan'] = "Maaf, Stok hanya tersedia $this->produk_stok";
                } else {
                    $update_cart_data = [
                        'quantity' => $cek_cart->quantity + 1,
                        'harga'    => $this->produk_harga * ($cek_cart->quantity + 1),
                    ];
                    $this->model->update('jual', $update_cart_data, "id_product='" . $this->produk_id . "' AND temp_session='" . session_id() . "'");
                }
            }
            $_SESSION['pesan'] = "Cart berhasil di tambahkan.";
        }

        // update
        if (isset($this->update)) {
            $cek_cart = $this->model->select('jual', ['id' => $this->jual_id]);

            // cek apakah permintaan melebihi stok. jika iya tolak jika tidak tambah qty nya
            if ($this->quantity > $this->produk_stok) {
                $_SESSION['pesan'] = "Maaf, Stok hanya tersedia $this->produk_stok";
            } else {
                $update_cart_data = [
                    'quantity' => $this->quantity,
                    'harga'    => $this->produk_harga * $this->quantity,
                ];
                $this->model->update('jual', $update_cart_data, "id='" . $this->jual_id . "'");
                $_SESSION['pesan'] = "Cart berhasil di ubah.";
            }

            // jika jumlah 0 maka hapus
            if ($this->quantity <= 0) {
                $this->model->delete('jual', "id='" . $this->jual_id . "'");
                $_SESSION['pesan'] = "Cart berhasil di ubah.";
            }
        }

        // hapus
        if (isset($this->hapus)) {
            $this->model->delete('jual', "id='" . $this->jual_id . "'");
            $_SESSION['pesan'] = "Cart berhasil di hapus.";
        }

        $pesan = isset($_SESSION['pesan']) && !empty($_SESSION['pesan']) ? $_SESSION['pesan'] : false;
        require_once 'views/partials/header.php';
        require_once 'views/cart.php';
        require_once 'views/partials/footer.php';
        unset($_SESSION['pesan']);
    }

    public function checkout()
    {
        $member = isset($_SESSION['username']) && !empty($_SESSION['username']) ? $_SESSION['username'] : "";
        $level = isset($_SESSION['level']) && !empty($_SESSION['level']) ? $_SESSION['level'] : "";

        if (empty($member) || $level != "member") {
            header("location:" . base_url . "/?page=member");
        }

        if (isset($this->submit_selesai)) {
            // simpan dulu data user
            $update_data_user = [
                'user_nama' => $this->user_nama,
                'user_telp' => $this->user_telp,
                'user_alamat' => $this->user_alamat,
            ];
            $this->model->update('user', $update_data_user, "user_id='".$this->user_id."'");

            // simpan data penjualan
            $simpan_data_penjualan = [
                'no_penjualan' => $this->no_penjualan,
                'tanggal' => date('Y-m-d'),
                'nama' => $this->user_nama,
                'no_hp' => $this->user_telp,
                'alamat' => $this->user_alamat,
            ];
            $this->model->insert('penjualan', $simpan_data_penjualan);

            // potong stok
            $products = $this->model->select('jual', "no_penjualan='".$this->no_penjualan."'");
            foreach ($products as $prod) {
                $produk = $this->model->select('products', ['id' => $prod->id_product]);
                $update_produk_data = [
                    'stock' => $produk->stock - $prod->quantity,
                ];
                $this->model->update('products', $update_produk_data, "id='".$produk->id."'");
            }

            // hapus temporary session
            $update_data_temp_session = [
                'temp_session' => null
            ];
            $this->model->update('jual', $update_data_temp_session, "no_penjualan='".$this->no_penjualan."'");

            // redirect ke halaman thanks
            header("location:" . base_url."/?page=thanks");
        }

        $user = $this->model->select('user', ['user_id' => $_SESSION['user_id']]);
        $no_penjualan = $this->model->noPenjualan(session_id());
        require_once 'views/partials/header.php';
        require_once 'views/checkout.php';
        require_once 'views/partials/footer.php';
    }

    public function thanks()
    {
        require_once 'views/partials/header.php';
        require_once 'views/sukses.php';
        require_once 'views/partials/footer.php';
    }

    public function logout()
    {
        session_destroy();
        header("location:" . base_url);
    }

    public function rupiah($rupiah)
    {
        $rp = number_format($rupiah, 0, ".", ".");
        return $rp;
    }

    public function produkList()
    {
        return $this->model->select('products');
    }

    public function cartList()
    {
        $where = [
            'jual.id_product'   => 'products.id',
            'jual.temp_session' => session_id(),
        ];
        $carts = $this->model->cartList($where);
        return $carts;
    }

}
