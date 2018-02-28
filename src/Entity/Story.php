<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Story
 *
 * @ORM\Table(name="story", indexes={@ORM\Index(name="idDeveloper", columns={"idDeveloper"}), @ORM\Index(name="idProject", columns={"idProject"})})
 * @ORM\Entity
 */
class Story
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=10, nullable=false)
     */
    private $code;

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @var string|null
     *
     * @ORM\Column(name="descriptif", type="text", length=65535, nullable=true)
     */
    private $descriptif;

    /**
     * @param null|string $descriptif
     */
    public function setDescriptif(?string $descriptif): void
    {
        $this->descriptif = $descriptif;
    }

    /**
     * @return null|string
     */
    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    /**
     * @var string|null
     *
     * @ORM\Column(name="tags", type="text", length=65535, nullable=true)
     */
    private $tags;

    /**
     * @param null|string $tags
     */
    public function setTags(?string $tags): void
    {
        $this->tags = $tags;
    }

    /**
     * @return null|string
     */
    public function getTags(): ?string
    {
        return $this->tags;
    }

    /**
     * @var string|null
     *
     * @ORM\Column(name="step", type="string", length=50, nullable=true)
     */
    private $step;

    /**
     * @param null|string $step
     */
    public function setStep(?string $step): void
    {
        $this->step = $step;
    }

    /**
     * @return null|string
     */
    public function getStep(): ?string
    {
        return $this->step;
    }

    /**
     * @var \Developer
     *
     * @ORM\ManyToOne(targetEntity="Developer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idDeveloper", referencedColumnName="id")
     * })
     */
    private $developer;

    /**
     * @param \Developer $developer
     */
    public function setDeveloper(\Developer $developer): void
    {
        $this->developer = $developer;
    }

    /**
     * @return \Developer
     */
    public function getDeveloper(): \Developer
    {
        return $this->developer;
    }

    /**
     * @var \Project
     *
     * @ORM\ManyToOne(targetEntity="Project")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idProject", referencedColumnName="id")
     * })
     */
    private $project;

    /**
     * @param \Project $project
     */
    public function setProject(\Project $project): void
    {
        $this->project = $project;
    }

    /**
     * @return \Project
     */
    public function getProject(): \Project
    {
        return $this->project;
    }


}
