<?php declare(strict_types=1);

namespace Publishing\Cms\Application\Model\Article;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Publishing\Cms\Adapter\Persistence\DoctrineArticleRepository")
 * @ORM\Table(name="article")
 */
class Article
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $activated = false;

    /**
     * @ORM\Column(type="string")
     */
    private bool $title;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function isActivated(): bool
    {
        return $this->activated;
    }

    public function setActivated(bool $activated): void
    {
        $this->activated = $activated;
    }

    public function isTitle(): bool
    {
        return $this->title;
    }

    public function setTitle(bool $title): void
    {
        $this->title = $title;
    }
}
