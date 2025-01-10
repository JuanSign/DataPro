<?php
namespace App\Models;

use CodeIgniter\Model;

class Coba extends Model {
    protected $table = 'coba';
    protected $primaryKey = 'id';
    protected $allowedFields = ['value'];

    public function getDataCoba($searchTerm = null) {
          /*  START OF DOCS
        ===== Variables =====
        $likeTerm = "%$searchTerm%"; // Wrap the search term with '%' for the LIKE clause
        $query = "SELECT * FROM 'coba' // SQL query to get the coba data
            END OF DOCS 
        */ 
  
        // ===== Variables ===== 
        $likeTerm = "%$searchTerm%"; // Wrap the search term with '%' for the LIKE clause
        $query = "SELECT * FROM `coba` WHERE value LIKE ?";

        // Execute the query with placeholders
        return $this->db->query($query, [$likeTerm])->getResult();
    }

    public function getAllDataCoba() {
        $query = "SELECT * FROM `coba`";
        return $this->db->query($query)->getResult();
    }

}