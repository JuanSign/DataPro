<?php
// App/Models/UserModel.php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'username';
    protected $allowedFields = ['username', 'password', 'name'];

    // Validasi user dengan password yang di-hash menggunakan md5
    public function validateUser($username, $password, $name)
    {
        // Hash password inputan pengguna dengan md5
        $hashedPassword = md5($password);
    
        // Cari user berdasarkan username dan name
        $user = $this->where('username', $username)
                     ->where('name', $name)
                     ->first();
    
        // Debugging: Periksa apakah data pengguna ditemukan
        var_dump($user); exit();  // Cek output di browser
    
        // Jika user ditemukan dan password valid
        if ($user && $user['password'] === $hashedPassword) {
            return $user;  // Kembalikan data user jika password valid
        }
    
        return null;  // Return null jika user tidak ditemukan atau password salah
    }
    
}
