<?php

namespace App\Entity;

use App\Repository\EnterpriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: EnterpriseRepository::class)]
class Enterprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $designation;

    #[ORM\OneToMany(mappedBy: 'enterprise', targetEntity: PFE::class)]
    private $pfes;

    public function __construct()
    {
        $this->pfes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;
        return $this;
    }

    /**
     * @return Collection<int, PFE>
     */
    public function getPfes(): Collection
    {
        return $this->pfes;
    }

    public function addPfe(PFE $pfe): self
    {
        if (!$this->pfes->contains($pfe)) {
            $this->pfes[] = $pfe;
            $pfe->setEnterprise($this);
        }

        return $this;
    }


    public function removePfe(PFE $pfe): self
    {
        if ($this->pfes->removeElement($pfe)) {
            // set the owning side to null (unless already changed)
            if ($pfe->getEnterprise() === $this) {
                $pfe->setEnterprise(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->designation;
    }

}
