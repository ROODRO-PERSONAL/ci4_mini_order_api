<?php

namespace App\Controllers\Api;


use CodeIgniter\RESTful\ResourceController;
use App\Models\ProductModel;
use App\Services\ProductService;

class ProductController extends ResourceController
{

    protected $productModel;
    protected $productService;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->productService = new ProductService();
    }

    // get all products
    public function getAllProd()
    {
        $products = $this->productModel->getAllProducts();
        if($products == false){
            return $this->respond(['status' => false, 'message' => 'Server Error'], 500);
        }else{
            if(empty($products)){
                return $this->respond(['status' => false, 'message' => 'No products found']);
            }else{
                return $this->respond(['status' => true, 'message' => 'Products retrieved successfully', 'data' => $products]);
            }
        }
    }

    // get all active products
    public function getAllActiveProd()
    {
        $products = $this->productModel->getAllActiveProducts();
        if($products == false){
            return $this->respond(['status' => false, 'message' => 'Server Error'], 500);
        }else{
            if(empty($products)){
                return $this->respond(['status' => false, 'message' => 'No active products found']);
            }else{
                return $this->respond(['status' => true, 'message' => 'Active products retrieved successfully', 'data' => $products]);
            }
        }
    }


    // fetch specific data
    public function fetchById($id)
    {
        $product = $this->productModel->getProductById($id);
        if($product == false){
            return $this->respond(['status' => false, 'message' => 'Server Error'], 500);
        }else{
            if(empty($product)){
                return $this->respond(['status' => false, 'message' => 'Product not found']);
            }else{
                return $this->respond(['status' => true, 'message' => 'Product retrieved successfully', 'data' => $product]);
            }
        }
    }

    // insert data
    public function insert()
    {
        $data = $this->request->getPost();
        if (!$data) {
            return $this->respond(['status' => false, 'message' => 'Invalid JSON data'], 400);
        }

        // Validate required fields
        if (empty($data['name']) || empty($data['price']) || empty($data['stock'])) {
            return $this->respond(['status' => false, 'message' => 'Name, price, and stock are required'], 400);
        }

        $result = $this->productModel->createProduct($data);
        if ($result === false) {
            return $this->respond(['status' => false, 'message' => 'Failed to insert product'], 500);
        } else {
            return $this->respond(['status' => true, 'message' => 'Product inserted successfully', 'data' => ['id' => $result]], 201);
        }
    }



    // update data
    public function updateProductAllData($id)
    {
        $data = $this->request->getPost();
        if (!$data) {
            return $this->respond(['status' => false, 'message' => 'Invalid JSON data'], 400);
        }

        // Validate required fields
        if (empty($data['name']) || empty($data['price']) || empty($data['stock'])) {
            return $this->respond(['status' => false, 'message' => 'Name, price, and stock are required'], 400);
        }

        $result = $this->productModel->updateProductAllData($id, $data);
        if ($result === false) {
            return $this->respond(['status' => false, 'message' => 'Failed to update product'], 500);
        } else {
            return $this->respond(['status' => true, 'message' => 'Product updated successfully']);
        }
    }


    // del status 1
    public function setDelete($id)
    {
        $result = $this->productModel->delProduct($id);
        if ($result === false) {
            return $this->respond(['status' => false, 'message' => 'Failed to delete product'], 500);
        } else {
            return $this->respond(['status' => true, 'message' => 'Product deleted successfully']);
        }
    }


    // delete product by ID (complete delete)
    public function deleteProd($id)
    {
        $result = $this->productModel->deleteProduct($id);
        if ($result === false) {
            return $this->respond(['status' => false, 'message' => 'Failed to delete product'], 500);
        } else {
            return $this->respond(['status' => true, 'message' => 'Product deleted successfully']);
        }   
    }


    // business logic functions call
    public function calCulateTotalProdValue($id)
    {
        $result = $this->productService->calCulateTotalProdValue($id);
        if (empty($result)) {
            return $this->respond(['status' => false, 'message' => 'No data found'], 500);
        } else {
            return $this->respond(['status' => true, 'message' => 'Total product value calculated successfully', 'data' => $result]);
        }
    }

    // get total inventory value
    public function calCulateTotalInv()
    {
        $result = $this->productService->calCulateTotalInvValue();
        if (empty($result)) {
            return $this->respond(['status' => false, 'message' => 'No inventory stock found'], 500);
        } else {
            return $this->respond(['status' => true, 'message' => 'Total inventory value calculated successfully', 'data' => $result]);
        }   
    }

    // get total active inventory value
    public function calculateTotalActiveInv()
    {
        $result = $this->productService->calculateTotalActiveInvVal();
        if (empty($result)) {
            return $this->respond(['status' => false, 'message' => 'No active inventory stock found'], 500);
        } else {
            return $this->respond(['status' => true, 'message' => 'Total active inventory value calculated successfully', 'data' => $result]);
        }
    }
}
