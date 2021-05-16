<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CityRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"city:read"}},
 *     denormalizationContext={"groups"={"city:write"}}
 * )
 */
class City
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({ "city:read", "land:read" })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"city:read", "city:write", "land:read", "land:write"})
     */
    private $title;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"city:read", "city:write"})
     */
    private $width;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"city:read", "city:write"})
     */
    private $height;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"city:read", "city:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     * @Groups({"city:read", "city:write"})
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Land::class, inversedBy="cities")
     * @Groups({"city:read", "city:write"})
     */
    private $land;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getLand(): ?Land
    {
        return $this->land;
    }

    public function setLand(?Land $land): self
    {
        $this->land = $land;

        return $this;
    }
}
