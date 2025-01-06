<?php
namespace App\Models;
use CodeIgniter\Model;
class CustomerAuth extends Model{
    function getDataAuthentication($username, $pass){
        $db = \Config\Database::connect();
        $queryString = 'SELECT name FROM user 
                        WHERE username = "'.$username.'"
                        AND password = "'.$pass.'"';
        $query = $db->query($queryString);
        $results = $query->getResult();
        return count($results); 
    }
}