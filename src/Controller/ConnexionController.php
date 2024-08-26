<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class ConnexionController extends AbstractController
{
    #[Route('/login', name: 'app_login', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('connexion/index.html.twig', []);
    }
    
    #[Route('/login-users', name: 'login-users', methods: ['POST'])]
    public function login(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        UserProviderInterface $userProvider,
        JWTTokenManagerInterface $jwtManager
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';

        // Récupérer l'utilisateur
        $user = $userProvider->loadUserByIdentifier($username);

        if (!$user || !$passwordHasher->isPasswordValid($user, $password)) {
            throw new CustomUserMessageAuthenticationException('Invalid credentials.');
        }

        // Générer un jeton JWT ici
        $token = $jwtManager->create($user);

        // Répondre avec le token et un message de succès
        return new JsonResponse([
            'message' => 'Login successful',
            'token' => $token
        ], 200);
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(): void
    {
        // Symfony gère automatiquement la déconnexion si configuré correctement
    }
}