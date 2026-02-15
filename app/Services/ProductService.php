<?php

namespace App\Services;

use App\Models\ProductModel;

class ProductService
{
    protected $productModel;
    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    // total item value by item
    public function calCulateTotalProdValue(int $id)
    {
        try {
            $prodData = $this->productModel->getProductById($id);

            if (!$prodData) {
                return [];
            }else{
                return ['product'=>$prodData,'total_value'=>$prodData['price'] * $prodData['stock']];
            }
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    // total invetory value
    public function calCulateTotalInvValue()
    {
        try {
            $prodData = $this->productModel->getAllProducts();

            if (!$prodData) {
                return [];
            }else{
                $totalValue = 0;
                foreach($prodData as $prod){
                    $totalValue += $prod['price'] * $prod['stock'];
                }
                return ['total_inventory_value'=>$totalValue];
            }
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    // total active inventory value
    public function calculateTotalActiveInvVal()
    {
        try {
            $prodData = $this->productModel->getAllActiveProducts();

            if (!$prodData) {
                return [];
            }else{
                $totalValue = 0;
                foreach($prodData as $prod){
                    $totalValue += $prod['price'] * $prod['stock'];
                }
                return ['total_active_inventory_value'=>$totalValue];
            }
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
}
