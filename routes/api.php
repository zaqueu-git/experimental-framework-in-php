<?php

use Api\Controllers\DemoApiController;
use Api\Controllers\ExampleApiController;
use zkFramework\Router;

Router::addGet("/api", "index", DemoApiController::class);

Router::addGroup("api", ExampleApiController::class, function() {
    Router::addGet("/api/create", "create");
    Router::addGet("/api/read/{id}", "read");
    Router::addGet("/api/alter/{id}", "alter");
    Router::addGet("/api/remove/{id}", "remove");
});