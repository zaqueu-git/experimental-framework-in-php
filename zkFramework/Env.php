<?php

namespace zkFramework;

/**
 * Classe de gerenciamento.
 */
class Env
{
    /**
     * Carrega as variáveis necessárias.
     *
     * @return boolean
     */    
    private static function load() : bool
    {
        $filePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '.env';

        if (!file_exists($filePath) || !is_readable($filePath)) {
            return false;
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($lines as $line) {
            // Ignora comentários
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            // Divide em chave e valor
            list($name, $value) = explode('=', $line, 2);

            $name = trim($name);
            $value = trim($value);

            // Não substitui valor existente
            if (!array_key_exists($name, $_ENV)) {
                switch ($value) {
                    case 'true':
                        $_ENV[$name] = true;
                        break;
                    case 'false':
                        $_ENV[$name] = false;
                        break;                    
                    default:
                        $_ENV[$name] = $value;
                        break;
                }
            }
        }

        return true;
    }

    /**
     * Gerencia a lógica das operações da classe.
     *
     * @return void
     */    
    public static function operations() : void
    {
        self::load();
    }
}