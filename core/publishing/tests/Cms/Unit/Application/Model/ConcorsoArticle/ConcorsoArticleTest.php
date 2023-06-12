<?php declare(strict_types=1);

namespace Publishing\Tests\Cms\Unit\Application\Model\ConcorsoArticle;

use PHPUnit\Framework\TestCase;
use Publishing\Cms\Application\Model\ConcorsoArticle\ConcorsoArticle;
use Publishing\Cms\Application\Model\ConcorsoArticle\ConcorsoArticleId;

class ConcorsoArticleTest extends TestCase
{
    private const UUID = '494e04c6-4c81-405e-8ece-dc758dfece7b';

    public function testShouldAutoGenerateAnIdentity(): void
    {
        $sut = new ConcorsoArticle();

        self::assertNotNull($sut->getId());
    }

    public function testShouldAcceptIdentityAsConstructorArgument(): void
    {
        $sut = new ConcorsoArticle($identity = ConcorsoArticleId::fromString(self::UUID));

        self::assertNotNull($sut->getId());
        self::assertSame($identity, $sut->getId());
    }

    public function testShouldBeDraftAsDefault(): void
    {
        $sut = new ConcorsoArticle(ConcorsoArticleId::fromString(self::UUID));

        self::assertTrue($sut->getIsDraft());
    }
}
