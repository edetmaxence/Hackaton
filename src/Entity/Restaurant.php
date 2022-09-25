<?php

namespace App\Entity;


use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Symfony\Component\Validator\Constraints as Assert;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: RestaurantRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Restaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $adress = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $tel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $website = null;

    // #[ORM\Column(length: 255, nullable: true)]
    // private ?string $cover = null;


    // #[Vich\UploadableField(mapping: 'products', fileNameProperty: 'cover')]
    // #[Assert\Image(mimeTypesMessage: 'Ceci n\'est pas une image')]
    // #[Assert\File(
    //     maxSize: '3M',
    //     maxSizeMessage: 'Cette image ne doit pas dépasser les {{ limit }} {{ suffix }}',
    // )]
    // #[ORM\Column(length: 255, nullable: true)]
    // private ?File $coverfile = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $updated_at = null;


    // #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: Advise::class)]
    // private Collection $advises;




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

    // public function getCover(): ?string
    // {
    //     return $this->cover;
    // }

    // public function setCover(string $cover): self
    // {
    //     $this->cover = $cover;

    //     return $this;
    // }

    // public function getCoverfile(): ?File
    // {
    //     return $this->coverfile;
    // }

    // public function setCoverfile(string $coverfile): self
    // {
    //     $this->coverfile = $coverfile;

    //     return $this;
    // }

    // /**
    //  * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $coverFile
    //  */
    // public function setCoverFile(?File $coverFile = null): void
    // {
    //     $this->coverFile = $coverFile;

    //     if (null !== $coverFile) {
    //         // It is required that at least one field changes if you are using doctrine
    //         // otherwise the event listeners won't be called and the file is lost
    //         $this->setUpdatedAt(new \DateTimeImmutable);
    //     }
    // }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    #[ORM\PrePersist]
    public function updateTimestamps()
    {
        $this->setCreatedAt(new \DateTimeImmutable);
    }

    // /**
    //  * @return Collection<int, Advise>
    //  */
    // public function getAdvises(): Collection
    // {
    //     return $this->advises;
    // }

    // public function addAdvise(Advise $advise): self
    // {
    //     if (!$this->advises->contains($advise)) {
    //         $this->advises->add($advise);
    //         $advise->setRestaurant($this);
    //     }

    //     return $this;
    // }

    // public function removeAdvise(Advise $advise): self
    // {
    //     if ($this->advises->removeElement($advise)) {
    //         // set the owning side to null (unless already changed)
    //         if ($advise->getRestaurant() === $this) {
    //             $advise->setRestaurant(null);
    //         }
    //     }

    //     return $this;
    // }
}
