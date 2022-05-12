<?php

namespace App\Entity;

use App\Repository\PFERepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PFERepository::class)]
class PFE
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $title;

    #[ORM\Column(type: 'string', length: 50)]
    private $studentName;

    #[ORM\ManyToOne(targetEntity: Enterprise::class, inversedBy: 'pfes')]
    private $enterprise;



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

    public function getStudentName(): ?string
    {
        return $this->studentName;
    }

    public function setStudentName(string $studentName): self
    {
        $this->studentName = $studentName;

        return $this;
    }

    public function getEnterprise(): ?Enterprise
    {
        return $this->enterprise;
    }

    public function setEnterprise(?Enterprise $enterprise): self
    {
        $this->enterprise = $enterprise;

        return $this;

    }



}
