<?php declare(strict_types=1);

namespace Publishing\Cms\Application\Model\ConcorsoArticle;

use Doctrine\ORM\Mapping as ORM;
use Publishing\Cms\Adapter\Persistence\ConcorsoArticleRepository;

/**
 * @ORM\Entity(repositoryClass=ConcorsoArticleRepository::class)
 */
class ConcorsoArticle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $publicationStart;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $publicationEnd;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDraft = true;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPublicationStart(): ?\DateTimeImmutable
    {
        return $this->publicationStart;
    }

    public function setPublicationStart(?\DateTimeImmutable $publicationStart): self
    {
        $this->publicationStart = $publicationStart;

        return $this;
    }

    public function getPublicationEnd(): ?\DateTimeImmutable
    {
        return $this->publicationEnd;
    }

    public function setPublicationEnd(?\DateTimeImmutable $publicationEnd): self
    {
        $this->publicationEnd = $publicationEnd;

        return $this;
    }

    public function getIsDraft(): ?bool
    {
        return $this->isDraft;
    }

    public function setIsDraft(bool $isDraft): self
    {
        $this->isDraft = $isDraft;

        return $this;
    }
}
