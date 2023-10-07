<?php

namespace App\Entity;

use App\Repository\ActionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\AccessType;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

#[ORM\Entity(repositoryClass: ActionRepository::class)]
class Action
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Type("integer")]
    public ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Type("string")]
    #[Expose]
    private ?string $shortDescription = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $fullDescription = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $startDate = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $finishDate = null;

    #[ORM\Column]
    private ?bool $visible = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $actionText = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $link = null;

    #[ORM\Column(nullable: true)]
    private ?int $goal = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $processor = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $steps = null;

    #[ORM\OneToMany(mappedBy: 'action', targetEntity: ActionStatus::class)]
    private Collection $actionStatuses;

    public function __construct()
    {
        $this->actionStatuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): static
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getFullDescription(): ?string
    {
        return $this->fullDescription;
    }

    public function setFullDescription(?string $fullDescription): static
    {
        $this->fullDescription = $fullDescription;

        return $this;
    }

    public function getStartDate(): ?\DateTimeImmutable
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeImmutable $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getFinishDate(): ?\DateTimeImmutable
    {
        return $this->finishDate;
    }

    public function setFinishDate(?\DateTimeImmutable $finishDate): static
    {
        $this->finishDate = $finishDate;

        return $this;
    }

    public function isVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): static
    {
        $this->visible = $visible;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getActionText(): ?string
    {
        return $this->actionText;
    }

    public function setActionText(string $actionText): static
    {
        $this->actionText = $actionText;

        return $this;
    }

    public function getlink(): ?string
    {
        return $this->link;
    }

    public function setlink(?string $link): static
    {
        $this->link = $link;

        return $this;
    }

    public function getGoal(): ?int
    {
        return $this->goal;
    }

    public function setGoal(?int $goal): static
    {
        $this->goal = $goal;

        return $this;
    }

    public function getProcessor(): ?string
    {
        return $this->processor;
    }

    public function setProcessor(string $processor): static
    {
        $this->processor = $processor;

        return $this;
    }

    public function getSteps(): ?string
    {
        return $this->steps;
    }

    public function setSteps(?string $steps): void
    {
        $this->steps = $steps;
    }

    /**
     * @return Collection<int, ActionStatus>
     */
    public function getActionStatuses(): Collection
    {
        return $this->actionStatuses;
    }

    public function addActionStatus(ActionStatus $actionStatus): static
    {
        if (!$this->actionStatuses->contains($actionStatus)) {
            $this->actionStatuses->add($actionStatus);
            $actionStatus->setAction($this);
        }

        return $this;
    }

    public function removeActionStatus(ActionStatus $actionStatus): static
    {
        if ($this->actionStatuses->removeElement($actionStatus)) {
            // set the owning side to null (unless already changed)
            if ($actionStatus->getAction() === $this) {
                $actionStatus->setAction(null);
            }
        }

        return $this;
    }
}
