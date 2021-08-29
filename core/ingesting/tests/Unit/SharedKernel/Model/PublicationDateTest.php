<?php declare(strict_types=1);

namespace Ingesting\Tests\Unit\SharedKernel\Model;

use Ingesting\SharedKernel\Model\PublicationDate;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ingesting\SharedKernel\Model\PublicationDate
 */
class PublicationDateTest extends TestCase
{
    /**
     * @test
     * @dataProvider getPublicationDates
     */
    public function it_correctly_validates_the_publicationDate(string $publicationDate): void
    {
        $publicationDate = PublicationDate::fromString($publicationDate);

        self::assertNotEmpty($publicationDate->toString());
    }

    public function getPublicationDates(): array
    {
        return [
            [
                '2047-02-01 10:00:00',
            ],
            [
                '1947-01-01 10:00:00',
            ],
            [
                ($date = new \DateTimeImmutable('2047-01-01'))->format('Y-m-d'),
            ],
            [
                ($date = new \DateTimeImmutable('1947-01-01'))->format('Y-m-d'),
            ],
            [
                ($date = new \DateTimeImmutable('Thu, 25 Apr 2019 22:00:00 GMT'))->format('Y-m-d'),
            ],
            [
                ($date = new \DateTimeImmutable('now'))->format('Y-m-d'),
            ],
        ];
    }
}
