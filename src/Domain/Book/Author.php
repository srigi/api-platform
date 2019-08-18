<?php declare(strict_types = 1);

namespace App\Domain\Book;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 */
class Author
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
    public $name;

    /**
     * @ORM\OneToMany(targetEntity=Book::class, mappedBy="author")
     * @var Book[]|ArrayCollection
     */
    public $books;

    public function __construct(string $name)
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->books = new ArrayCollection();
    }

}
