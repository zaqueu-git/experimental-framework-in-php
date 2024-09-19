<?php

namespace zkFramework;

/**
 * Classe de gerenciamento.
 */
class Session
{
    /**
     * Carrega as variáveis necessárias.
     *
     * @return void
     */
    private static function load() : void
    {
        session_start();

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['csrf_token']) || $_SESSION['csrf_token'] !== $_POST['csrf_token']) {
                throw new \Exception("Error Token CSRF");
            }
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
    }
}