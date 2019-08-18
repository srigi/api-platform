<?php declare(strict_types = 1);

namespace App\Domain\Auth\User;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Table(
 *     name="`user`",
 * )
 * @ORM\Entity()
 */
class User
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
     * @Assert\Email()
     * @Groups({"read", "write"})
     * @var string
     */
    public $username;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({"read"})
     * @var DateTimeImmutable|null
     */
    public $lastLoginTime;

    public function __construct(string $username, ?UuidInterface $id = null)
    {
        $this->id = $id ?? Uuid::uuid4();
        $this->username = $username;
    }

}
