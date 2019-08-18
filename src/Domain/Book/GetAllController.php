<?php declare(strict_types = 1);

namespace App\Domain\Book;

class GetAllController
{

    public function __invoke(): array
    {
        return [
            new Book('Beyond Nette framework 3', '978-3-16-148410-0'),
            new Book('Understanding Nette framework 3', '978-1-23-456789-7'),
        ];
    }

}
