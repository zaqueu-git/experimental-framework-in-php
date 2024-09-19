<?php

namespace zkFramework;

/**
 * Classe de gerenciamento.
 */
class TimeZone
{
    /**
     * Carrega as variáveis necessárias.
     *
     * @return void
     */
    private static function load() : void
    {
        if (isset($_ENV['TIMEZONE']) && !empty($_ENV['TIMEZONE'])) {
            date_default_timezone_set($_ENV['TIMEZONE']);
        } else {
            date_default_timezone_set('America/Sao_Paulo');
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