<?php
namespace App\Models;
use CodeIgniter\Model;
class Login extends Model
{
    public function getDataUsers($username, $password)
    {
        $db = \Config\Database::connect();
        $queryString = 'SELECT name FROM user WHERE 
                        username = "'.$username.'" 
                        AND password = "'.$password.'"';
        $query = $db->query($queryString);
        $results = $query->getResult();
        
        // Check if user is found, and return name if found
        if (count($results) == 1) {
            return $results[0]->name;
        }
        
        return null;  // Return null if no user found
    }
}