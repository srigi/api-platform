<?php declare(strict_types = 1);

namespace App\Domain\Book;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{

    /**
     * @Route("/api/v1/book")
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
