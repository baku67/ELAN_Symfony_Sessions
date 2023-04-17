<?php

namespace App\Entity;

use App\Repository\TrainingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainingRepository::class)]
class Training
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'training', targetEntity: Session::class, orphanRemoval: true)]
    private Collection $sessions;



    /**
     * #NotMapped
     */
    private ?int $sessionCount = null;
    // private $closedSessions;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, Session>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }


    public function getincomingSessionCount() {
        $allSessions = $this->sessions;
        $count = 0;
        foreach ($allSessions as $session) {
            if ($session->getBeginDate() > date("Y-m-d"))  {
                $count++;
            }
        }
        return $count;
    }


    public function getongoingSessionCount() {
        $allSessions = $this->getSessions();
        $count = 0;
        foreach ($allSessions as $session) {
            if ( ($session->getBeginDate() < date("Y-m-d H:i:s")) && ($session->getEndDate() > date("Y-m-d H:i:s")) ) {
                $count++;
            }
        }
        return $count;
    }


    public function getclosedSessionCount() {
        $allSessions = $this->getSessions();
        $count = 0;
        foreach ($allSessions as $session) {
            if ($session->getEndDate() < date("Y-m-d H:i:s") ) {
                $count++;
            }
        }
        return $count;
    }



    public function getSessionCount() {
        if ($this->sessionCount === null) {
            $this->sessionCount = $this->sessions->count();
        }
        return $this->sessionCount;
    }


    public function addSession(Session $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions->add($session);
            $session->setTraining($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getTraining() === $this) {
                $session->setTraining(null);
            }
        }

        return $this;
    }


    public function __toString(): string
    {
        return $this->getTitle();
    }
}
