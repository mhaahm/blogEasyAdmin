<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @Vich\Uploadable
 * @UniqueEntity(
 *     fields={"libele"},
 *     errorPath="libele",
 *     message="L'article existe déjà en base"
 * )
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255,unique=true)
     */
    private $libele;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Regex("/\d+/")
     */
    private $quantite;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseur", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fournisseur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieArticle", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $uniteMesure;

    /**
     * @ORM\Column(type="float")
     *
     */
    private $prix;

    /**
     * @ORM\Column(type="string",length=255)
     * @var string
     */
     private $imageName;

     public function __construct() {
         $this->updatedAt = new \DateTime('now');
     }

    /**
     * @return string
     */
    public function getImageName(): string
    {
        return $this->imageName ? $this->imageName :'';
    }

    /**
     * @param string $imageName
     * @return Article
     */
    public function setImageName(string $imageName): Article
    {
        $this->imageName = $imageName;
        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt ;

    /**
     * @param File $imageFile
     * @return Article
     */
    public function setImageFile(?File $imageFile = null): Article
    {
        $this->imageFile = $imageFile;
        if($this->imageFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
    /**
     * @Vich\UploadableField(mapping="articles",fileNameProperty="imageName")
     * @Assert\Image(
     *     mimeTypes="image/jpeg",
     *     mimeTypesMessage="Il faut que l'image soit du jpeg"
     * )
     * @var File
     */
     private $imageFile;

    /**
     * @return mixed
     */
    public function getUniteMesure()
    {
        return $this->uniteMesure;
    }

    /**
     * @param mixed $uniteMasure
     */
    public function setUniteMesure($uniteMasure): void
    {
        $this->uniteMesure = $uniteMasure;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibele(): ?string
    {
        return $this->libele;
    }

    public function setLibele(string $libele): self
    {
        $this->libele = $libele;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

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

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function getCategorie(): ?CategorieArticle
    {
        return $this->categorie;
    }

    public function setCategorie(?CategorieArticle $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

}
