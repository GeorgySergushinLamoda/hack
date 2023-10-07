<?php

namespace App\Entity;

use App\Repository\ActionStatusRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActionStatusRepository::class)]
class ActionStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'actionStatuses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Action $action = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $actorId = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $status = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $progress = null;

    #[ORM\Column(nullable: true)]
    private ?int $value = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAction(): ?Action
    {
        return $this->action;
    }

    public function setAction(?Action $action): static
    {
        $this->action = $action;

        return $this;
    }

    public function getActorId(): ?string
    {
        return $this->actorId;
    }

    public function setActorId(?string $actorId): void
    {
        $this->actorId = $actorId;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getProgress(): ?int
    {
        return $this->progress;
    }

    public function setProgress(?int $progress): static
    {
        $this->progress = $progress;

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(?int $value): static
    {
        $this->value = $value;

        return $this;
    }
}
