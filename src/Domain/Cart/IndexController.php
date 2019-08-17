<?php declare(strict_types = 1);

namespace App\Domain\Cart;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{

    /**
     * @Route("/api/v1/cart")
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new JsonResponse([
            'status' => 'OK!',
        ]);
    }

}
