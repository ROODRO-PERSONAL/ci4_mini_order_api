<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'price', 'stock', 'created_at', 'updated_at', 'dell_status'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    // using builder function
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
        helper('common');
    }


    // get all products
    public function getAllProducts()
    {
        try {
            $sql = "SELECT id, name, price, stock, created_at, updated_at, dell_status FROM products";
            $query = $this->db->query($sql);

            if (!$query) {
                throw new \Exception('Failed to execute query');
            }
            // Return raw result
            return $query->getResultArray();
        } catch (\Exception $e) {
            // Log the error message
            log_message('error', 'Error fetching products: ' . $e->getMessage());
            return false;
        }
    }


    // get all active products
    public function getAllActiveProducts()
    {
        try {
            $sql = "SELECT id, name, price, stock, created_at, updated_at FROM products WHERE dell_status = 0";
            $query = $this->db->query($sql);

            if (!$query) {
                throw new \Exception('Failed to execute query');
            }

            if ($query->getNumRows() > 0) {
                return $query->getResultArray();
            } else {
                return [];
            }
            // Return raw result
        } catch (\Exception $e) {
            // Log the error message
            log_message('error', 'Error fetching products: ' . $e->getMessage());
            return false;
        }
    }

    // Fetch product by ID Active products only
    public function getProductById(int $id)
    {
        try {
            $sql = "SELECT id, name, price, stock, created_at, updated_at FROM products WHERE id = ? AND dell_status = 0";
            $query = $this->db->query($sql, [$id]);
            if (!$query) {
                log_message('error', 'Failed to execute query: ' . $this->db->error()['message']);
                return false;
            }

            if ($query->getNumRows() > 0) {
                return $query->getRowArray();
            } else {
                return [];
            }
        } catch (\Exception $e) {
            log_message('error', 'Error fetching product by ID: ' . $e->getMessage());
            return false;
        }
    }

    // Create new product
    public function createProduct(array $data)
    {
        try {
            $sql = "INSERT INTO products (name, price, stock, created_at) VALUES (?, ?, ?, ?)";
            $this->db->query($sql, [$data['name'], $data['price'], $data['stock'], current_timestamp()]);
            if (!$this->db->affectedRows()) {
                throw new \Exception('Failed to insert product');
            }
            return $this->db->insertID();
        } catch (\Exception $e) {
            log_message('error', 'Error creating product: ' . $e->getMessage());
            return false;
        }
    }

    //  Update product by ID
    public function updateProductAllData(int $id, array $data)
    {
        try {
            $sql = "UPDATE products SET name = ?, price = ?, stock = ?, updated_at = ? WHERE id = ?";
            $this->db->query($sql, [$data['name'], $data['price'], $data['stock'], current_timestamp(), $id]);
            if (!$this->db->affectedRows()) {
                throw new \Exception('Failed to update product');
            }
            return true;
        } catch (\Exception $e) {
            log_message('error', 'Error updating product: ' . $e->getMessage());
            return false;
        }
    }

    // updae product set d_status = 1 by ID
    public function delProduct(int $id)
    {
        try {
            $sql = "UPDATE products SET dell_status = 1, updated_at = ? WHERE id = ?";
            $this->db->query($sql, [current_timestamp(), $id]);
            if (!$this->db->affectedRows()) {
                throw new \Exception('Failed to delete product');
            }
            return true;
        } catch (\Exception $e) {
            log_message('error', 'Error deleting product: ' . $e->getMessage());
            return false;
        }
    }

    // Delete product by ID (complete delete)
    public function deleteProduct(int $id)
    {
        try {
            $sql = "DELETE FROM products WHERE id = ?";
            $this->db->query($sql, [$id]);
            if (!$this->db->affectedRows()) {
                throw new \Exception('Failed to delete product');
            }
            return true;
        } catch (\Exception $e) {
            log_message('error', 'Error deleting product: ' . $e->getMessage());
            return false;
        }
    }
}
