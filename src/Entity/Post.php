<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $abstract = null;

    #[ORM\Column(length: 100)]
    private ?string $image1 = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subtitle1 = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $image2 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subtitle2 = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $image3 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subtitle3 = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $image4 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subtitle4 = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $image5 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content5 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subtitle5 = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $image6 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content6 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subtitle6 = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $image7 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content7 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subtitle7 = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $image8 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content8 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subtitle8 = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $image9 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content9 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subtitle9 = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $image10 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content10 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subtitle10 = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?bool $isPublished = null;

    #[ORM\Column(length: 128)]
    private ?string $slug = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setAbstract(string $abstract): static
    {
        $this->abstract = $abstract;

        return $this;
    }

    public function getImage1(): ?string
    {
        return $this->image1;
    }

    public function setImage1(string $image1): static
    {
        $this->image1 = $image1;

        return $this;
    }

    public function getContent1(): ?string
    {
        return $this->content1;
    }

    public function setContent1(string $content1): static
    {
        $this->content1 = $content1;

        return $this;
    }

    public function getSubtitle1(): ?string
    {
        return $this->subtitle1;
    }

    public function setSubtitle1(?string $subtitle1): static
    {
        $this->subtitle1 = $subtitle1;

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->image2;
    }

    public function setImage2(?string $image2): static
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getContent2(): ?string
    {
        return $this->content2;
    }

    public function setContent2(?string $content2): static
    {
        $this->content2 = $content2;

        return $this;
    }

    public function getSubtitle2(): ?string
    {
        return $this->subtitle2;
    }

    public function setSubtitle2(?string $subtitle2): static
    {
        $this->subtitle2 = $subtitle2;

        return $this;
    }

    public function getImage3(): ?string
    {
        return $this->image3;
    }

    public function setImage3(?string $image3): static
    {
        $this->image3 = $image3;

        return $this;
    }

    public function getContent3(): ?string
    {
        return $this->content3;
    }

    public function setContent3(?string $content3): static
    {
        $this->content3 = $content3;

        return $this;
    }

    public function getSubtitle3(): ?string
    {
        return $this->subtitle3;
    }

    public function setSubtitle3(?string $subtitle3): static
    {
        $this->subtitle3 = $subtitle3;

        return $this;
    }

    public function getImage4(): ?string
    {
        return $this->image4;
    }

    public function setImage4(?string $image4): static
    {
        $this->image4 = $image4;

        return $this;
    }

    public function getContent4(): ?string
    {
        return $this->content4;
    }

    public function setContent4(?string $content4): static
    {
        $this->content4 = $content4;

        return $this;
    }

    public function getSubtitle4(): ?string
    {
        return $this->subtitle4;
    }

    public function setSubtitle4(?string $subtitle4): static
    {
        $this->subtitle4 = $subtitle4;

        return $this;
    }

    public function getImage5(): ?string
    {
        return $this->image5;
    }

    public function setImage5(?string $image5): static
    {
        $this->image5 = $image5;

        return $this;
    }

    public function getContent5(): ?string
    {
        return $this->content5;
    }

    public function setContent5(?string $content5): static
    {
        $this->content5 = $content5;

        return $this;
    }

    public function getSubtitle5(): ?string
    {
        return $this->subtitle5;
    }

    public function setSubtitle5(?string $subtitle5): static
    {
        $this->subtitle5 = $subtitle5;

        return $this;
    }

    public function getImage6(): ?string
    {
        return $this->image6;
    }

    public function setImage6(?string $image6): static
    {
        $this->image6 = $image6;

        return $this;
    }

    public function getContent6(): ?string
    {
        return $this->content6;
    }

    public function setContent6(?string $content6): static
    {
        $this->content6 = $content6;

        return $this;
    }

    public function getSubtitle6(): ?string
    {
        return $this->subtitle6;
    }

    public function setSubtitle6(?string $subtitle6): static
    {
        $this->subtitle6 = $subtitle6;

        return $this;
    }

    public function getImage7(): ?string
    {
        return $this->image7;
    }

    public function setImage7(?string $image7): static
    {
        $this->image7 = $image7;

        return $this;
    }

    public function getContent7(): ?string
    {
        return $this->content7;
    }

    public function setContent7(?string $content7): static
    {
        $this->content7 = $content7;

        return $this;
    }

    public function getSubtitle7(): ?string
    {
        return $this->subtitle7;
    }

    public function setSubtitle7(?string $subtitle7): static
    {
        $this->subtitle7 = $subtitle7;

        return $this;
    }

    public function getImage8(): ?string
    {
        return $this->image8;
    }

    public function setImage8(?string $image8): static
    {
        $this->image8 = $image8;

        return $this;
    }

    public function getContent8(): ?string
    {
        return $this->content8;
    }

    public function setContent8(?string $content8): static
    {
        $this->content8 = $content8;

        return $this;
    }

    public function getSubtitle8(): ?string
    {
        return $this->subtitle8;
    }

    public function setSubtitle8(?string $subtitle8): static
    {
        $this->subtitle8 = $subtitle8;

        return $this;
    }

    public function getImage9(): ?string
    {
        return $this->image9;
    }

    public function setImage9(?string $image9): static
    {
        $this->image9 = $image9;

        return $this;
    }

    public function getContent9(): ?string
    {
        return $this->content9;
    }

    public function setContent9(?string $content9): static
    {
        $this->content9 = $content9;

        return $this;
    }

    public function getSubtitle9(): ?string
    {
        return $this->subtitle9;
    }

    public function setSubtitle9(?string $subtitle9): static
    {
        $this->subtitle9 = $subtitle9;

        return $this;
    }

    public function getImage10(): ?string
    {
        return $this->image10;
    }

    public function setImage10(?string $image10): static
    {
        $this->image10 = $image10;

        return $this;
    }

    public function getContent10(): ?string
    {
        return $this->content10;
    }

    public function setContent10(?string $content10): static
    {
        $this->content10 = $content10;

        return $this;
    }

    public function getSubtitle10(): ?string
    {
        return $this->subtitle10;
    }

    public function setSubtitle10(?string $subtitle10): static
    {
        $this->subtitle10 = $subtitle10;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function isPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setPublished(bool $isPublished): static
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
