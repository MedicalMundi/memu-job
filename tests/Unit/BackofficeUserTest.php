<?php declare(strict_types=1);

namespace App\Tests\Unit;

use App\Entity\BackofficeUser;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class BackofficeUserTest extends TestCase
{
    public function testCanBeCreatedWithAnIdentity(): void
    {
        $identity = Uuid::uuid4();

        $bu = BackofficeUser::createWithIdentity($identity, 'foo', 'bar');

        self::assertSame($identity, $bu->getId());
    }

    public function testCanBeCreatedWithoutAnIdentity(): void
    {
        $bu = BackofficeUser::create('foo', 'bar');

        self::assertNotEmpty($bu->getId()->toString());
    }

    public function testAttributeAfterCreation(): void
    {
        $identity = Uuid::uuid4();

        $bu = BackofficeUser::createWithIdentity($identity, 'foo', 'bar');

        self::assertSame('foo', $bu->getEmail());
        self::assertSame('bar', $bu->getPassword());
    }

    public function testHasMinimumRoleAssigned(): void
    {
        $bu = BackofficeUser::create('foo', 'bar');

        self::assertContains('ROLE_USER', $bu->getRoles());
    }

    public function testCanAssignMultipleRoles(): void
    {
        $bu = BackofficeUser::create('foo', 'bar');

        $bu->setRoles(['ROLE_FOO', 'ROLE_BAR']);

        self::assertContains('ROLE_USER', $bu->getRoles());
        self::assertContains('ROLE_FOO', $bu->getRoles());
        self::assertContains('ROLE_BAR', $bu->getRoles());
    }
}
