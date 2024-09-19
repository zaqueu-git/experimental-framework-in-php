<?php

namespace zkFramework;

/**
 * Classe de gerenciamento.
 */
abstract class Controller
{
    private static array $data = [];

    public function __construct()
    {
        $this->sanitizeRequestData($_GET);
        //$this->sanitizeRequestData($_POST);
        $this->sanitizeJsonData();
    }

    /**
     * Sanitiza dados de requisição.
     *
     * @param array $data Dados da requisição a serem sanitizados.
     * @return void
     */
    private function sanitizeRequestData(array $data): void
    {
        foreach ($data as $key => $value) {
            self::$data[$key] = $this->sanitizeInput($value);
        }
    }

    /**
     * Sanitiza dados JSON.
     *
     * @return void
     */
    private function sanitizeJsonData(): void
    {
        if (isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
            $json_input = file_get_contents('php://input');
            $data = json_decode($json_input, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
                $this->sanitizeRequestData($data);
            }
        }
    }

    /**
     * Envia uma resposta JSON ao cliente.
     *
     * @param array $data Dados a serem enviados na resposta JSON.
     * @param int $statusCode Código de status HTTP para a resposta. O padrão é 200.
     * @return void
     */
    protected static function responseJSON(array $data, int $statusCode = 200): void
    {
        // Define os cabeçalhos de tipo de conteúdo
        header("HTTP/1.1 {$statusCode}");
        header("Content-Type: application/json; charset=UTF-8");
        header("X-Robots-Tag: noindex, nofollow");

        // Codifica os dados como JSON e exibe o conteúdo
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    /**
     * Renderiza uma view HTML e envia a resposta ao cliente.
     *
     * @param string $view Nome da view a ser carregada.
     * @param array $data Dados a serem passados para a view.
     * @return void
     * @throws \Exception Se o arquivo da view não for encontrado ou não for legível.
     */
    protected static function responseHTML(string $project, string $view, array $data = []): void
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $data["csrf_token"] = '<input type="hidden" name="csrf_token" value="'. $_SESSION['csrf_token']. '">';
        }

        // Define o caminho do arquivo de view
        $filePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $project . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $view . '.php';

        // Verifica se o arquivo da view existe e é legível
        if (!file_exists($filePath) || !is_readable($filePath)) {
            throw new \Exception("The view '{$view}' was not found at '{$filePath}'.");
        }

        // Define os cabeçalhos de tipo de conteúdo
        header("HTTP/1.1 200 OK");
        header("Content-Type: text/html; charset=UTF-8");

        // Extrai os dados para variáveis individuais, se fornecidos
        if (!empty($data)) {
            extract($data, EXTR_SKIP);
        }

        // Utiliza o buffer de saída para capturar o conteúdo da view
        ob_start();
        include $filePath;
        $content = ob_get_clean();

        // Exibe o conteúdo HTML gerado
        echo $content;
    }

    /**
     * Redireciona o usuário para uma nova URL.
     *
     * @param string $url O caminho para o qual o usuário deve ser redirecionado.
     * @return void
     */
    protected static function redirect(string $url): void
    {
        if (isset($_ENV['DEBUG']) && $_ENV['DEBUG']) {
            $http = "http://";
        } else {
            $http = "https://";
        }
        
        $redirectUrl = $http . $_SERVER['HTTP_HOST'] . $url;

        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");
        header("Location: " . $redirectUrl, true, 302);
    }

    /**
     * Recupera o valor associado a uma chave específica do array de dados.
     *
     * @param string $key O nome da chave no array de dados.
     * @return string|null
     */
    protected static function request(string $key): ?string
    {
        return self::$data[$key] ?? '';
    }

    /**
     * Sanitiza a entrada de dados.
     *
     * @param string $data A entrada de dados a ser sanitizada.
     * @return string
     */
    protected static function sanitizeInput(string $data): string
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    /**
     * Cria e retorna uma instância de conexão com o banco de dados.
     *
     * @return \PDO Instância de PDO configurada para conectar ao banco de dados.
     */
    protected static function buildDB(): \PDO
    {
        $server = $_ENV['DEBUG'] ? $_ENV['DBH_SERVER'] : $_ENV['DBP_SERVER'];
        $name = $_ENV['DEBUG'] ? $_ENV['DBH_NAME'] : $_ENV['DBP_NAME'];
        $user = $_ENV['DEBUG'] ? $_ENV['DBH_USER'] : $_ENV['DBP_USER'];
        $password = $_ENV['DEBUG'] ? $_ENV['DBH_PASSWORD'] : $_ENV['DBP_PASSWORD'];

        try {
            return Database::mysql($server, $name, $user, $password);
        } catch (\PDOException $e) {
            throw new \Exception("Database connection error: " . $e->getMessage(), 0, $e);
        } catch (\Throwable $e) {
            throw new \Exception("Unexpected error: " . $e->getMessage(), 0, $e);
        }
    }
}
