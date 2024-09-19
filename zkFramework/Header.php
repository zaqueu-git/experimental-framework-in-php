<?php

namespace zkFramework;

/**
 * Classe de gerenciamento.
 */
class Header
{
    /**
     * Carrega as variáveis necessárias.
     *
     * @return void
     */
    private static function load() : void
    {
        $defaults = [
            // Previne que o navegador adivinhe o tipo de conteúdo, ajudando a evitar vulnerabilidades
            'X-Content-Type-Options: nosniff',

            // Impede que a página seja exibida em frames de outros sites, ajudando a prevenir Clickjacking
            'X-Frame-Options: SAMEORIGIN',

            // Ativa a proteção contra XSS e bloqueia a página se um ataque for detectado
            'X-XSS-Protection: 1; mode=block',

            // Não envia informações de referência em solicitações, protegendo a privacidade do usuário
            'Referrer-Policy: no-referrer',

            // Permite acesso à geolocalização apenas ao próprio domínio e desativa o acesso ao microfone
            'Permissions-Policy: geolocation=(self), microphone=()',
        ];

        foreach ($defaults as $header) {
            header($header);
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