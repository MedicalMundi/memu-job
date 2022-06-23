<?php declare(strict_types=1);

namespace Ingesting\Tests\PublicJob\Unit\AclAdapter\Model;

use Ingesting\PublicJob\AclAdapter\Model\JobFeed;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Ingesting\PublicJob\AclAdapter\Model\JobFeed
 */
class JobFeedTest extends TestCase
{
    private const UUID = 'dc97e157-a0fa-478a-8ade-5692bbaa08e0';

    private const TITLE = 'An irrelevant title';

    private const DESCRIPTION = 'An irrelevant description';

    private const LINK = 'https://www.gazzettaufficiale.it';

    public function testConstructFromArray(): void
    {
        $input = [
            'job_id' => self::UUID,
            'title' => self::TITLE,
            'description' => self::DESCRIPTION,
            'link' => self::LINK,
        ];

        $model = JobFeed::fromArray($input);

        self::assertSame(self::UUID, $model->identity());
        self::assertSame(self::TITLE, $model->title());
        self::assertSame(self::DESCRIPTION, $model->description());
        self::assertSame(self::LINK, $model->link());
    }

    public function testFailConstructFromArray(): void
    {
        self::markTestIncomplete('add validation in construct');
        $input = [

        ];

        $model = JobFeed::fromArray($input);

        self::assertSame(self::UUID, $model->identity());
        self::assertSame(self::TITLE, $model->title());
        self::assertSame(self::DESCRIPTION, $model->description());
        self::assertSame(self::LINK, $model->link());
    }
}
