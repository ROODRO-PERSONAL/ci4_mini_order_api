<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class TestController extends ResourceController
{
    public function index()
    {
        return $this->respond([
            'status' => true,
            'message' => 'API is working'
        ]);
    }
}
    