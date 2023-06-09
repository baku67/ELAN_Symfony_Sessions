<?php

namespace App\Entity;

use App\Repository\TraineeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TraineeRepository::class)]
class Trainee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $firstName = null;

    #[ORM\Column(length: 100)]
    private ?string $lastName = null;

    #[ORM\Column(length: 100)]
    private ?string $ville = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $birth_date = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $tel = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $gender = null;

    // #[ORM\Column(type: Types::DATETIME_MUTABLE, options:['default' => 'CURRENT_TIMESTAMP'])]
    // private ?\DateTimeInterface $creation_date = null;

    #[ORM\ManyToMany(targetEntity: Session::class, inversedBy: 'trainees')]
    private Collection $sessions;

    #[ORM\OneToMany(mappedBy: 'trainee', targetEntity: TraineeSession::class, orphanRemoval: true)]
    private Collection $traineeSessions;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
        $this->traineeSessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }



    public function getAge() {
        
    }

    // public function getCreationDate(): ?\DateTimeInterface
    // {
    //     return $this->creation_date;
    // }

    // public function setCreationDate(\DateTimeInterface $creation_date): self
    // {
    //     $this->creation_date = $creation_date;

    //     return $this;
    // }



    /**
     * @return Collection<int, Session>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions->add($session);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        $this->sessions->removeElement($session);

        return $this;
    }



    public function __toString(): string 
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    /**
     * @return Collection<int, TraineeSession>
     */
    public function getTraineeSessions(): Collection
    {
        return $this->traineeSessions;
    }

    public function addTraineeSession(TraineeSession $traineeSession): self
    {
        if (!$this->traineeSessions->contains($traineeSession)) {
            $this->traineeSessions->add($traineeSession);
            $traineeSession->setTrainee($this);
        }

        return $this;
    }

    public function removeTraineeSession(TraineeSession $traineeSession): self
    {
        if ($this->traineeSessions->removeElement($traineeSession)) {
            // set the owning side to null (unless already changed)
            if ($traineeSession->getTrainee() === $this) {
                $traineeSession->setTrainee(null);
            }
        }

        return $this;
    }

}
