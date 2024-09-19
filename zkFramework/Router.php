<?php

namespace zkFramework;

/**
 * Classe de gerenciamento.
 */
class Router extends Request
{
    private static string $currentGroupAux = "";
    private static string $currentControllerAux = "";
        
    /**
     * Armazena o grupo da rota.
     *
     * @var string
     */
    public string $group;

    /**
     * Armazena o método HTTP associado à rota (GET, POST, etc.).
     *
     * @var string
     */
    public string $method;

    /**
     * Armazena o padrão de URL para a rota.
     *
     * @var string
     */
    public string $url;

    /**
     * Armazena a classe do controlador associado à rota.
     *
     * @var string
     */
    public string $controller;

    /**
     * Armezena o nome do método do controlador a ser chamado.
     *
     * @var string
     */
    public string $action;

    /**
     * Armazena os parâmetros extraídos da URL que serão passados para o método do controlador.
     *
     * @var array
     */
    public array $parameters = [];

    /**
     * Adiciona o grupo na rota.
     *
     * @param string $group O nome do grupo das urls.
     * @param string $controller O nome da classe do controlador para a rota.
     * @param callable $callback Demais rotas.
     * @return void
     */
    public static function addGroup(string $group, string $controller, callable $callback) : void
    {
        self::$currentGroupAux = $group;
        self::$currentControllerAux = $controller;
        $callback();
        self::$currentGroupAux = "";
        self::$currentControllerAux = "";
    }

    /**
     * Adiciona uma rota GET ao roteador.
     *
     * @param string $url O padrão de URL para a rota.
     * @param string $action O nome do método do controlador a ser chamado.
     * @param string $controller O nome da classe do controlador para a rota.
     * @return void
     */    
    public static function addGet(string $url, string $action, string $controller = "") : void
    {
        $group = self::$currentGroupAux ? self::$currentGroupAux : 'others';
        $controller = self::$currentControllerAux ? self::$currentControllerAux : $controller;

        $router = new self();
        $router->group = $group;
        $router->method = "GET";
        $router->url = $url;
        $router->controller = $controller;
        $router->action = $action;

        self::setRoute($router);
    }

    /**
     * Adiciona uma rota POST ao roteador.
     *
     * @param string $url O padrão de URL para a rota.
     * @param string $action O nome do método do controlador a ser chamado.
     * @param string $controller O nome da classe do controlador para a rota.
     * @return void
     */    
    public static function addPost(string $url, string $action, string $controller = "") : void
    {
        $group = self::$currentGroupAux ? self::$currentGroupAux : 'others';
        $controller = self::$currentControllerAux ? self::$currentControllerAux : $controller;

        $router = new self();
        $router->group = $group;
        $router->method = "POST";
        $router->url = $url;
        $router->controller = $controller;
        $router->action = $action;

        self::setRoute($router);
    }
}