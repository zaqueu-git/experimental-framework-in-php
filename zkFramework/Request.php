<?php

namespace zkFramework;

/**
 * Classe de gerenciamento.
 */
class Request
{
    /**
     * Armazena as rotas para requisições.
     *
     * @var array
     */
    private static array $routes = [];
    
    /**
     * Armazena a rota atual e seus parâmetros.
     *
     * @var Router
     */
    private static Router $currentRouter;

    /**
     * Armazena a URL atual.
     *
     * @var string
     */
    private static string $currentUrl;

    /**
     * Armazena o grupo atual.
     *
     * @var string
     */    
    private static string $currentGroup;

    /**
     * Obtém a rota atual.
     *
     * @return Router
     */
    public static function getCurrentRouter() : Router
    {
        return self::$currentRouter;
    }

    /**
     * Resolve e configura o controlador e método.
     *
     * @return void
     */
    private static function currentController() : void
    {        
        $className = self::$currentRouter->controller;
        $methodName = self::$currentRouter->action;
        
        if (!class_exists($className)) {
            throw new \Exception("Class {$className} is not defined", 1);
        }
        
        $controller = new $className();
        
        if (!method_exists($controller, $methodName)) {
            throw new \Exception("Method {$methodName} in class {$className} is not defined", 1);
        }

        $controller->$methodName(self::$currentRouter->parameters);
    }
    
    /**
     * Resolve a rota atual para determinar o controlador e métodos.
     *
     * @return void
     */ 
    private static function currentRouter() : void
    {
        if (isset(self::$routes["others"][$_SERVER['REQUEST_METHOD']][self::$currentUrl])) {

            self::$currentRouter = self::$routes["others"][$_SERVER['REQUEST_METHOD']][self::$currentUrl];

        } else if (isset(self::$routes[self::$currentGroup][$_SERVER['REQUEST_METHOD']][self::$currentUrl])) {
            
            self::$currentRouter = self::$routes[self::$currentGroup][$_SERVER['REQUEST_METHOD']][self::$currentUrl];

        } else if (isset(self::$routes[self::$currentGroup][$_SERVER['REQUEST_METHOD']])) {

            foreach (self::$routes[self::$currentGroup][$_SERVER['REQUEST_METHOD']] as $auxUrl => $auxController) {
                // Escapa as barras na URL da rota para serem interpretadas literalmente na expressão regular
                $regex = str_replace('/', '\/', $auxUrl);

                // Substitui os parâmetros por grupos nomeados na expressão regular
                $regex = preg_replace('/{([^{}]+)}/', '(?P<$1>[a-zA-Z0-9]+)', $regex);

                // Tenta fazer uma correspondência entre a URL atual e a expressão regular da rota
                $result = preg_match('/^' . $regex . '$/', self::$currentUrl, $auxParameters);

                if ($result) {
                    self::$currentRouter = self::$routes[self::$currentGroup][$_SERVER['REQUEST_METHOD']][$auxUrl];
                    self::$currentRouter->parameters = array_filter($auxParameters, 'is_string', ARRAY_FILTER_USE_KEY);
                    break;
                }
            }

        }

        if (empty(self::$currentRouter)) {
            throw new \Exception("URL invalid", 1);
        }        
    }

    /**
     * Resolve a URL atual para determinar a rota e parâmetros.
     *
     * @return bool
     */    
    private static function currentUrl() : void
    {
        // Obtém o valor da URL com segurança
        $url = isset($_GET['url']) ? trim($_GET['url']) : '/';
        
        // Remove caracteres indesejados para prevenir ataques de injeção
        $url = filter_var($url, FILTER_SANITIZE_URL);
        
        // Normaliza o caminho para evitar ataques como Directory Traversal
        $url = preg_replace('/\.\.\//', '', $url);
        
        // Garante que o URL comece com uma barra e remove qualquer barra extra no final
        $url = '/' . ltrim($url, '/');

        // Armazena a 'url' atual
        self::$currentUrl = $url;

        // Armazena o 'grupo' atual
        self::$currentGroup = explode("/", self::$currentUrl)[1];

        // Remove o parâmetro 'url' da query string
        unset($_GET['url']);
    }

    /**
     * Carrega as variáveis necessárias.
     *
     * @return void
     */
    private static function load() : void
    {
        $filesPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR;

        if (is_dir($filesPath)) {
            // DirectoryIterator para iterar sobre os arquivos no diretório
            $iterator = new \DirectoryIterator($filesPath);

            // Itere sobre os arquivos e pastas no diretório
            foreach ($iterator as $fileinfo) {
                // Verifique se o item é um arquivo e se tem a extensão .php
                if ($fileinfo->isFile() && $fileinfo->getExtension() === 'php') {
                    include_once $fileinfo->getPathname();
                }
            }
        }
    }

    /**
     * Adiciona uma rota.    
     *
     * @param Router $router Instância do objeto Router que define a rota.
     */    
    protected static function setRoute(Router $router) : void
    {
        if ($router->group && $router->method && $router->url) {
            self::$routes[$router->group][$router->method][$router->url] = $router;
        }
    }    

    /**
     * Gerencia a lógica das operações da classe.
     *
     * @return void
     */       
    public static function operations() : void
    {
        self::load();
        self::currentUrl();
        self::currentRouter();
        self::currentController();
    }
}