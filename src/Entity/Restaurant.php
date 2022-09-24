<?php

namespace App\Entity;


use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantRepository::class)]
#[Vich\Uploadable]
class Restaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    #[ORM\Column(nullable: true)]
    private ?int $note = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $tel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $website = null;

    #[ORM\Column(length: 255)]
    private ?string $cover = null;

    #[Vich\UploadableField(mapping: 'projects', fileNameProperty: 'cover')]
    #[Assert\Image(mimeTypesMessage: 'Ceci n\'est pas une image')]
    #[Assert\File(
        maxSize: '3M',
        maxSizeMessage: 'Cette image ne doit pas dépasser les {{ limit }} {{ suffix }}',
    )]
    #[ORM\Column(length: 255)]
    private ?string $coverfile = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $update_at = null;

    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: Advise::class)]
    private Collection $advises;

    public function __construct()
    {
        $this->advises = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

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

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getCoverfile(): ?string
    {
        return $this->coverfile;
    }

    public function setCoverfile(string $coverfile): self
    {
        $this->coverfile = $coverfile;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->update_at;
    }

    public function setUpdateAt(\DateTimeImmutable $update_at): self
    {
        $this->update_at = $update_at;

        return $this;
    }

    /**
     * @return Collection<int, Advise>
     */
    public function getAdvises(): Collection
    {
        return $this->advises;
    }

    public function addAdvise(Advise $advise): self
    {
        if (!$this->advises->contains($advise)) {
            $this->advises->add($advise);
            $advise->setRestaurant($this);
        }

        return $this;
    }

    public function removeAdvise(Advise $advise): self
    {
        if ($this->advises->removeElement($advise)) {
            // set the owning side to null (unless already changed)
            if ($advise->getRestaurant() === $this) {
                $advise->setRestaurant(null);
            }
        }

        return $this;
    }
}
