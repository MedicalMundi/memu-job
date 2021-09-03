<?php declare(strict_types=1);

namespace Ingesting\SharedKernel\Infrastructure\FeedIoAdapter;

use DateTime;
use FeedIo\Adapter\ResponseInterface;
use Symfony\Contracts\HttpClient\ResponseInterface as PsrResponseInterface;

class Response implements ResponseInterface
{
    public const HTTP_LAST_MODIFIED = 'Last-Modified';

    protected ?string $body = null;

    protected PsrResponseInterface $psrResponse;

    protected float $duration;

    public function __construct(PsrResponseInterface $psrResponse, float $duration)
    {
        $this->psrResponse = $psrResponse;
        $this->duration = $duration;
    }

    public function getDuration(): int
    {
        return (int) $this->duration;
    }

    public function getStatusCode(): int
    {
        // TODO FeedIo exception
        return $this->psrResponse->getStatusCode();
    }

    public function isModified(): bool
    {
        // TODO FeedIo exception
        return $this->psrResponse->getStatusCode() !== 304 && \strlen($this->getBody()) > 0;
    }

    public function getBody(): ? string
    {
        if (\is_null($this->body)) {
            // TODO FeedIo exception
            $this->body = $this->psrResponse->getContent();
        }

        return $this->body;
    }

    public function getLastModified(): ?DateTime
    {
        // TODO FIX
        if ($this->psrResponse->hasHeader(static::HTTP_LAST_MODIFIED)) {
            $lastModified = DateTime::createFromFormat(DateTime::RFC2822, $this->getHeader(static::HTTP_LAST_MODIFIED)[0]);

            return false === $lastModified ? null : $lastModified;
        }

        return null;
    }

    public function getHeaders(): iterable
    {
        return $this->psrResponse->getHeaders();
    }

    public function getHeader(string $name): iterable
    {
        // TODO FIX
        return $this->psrResponse->getHeader($name);
    }
}
