<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app_registration', methods: ['GET'])]
    public function index()
    {
        return $this->render('registration/index.html.twig', []);
    }

    #[Route('/register', name: 'user_register', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        // Récupérer les données JSON de la requête
        $data = json_decode($request->getContent(), true);
        
        $username = $request->get('username');
        // $password = $request->get('password');

        // Vérifier si le nom d'utilisateur existe déjà
        $existingUser = $userRepository->findOneBy(['username' => $username]);
        if ($existingUser) {
            return new JsonResponse(['error' => 'Username already exists'], 500);
        } else {

            if (!$data || !isset($data['username'], $data['passwordFirst'])) {
                return new JsonResponse(['error' => 'Invalid JSON or missing username/password'], Response::HTTP_BAD_REQUEST);
            }

            $user = new User();
            $user->setUsername($data['username']);
            $hashedPassword = $passwordHasher->hashPassword($user, $data['passwordFirst']);
            $user->setPassword($hashedPassword);

            try {
                $entityManager->persist($user);
                $entityManager->flush();
            } catch (UniqueConstraintViolationException $e) {
                return new JsonResponse(['error' => 'Username already exists'], 500);
            }

            return new JsonResponse(['success' => 'User registered successfully'], 201);
        }

        return $this->redirectToRoute('app_login');
    }
}