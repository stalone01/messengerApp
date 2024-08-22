<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class ConnexionController extends AbstractController
{
    #[Route('/login', name: 'app_login', methods: ['GET'])]
    public function index(){
        return $this->render('connexion/index.html.twig', []);
    }
    
    #[Route('/login-users', name: 'login-users', methods: ['POST'])]
    public function login(Request $request, UserPasswordHasherInterface $passwordHasher, UserProviderInterface $userProvider): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';

        // Récupérer l'utilisateur
        $user = $userProvider->loadUserByIdentifier($username);

        if ($user && $passwordHasher->isPasswordValid($user, $password)) {
            // Générer un jeton JWT ici si nécessaire et le retourner dans la réponse
            return new JsonResponse(['message' => 'Login successful', 'token' => 'votre_jwt_token'], 200);
        }

        return new JsonResponse(['message' => 'Invalid credentials'], 401);
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(): void
    {
        // Symfony gère automatiquement la déconnexion si configuré correctement
    }
}