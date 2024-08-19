<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Message;
use App\Form\ChatFormType;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChatController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    #[IsGranted('ROLE_USER')]
    public function index(UserRepository $repo): Response
    {
        $users = $repo->findAll();

        return $this->render('chat/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/chat', name: 'send_chat', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function sendMessage(Request $request, EntityManagerInterface $entityManager, Message $message)
    {
        $message = new Message($request);
        $form = $this->createForm(ChatFormType::class, $message);
        $form->handleRequest($request);

        $entityManager->persist($message);
        $entityManager->flush();

        return $this->redirectToRoute('app_chat');
    }

    #[Route('/chat/messages', name: 'app_chat', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function showMessage(MessageRepository $repos, UserRepository $repo)
    {
        $users = $repo->findAll();
        $message = $repos->findAll();

        return $this->render('chat/index.html.twig', [
            'message' => $message,
            'users' => $users,
        ]);
    }
}