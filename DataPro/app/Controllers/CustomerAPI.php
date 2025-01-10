<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\CustomerAuth;
use App\Models\Customer;

class CustomerAPI extends ResourceController {
    public function index($seg1 = null, $seg2 = null) {
        $model = model(CustomerAuth::class);
        $username = $seg1;
        $password = md5($seg2); // Menggunakan md5 untuk pencocokan password
        
        // Memverifikasi apakah autentikasi berhasil
        $cek = $model->getDataAuthentication($username, $password);
        
        if ($cek == 0) {
            // Jika autentikasi gagal
            return $this->respond(['message' => 'Wrong Authentication!'], 401);
        } else {
            // Jika autentikasi berhasil, ambil data customer
            $model1 = model(Customer::class);
            $data = [
                'message' => 'success',
                'customer' => $model1->getDataCustomer(),
                'username' => $username,  // Menambahkan username pengguna
                // Anda bisa menambahkan password jika perlu, meskipun ini tidak disarankan
                'password' => $seg2 // Menambahkan password yang dikirimkan (harus dihindari untuk alasan keamanan)
            ];
            
            return $this->respond($data, 200); // Mengembalikan respons sukses dengan data pengguna
        }
    }
}
