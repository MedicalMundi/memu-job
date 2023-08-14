<?php declare(strict_types=1);

namespace Publishing\Cms\Application\Model\JobArticle;

use Doctrine\ORM\Mapping as ORM;
use Publishing\Cms\Adapter\Persistence\JobArticleRepository;

/**
 * @ORM\Entity(repositoryClass=JobArticleRepository::class)
 */
class JobArticle
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
    private ?string $title = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $content = null;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private ?\DateTimeImmutable $publicationStart = null;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private ?\DateTimeImmutable $publicationEnd = null;

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
}
