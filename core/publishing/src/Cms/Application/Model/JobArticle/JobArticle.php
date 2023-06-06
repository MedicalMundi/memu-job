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
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $pubicationStart;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $publicationEnd;

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

    public function getPubicationStart(): ?\DateTimeImmutable
    {
        return $this->pubicationStart;
    }

    public function setPubicationStart(?\DateTimeImmutable $pubicationStart): self
    {
        $this->pubicationStart = $pubicationStart;

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
