<?php

namespace zkFramework;

/**
 * Classe de gerenciamento.
 */
class Ini
{
    /**
     * Carrega as variáveis necessárias.
     *
     * @return void
     */
    private static function load() : void
    {
        if (isset($_ENV['DEBUG']) && $_ENV['DEBUG']) {
            $defaults = [
                'log_errors' => 0,
                'error_log' => '',
                'display_errors' => 1,
                'display_startup_errors' => 1,
                'error_reporting' => E_ALL,
            ];
        } else {
            $defaults = [
                'log_errors' => 0,
                'error_log' => '',
                'display_errors' => 0,
                'display_startup_errors' => 0,
                'error_reporting' => 0,
            ];
        }

        // Habilita o registro padrão de erros do php
        ini_set('log_errors', $defaults['log_errors']);

        // Habilita o caminho padrão de erros do php
        ini_set('error_log', $defaults['error_log']);

        // Exibição dos erros
        ini_set('display_errors', $defaults['display_errors']);

        // Exibição dos erros de inicialização
        ini_set('display_startup_errors', $defaults['display_startup_errors']);

        // Define o nível de relatório de erros
        error_reporting($defaults['error_reporting']);
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