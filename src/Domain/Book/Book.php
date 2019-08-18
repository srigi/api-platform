<?php declare(strict_types = 1);

namespace App\Domain\Book;

use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

class Book
{

    /**
     * @ApiProperty(identifier=true)
     * @Assert\NotBlank()
     * @Groups({"read"})
     * @var int
     */
    public $id;

    /**
     * @Assert\NotBlank()
     * @Groups({"read", "write"})
     * @var string
     */
    public $title;

    /**
     * @Assert\NotBlank()
     * @Assert\Isbn()
     * @Groups({"read", "write"})
     * @var string
     */
    public $isbn;

    public function __construct(string $title, string $isbn)
    {
        $this->id = random_int(1, 1000);
        $this->title = $title;
        $this->isbn = $isbn;
    }

}
