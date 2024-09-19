<?php

namespace zkFramework;

/**
 * Classe de gerenciamento.
 */
class Log
{
    private static function viewErrorInternal() : void
    {
        header("HTTP/1.1 500 Internal Server Error");
        header("Content-Type: text/html; charset=UTF-8");
        include_once 'views/500.php';
    }

    private static function viewNotFound() : void
    {
        header("HTTP/1.1 404 Not Found");
        header("Content-Type: text/html; charset=UTF-8");
        include_once 'views/404.php';
    }

    /**
     * Manipula exceções lançadas no aplicativo.
     *
     * @param \Throwable $th A exceção que foi lançada.
     * @return bool
     */
    public static function throwable(\Throwable $th) : bool
    {
        if (isset($_ENV['DEBUG']) && $_ENV['DEBUG']) {
            echo $th;
            return false;
        }

        if ($th->getCode() == 1) {
            self::viewNotFound();
            return true;
        }

        $logMessage = $th->getMessage() . "\n";
        $logMessage .= "Stack trace:\n" . $th->getTraceAsString() . "\n";
        $logMessage .= "Occurred on: " . date('Y-m-d H:i:s') . "\n\n";

        $fileName = 'error_';
        $fileName .= base64_encode($th->getMessage());
        $fileName .= '.log';

        $filePath = __DIR__;

        if (isset($_ENV['PATH_LOGS']) && !empty($_ENV['PATH_LOGS'])) {
            $filePath .= $_ENV['PATH_LOGS'];
        } else {
            $filePath .= DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR;
        }

        if (file_exists($filePath) && is_readable($filePath)) {
            $filePath .= $fileName;
            file_put_contents($filePath, $logMessage);
        }

        self::viewErrorInternal();
        return true;
    }

    /**
     * Manipula erros PHP que ocorrem durante a execução do script.
     *
     * @param int $errno O código de erro.
     * @param string $errstr A mensagem de erro.
     * @param string $errfile O arquivo onde o erro ocorreu.
     * @param int $errline O número da linha onde o erro ocorreu.
     * @return bool
     */
    public static function errorHandler($errno, $errstr, $errfile, $errline) : bool
    {
        if (isset($_ENV['DEBUG']) && $_ENV['DEBUG']) {
            echo "Error: [$errno] $errstr in $errfile on line $errline";
            return false;
        }

        $logMessage = "Error: [$errno] $errstr in $errfile on line $errline";
    
        $fileName = 'general_error_';
        $fileName .= base64_encode($errno);
        $fileName .= '.log';
        
        $filePath = __DIR__;

        if (isset($_ENV['PATH_LOGS']) && !empty($_ENV['PATH_LOGS'])) {
            $filePath .= $_ENV['PATH_LOGS'];
        } else {
            $filePath .= DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR;
        }

        if (file_exists($filePath) && is_readable($filePath)) {
            $filePath .= $fileName;
            file_put_contents($filePath, $logMessage);
        }

        self::viewErrorInternal();
        return true;
    }
}