<?php

namespace zkFramework;

/**
 * Classe de gerenciamento.
 */
class Database
{
    /**
     * Cria uma nova instância de conexão PDO para um banco de dados MySQL.
     *
     * @param string $dbServer O endereço do servidor de banco de dados (por exemplo, 'localhost').
     * @param string $dbName O nome do banco de dados ao qual se conectar.
     * @param string $dbUser O nome de usuário para autenticação no banco de dados.
     * @param string $dbPassword A senha para autenticação no banco de dados.
     * @return \PDO Retorna uma instância da classe PDO configurada para conectar ao banco de dados MySQL.
     */    
    public static function mysql($dbServer, $dbName, $dbUser, $dbPassword) : \PDO
    {
        $dbDriver = "mysql:host=$dbServer;dbname=$dbName";

        $dbOptions = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
        ];

        return new \PDO($dbDriver, $dbUser, $dbPassword, $dbOptions);
    }
    
    /**
     * Função de placeholder para criar uma instância de conexão PDO para um banco de dados SQL Server.
     *
     * @param string $dbServer O endereço do servidor de banco de dados (por exemplo, 'localhost').
     * @param string $dbName O nome do banco de dados ao qual se conectar.
     * @param string $dbUser O nome de usuário para autenticação no banco de dados.
     * @param string $dbPassword A senha para autenticação no banco de dados.
     * @return void Esta função não está implementada.
     */    
    public static function sqlserver($dbServer, $dbName, $dbUser, $dbPassword) : void
    {
        // Placeholder para a função de conexão com SQL Server. A implementação deve ser adicionada aqui.
    }    
}