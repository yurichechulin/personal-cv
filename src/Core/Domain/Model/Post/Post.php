<?php

namespace App\Core\Domain\Model\Post;
use App\Shared\Domain\Model\EntityInterface;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 */
class Post implements EntityInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid")
     */
    private string $uuid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="text")
     */
    private string $description;

    /**
     * @ORM\Column(type="datetime_immutable", options={"default"="CURRENT_TIMESTAMP"}, nullable=false)
     */
    private DateTimeImmutable $created_at;

    /**
     * Post constructor.
     * @param string $name
     * @param string $description
     */
    public function __construct(string $name, string $description)
    {
        $this->setUuid(Uuid::uuid4());
        $this->setName($name);
        $this->setDescription($description);
        $this->setCreatedAt(new DateTimeImmutable());
    }

    /**
     * @param string $name
     */
    public function changeName(string $name): void
    {
        $this->setName($name);
    }

    /**
     * @param string $description
     */
    public function changeDescription(string $description): void
    {
        $this->setDescription($description);
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->created_at;
    }

    /**
     * @param string $name
     */
    private function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $description
     */
    private function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param string $uuid
     */
    private function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @param DateTimeImmutable $created_at
     */
    private function setCreatedAt(DateTimeImmutable $created_at): void
    {
        $this->created_at = $created_at;
    }
}