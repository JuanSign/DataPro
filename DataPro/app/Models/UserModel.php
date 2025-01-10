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
        $user = $this->where('username', $username)
                     ->where('name', $name)
                     ->first();
    
        // // Debugging: Periksa apakah data pengguna ditemukan
        // var_dump($user); exit(); 
    
        if ($user && $user['password'] === $hashedPassword) {
            return $user;
        }
    
        return null;
    }
    
}
