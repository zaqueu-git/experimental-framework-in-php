<?php

namespace App\Controllers;

use zkFramework\Controller;

class DemoCrudController extends Controller
{
    public function index()
    {
        $this->responseHTML('app', 'demo_crud');
    }
}