<?php declare(strict_types = 1);

namespace App\Domain\Book;

class PostController
{

    public function __invoke(Book $data): Book
    {
        return $data;
    }

}
