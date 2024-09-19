<?php

namespace App\Controllers;

use zkFramework\Controller;

class DemoHomeController extends Controller
{
    public function index()
    {
        $this->responseHTML('app', 'demo_home');
    }
}