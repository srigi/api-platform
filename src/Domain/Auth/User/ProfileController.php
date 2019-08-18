<?php declare(strict_types = 1);

namespace App\Domain\Auth\User;

use Symfony\Component\Routing\Annotation\Route;

class ProfileController
{

    public const PROFILE_OPERATION_NAME = 'profile';
    public const PROFILE_ROUTE_NAME = 'api_user_profile';

    /**
     * @Route(
     *     path="/api/v1/me",
     *     methods={"GET"},
     *     name=ProfileController::PROFILE_ROUTE_NAME,
     *     defaults={
     *         "_api_item_operation_name"=ProfileController::PROFILE_OPERATION_NAME,
     *         "_api_resource_class"=User::class,
     *     }
     * )
     * @param User $data
     *
     * @return User
     */
    public function __invoke(User $data): User
    {
        return $data;
    }

}
