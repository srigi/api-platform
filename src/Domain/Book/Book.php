<?php declare(strict_types = 1);

namespace App\Domain\Book;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *      collectionOperations={
 *          "get"={
 *              "method"="GET",
 *              "controller"="App\Domain\Book\GetAllController"
 *          },
 *          "post"={
 *              "method"="POST",
 *              "controller"="App\Domain\Book\PostController"
 *          },
 *      },
 * )
 */
class Book
{

    /**
     * @ApiProperty(identifier=true)
     * @Assert\NotBlank()
     * @var int
     */
    public $id;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $title;

    /**
     * @Assert\NotBlank()
     * @Assert\Isbn()
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
