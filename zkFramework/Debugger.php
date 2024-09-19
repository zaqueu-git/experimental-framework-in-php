<?php

namespace zkFramework;

/**
 * Classe de gerenciamento.
 */
class Debugger
{
    private static function viewInfo() : void
    {
        $filePath = __DIR__ . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'debugger.json';

        if (file_exists($filePath)) {        
            if (json_last_error() === JSON_ERROR_NONE) {
                $json = file_get_contents($filePath);
                include_once 'views/debugger.php';
            }
        }
    }

    private static function sanitizeJsonData()
    {
        if (isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
            $json_input = file_get_contents('php://input');
            $data = json_decode($json_input, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
                return $data;
            }
        }
        return [];
    }

    /**
     * Carrega as variáveis necessárias.
     *
     * @return void
     */
    private static function load() : void
    {
        $map = [
            'System' => [
                'Version' => phpversion(),
                'SO' => PHP_OS,
                'Runtime' => (microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']) . ' seconds',
                'MemoryUsage' => memory_get_usage(),
                'TimeZone' => date_default_timezone_get(),
            ],
            'Ini' => [
                'log_errors' => ini_get('log_errors'),
                'error_log' => ini_get('error_log'),
                'display_errors' => ini_get('display_errors'),
                'display_startup_errors' => ini_get('display_startup_errors'),
                'error_reporting' => ini_get('error_reporting'),
                'memory_limit' => ini_get('memory_limit'),
                'max_execution_time' => ini_get('max_execution_time'),
                'upload_max_filesize' => ini_get('upload_max_filesize'),
                'post_max_size' => ini_get('post_max_size'),
            ],
            'Track' => debug_backtrace(),
            'Include' => get_included_files(),
            'Env' => isset($_ENV) ? $_ENV : null,
            'Header' => headers_list(),
            'Session' => isset($_SESSION) ? $_SESSION : null,
            'Request' => [
                'get' => $_GET,
                'post' => $_POST,
                'json' => self::sanitizeJsonData(),
            ],
            'Route' => Request::getCurrentRouter(),
        ];

        $json = json_encode($map, JSON_PRETTY_PRINT);
        $json = str_replace('\/', '/', $json);
        
        $filePath = __DIR__ . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'debugger.json';

        if (file_exists($filePath) && is_readable($filePath)) {
            file_put_contents($filePath, $json);
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
        self::viewInfo();
    }
}