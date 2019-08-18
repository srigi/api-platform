<?php declare(strict_types = 1);

namespace App\Domain\Book;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 */
class Book
{

    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid")
     * @Assert\NotBlank()
     * @Assert\Uuid()
     * @Groups({"read"})
     * @var UuidInterface
     */
    public $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Groups({"read", "write"})
     * @var string
     */
    public $title;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Isbn()
     * @Groups({"read", "write"})
     * @var string
     */
    public $isbn;

    public function __construct(string $title, string $isbn)
    {
        $this->id = Uuid::uuid4();
        $this->title = $title;
        $this->isbn = $isbn;
    }

}
