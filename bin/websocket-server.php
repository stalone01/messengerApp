#!/usr/bin/env php
<?php
require __DIR__ . '/../vendor/autoload.php';

use Ratchet\Server\IoServer;
use App\WebSocket\ChatHandler;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new ChatHandler()
        )
    ),
    8080
);

$server->run();