<?php declare(strict_types = 1);

namespace App\Domain\Auth\User;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ProfileDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{

    /** @var TokenStorageInterface */
    private $tokenStorage;

    public function __construct(
        TokenStorageInterface $tokenStorage
    )
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): object
    {
        $token = $this->tokenStorage->getToken();
        if ($token === null || $token->getUser() === 'anon.') {
            return new User('guest@api-platform.test', $id);
        }

        return $token->getUser();
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        if ($resourceClass !== User::class) {
            return false;
        }

        if ($operationName !== ProfileController::PROFILE_OPERATION_NAME) {
            return false;
        }

        return true;
    }
}
