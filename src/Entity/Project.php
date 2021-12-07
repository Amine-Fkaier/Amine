<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(type="date")
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $state;

    /**
     * @ORM\OneToMany(targetEntity=Task::class, mappedBy="project")
     */
    private $listTasks;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $chef;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="project")
     */
    private $listMembers;

    public function __construct()
    {
        $this->listTasks = new ArrayCollection();
        $this->listMembers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return Collection|Task[]
     */
    public function getListTasks(): Collection
    {
        return $this->listTasks;
    }

    public function addListTask(Task $listTask): self
    {
        if (!$this->listTasks->contains($listTask)) {
            $this->listTasks[] = $listTask;
            $listTask->setProject($this);
        }

        return $this;
    }

    public function removeListTask(Task $listTask): self
    {
        if ($this->listTasks->removeElement($listTask)) {
            // set the owning side to null (unless already changed)
            if ($listTask->getProject() === $this) {
                $listTask->setProject(null);
            }
        }

        return $this;
    }

    public function getChef(): ?User
    {
        return $this->chef;
    }

    public function setChef(?User $chef): self
    {
        $this->chef = $chef;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getListMembers(): Collection
    {
        return $this->listMembers;
    }

    public function addListMember(User $listMember): self
    {
        if (!$this->listMembers->contains($listMember)) {
            $this->listMembers[] = $listMember;
            $listMember->setProject($this);
        }

        return $this;
    }

    public function removeListMember(User $listMember): self
    {
        if ($this->listMembers->removeElement($listMember)) {
            // set the owning side to null (unless already changed)
            if ($listMember->getProject() === $this) {
                $listMember->setProject(null);
            }
        }

        return $this;
    }
}
