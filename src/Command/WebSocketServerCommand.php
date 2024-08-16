<?php
namespace App\Command;

use App\WebSocket\ChatHandler;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Factory as LoopFactory;
use React\Socket\Server as ReactServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WebSocketServerCommand extends Command
{
    protected static $defaultName = 'app:websocket-server';

    protected function configure() {
        $this->setDescription('Starts the WebSocket server');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $loop = LoopFactory::create();
    
        try {
            $webSocket = new WsServer(new ChatHandler());
            $http = new HttpServer($webSocket);
            $server = new IoServer($http, new ReactServer('127.0.0.1:8080', $loop), $loop);
    
            $output->writeln('WebSocket server started on ws://127.0.0.1:8080');
            $loop->run();
    
        } catch (\Exception $e) {
            $output->writeln('Error: ' . $e->getMessage());
            return Command::FAILURE;
        }
    
        return Command::SUCCESS;
    }
    
}