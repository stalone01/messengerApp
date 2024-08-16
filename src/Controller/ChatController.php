<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ChatController extends AbstractController
{
    #[Route('/chat', name: 'app_chat')]
    #[IsGranted('ROLE_USER')]
    public function index(UserRepository $repo): Response
    {
        $users = $repo->findAll();

        return $this->render('chat/index.html.twig', [
            'users' => $users,
        ]);
    }
}