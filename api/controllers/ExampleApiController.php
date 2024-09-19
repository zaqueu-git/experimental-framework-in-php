<?php
namespace Api\Controllers;

use zkFramework\Controller;

class ExampleApiController extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function create()
    {
        $this->responseJSON(['message' => 'Registro cadastrado com sucesso.'], 200);
    }

    public function read($params)
    {
        $this->responseJSON([$params['id'] => 'Conteúdo ' . $params['id']], 200);
    }

    public function alter($params)
    {
        $this->responseJSON([$params['id'] => 'Outro Conteúdo ' . $params['id']], 200);
    }

    public function remove($params)
    {
        $this->responseJSON(['Registro removido com sucesso.'], 200);
    }
}