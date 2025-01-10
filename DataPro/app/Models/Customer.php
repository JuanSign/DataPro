<?php
namespace App\Models;
use CodeIgniter\Model;
class Customer extends Model {
    protected $table = 'customer';

    public function getDataCustomer($searchTerm = null) {
        /*  START OF DOCS
        ===== Variables =====
        $likeTerm = "%$searchTerm%"; // Wrap the search term with '%' for the LIKE clause
        $query = "SELECT * FROM `customer` 
                  WHERE fname LIKE ? 
                     OR lname LIKE ? 
                     OR mi LIKE ? 
                  ORDER BY customer_id 
                  LIMIT 10"; // SQL query to get the customer data
            END OF DOCS 
        */ 

        // Ini yang benar
        // ===== Variables ===== 
        $likeTerm = "%$searchTerm%"; // Wrap the search term with '%' for the LIKE clause
        $query = "SELECT * FROM `customer` 
                  WHERE fname LIKE ? 
                     OR lname LIKE ? 
                     OR mi LIKE ? 
                  ORDER BY customer_id 
                  LIMIT 10";
        
        // Execute the query with placeholders
        return $this->db->query($query, [$likeTerm, $likeTerm, $likeTerm])->getResult();
    }
}