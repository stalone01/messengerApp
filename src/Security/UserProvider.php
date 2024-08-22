<?php

namespace App\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserProvider implements UserProviderInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Charge un utilisateur par son identifiant (nom d'utilisateur ou email).
     *
     * @param string $identifier
     * @return UserInterface
     * @throws UsernameNotFoundException
     */
    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        // Rechercher l'utilisateur dans la base de données par son nom d'utilisateur ou email
        $user = $this->entityManager->getRepository(User::class)->findOneBy([
            'username' => $identifier
        ]);

        // Vous pouvez également rechercher par email si nécessaire

        if (!$user) {
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $identifier));
        }

        return $user;
    }

    /**
     * Recherchez un utilisateur par son identifiant (nom d'utilisateur ou email).
     *
     * @param string $identifier
     * @return UserInterface
     */
    public function loadUserByUsername(string $username): UserInterface
    {
        return $this->loadUserByIdentifier($username);
    }

    /**
     * Recherchez un utilisateur par son identifiant (nom d'utilisateur ou email).
     *
     * @param string $identifier
     * @return UserInterface
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        $updatedUser = $this->entityManager->getRepository(User::class)->find($user->getId());

        if (!$updatedUser) {
            throw new UsernameNotFoundException(sprintf('User "%d" not found.', $user->getId()));
        }

        return $updatedUser;
    }

    /**
     * Vérifie si l'utilisateur est pris en charge par ce fournisseur.
     *
     * @param UserInterface $user
     * @return bool
     */
    public function supportsClass(string $class): bool
    {
        return User::class === $class || is_subclass_of($class, User::class);
    }
}