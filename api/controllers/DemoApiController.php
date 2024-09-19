<?php

namespace Api\Controllers;

use zkFramework\Controller;

class DemoApiController extends Controller
{
    public function index()
    {
        $this->responseHTML('api', 'demo_api');
    }
}