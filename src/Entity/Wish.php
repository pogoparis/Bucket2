<?php

namespace App\Entity;

use App\Repository\WishRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: WishRepository::class)]
class Wish
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('wishes:read')]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Groups('wishes:read')]
    private ?string $description = null;

    #[ORM\Column(length: 50)]
    #[Groups('wishes:read')]
    private ?string $author = null;

    #[ORM\Column]
    #[Groups('wishes:read')]
    private ?bool $isPublished = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreated = null;

    #[ORM\ManyToOne(inversedBy: 'wish')]
    private ?Category $category = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isRealised = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function isIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): static
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): static
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function isIsRealised(): ?bool
    {
        return $this->isRealised;
    }

    public function setIsRealised(?bool $isRealised): static
    {
        $this->isRealised = $isRealised;

        return $this;
    }

    public function __serialize(): array
    {
     return [
       'id' => $this->id,
       'title' => $this->title,
       'description' => $this->description
     ];
         }

    public function __unserialize(array $data): void
    {
          $this->id = $data['id'];
            $this->title = $data['title'];
            $this->description = $data['description'];
    }


}
