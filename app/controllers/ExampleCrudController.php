<?php

namespace App\Controllers;

use App\Models\Example;
use App\Repositories\ExampleRepository;
use zkFramework\Controller;

class ExampleCrudController extends Controller
{
    private $exampleRepository;

    public function __construct() {
        parent::__construct();
        $this->exampleRepository = new ExampleRepository($this->buildDB());
    }

    public function all()
    {
        $examples = $this->exampleRepository->all();

        $this->responseHTML('app', 'demo_view', ['examples' => $examples]);
    }

    public function create($parameters)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            
            $example = new Example();
            $example->name = $this->request('name');

            if ($this->exampleRepository->create($example)) {
                echo 'Registro cadastrado com sucesso.';
                echo '<br>';
                echo 'ID: ' . $this->exampleRepository->lastInsertId();
            } else {
                echo 'Falha ao cadastrar o registro.';
            }

        } else {
            $this->responseHTML('app', 'demo_form', ['url' => '/crud/create']);
        }
    }

    public function read($parameters)
    {
        $example = new Example();
        $example->id = $parameters['id'];

        $example = $this->exampleRepository->find($example);
        
        if ($example) {
            echo "ID: " . $example->id . ", Nome: " . $example->name . "<br>";
        } else {
            echo "Registro não encontrado.";
        }
    }

    public function alter($parameters)
    {
        $example = new Example();
        $example->id = $parameters['id'];
        $example->name = "Nome de teste";

        if ($this->exampleRepository->alter($example)) {
            echo "Registro atualizado com sucesso.";
            echo '<br>';
            echo 'ID: ' . $example->id;
        } else {
            echo "Falha ao atualizar o registro.";
        }
    }

    public function remove($parameters)
    {
        $example = new Example();
        $example->id = $parameters['id'];

        if ($this->exampleRepository->delete($example)) {
            echo "Registro removido com sucesso.";
            echo '<br>';
            echo 'ID: ' . $example->id;
        } else {
            echo "Fala ao remover o registro.";
        }
    }
}