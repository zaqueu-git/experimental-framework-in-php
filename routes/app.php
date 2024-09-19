<?php

use App\Controllers\DemoCrudController;
use App\Controllers\DemoHomeController;
use App\Controllers\ExampleCrudController;
use zkFramework\Router;

Router::addGet("/", "index", DemoHomeController::class);
Router::addGet("/crud", "index", DemoCrudController::class);

Router::addGroup("crud", ExampleCrudController::class, function() {
    Router::addGet("/crud/all", "all");
    
    Router::addGet("/crud/create", "create");
    Router::addPost("/crud/create", "create");

    Router::addGet("/crud/read/{id}", "read");
    Router::addGet("/crud/alter/{id}", "alter");
    Router::addGet("/crud/remove/{id}", "remove");
});