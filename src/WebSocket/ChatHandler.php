<?php

namespace App\WebSocket;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class ChatHandler implements MessageComponentInterface
{
    protected $clients;
    protected $users;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->users = [];
    }

    public function onOpen(ConnectionInterface $conn)
    {

        $this->clients->attach($conn);
        
        //ajout d 'utilisateur à la liste
        $userId =$conn->ressourceId;
        $this->users[$userId]=['id'=>$userId, 'name'=>"user $userId"];

        //Envoi d'utilisateur à la liste
        foreach ($this->clients as $client){
            $client->send(json_encode([
                'type'=>'user_list',
                'users'=>array_values($this->users),
            ]));
        }

        $conn->send(json_encode(['type' => 'info', 'message' => 'Welcome to the chat..!!!']));
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true);
        // store user ID an message
        if (isset($data['user_id']) && isset($data['message'])) {
            $userId = $data['user_id'];
            $message = $data['message'];


            foreach ($this->clients as $client) {
                if ($client !== $from) {
                    $client->send(json_encode(['user_id' => $userId, 'message' => $message]));
                }
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        // Remove the connection
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

$server = IoServer::factory(
    new HttpServer(
        new WsServer(new ChatHandler())
    ),
    8080
);

$server->run();