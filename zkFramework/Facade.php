<?php

namespace zkFramework;

/**
 * Classe de interface simplificada para operações do sistema.
 */
class Facade
{
    private Log $log;
    private Env $env;
    private Ini $ini;
    private Header $header;
    private TimeZone $timezone;
    private Session $session;
    private Request $request;
    private Debugger $debugger;

    public function __construct()
    {
        $this->log = new Log();
        $this->env = new Env();
        $this->ini = new Ini();
        $this->header = new Header();
        $this->timezone = new TimeZone();
        $this->session = new Session();
        $this->request = new Request();
        $this->debugger = new Debugger();
    }

    public function run() : void
    {
        set_error_handler(function ($errno, $errstr, $errfile, $errline) {
            $this->log::errorHandler($errno, $errstr, $errfile, $errline);
        });

        try {
            $this->env::operations();
            $this->ini::operations();
            $this->header::operations();
            $this->timezone::operations();
            $this->session::operations();
            $this->request::operations();
            $this->debugger::operations();
        } catch (\Throwable $th) {
            $this->log::throwable($th);
        }
    }
}