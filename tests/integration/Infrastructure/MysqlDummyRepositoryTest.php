<?php

namespace App\Tests\integration\Infrastructure;

use App\Domain\Model\Dummy\Details\Id\Id;
use App\Domain\Model\Dummy\Details\Name\Name;
use App\Infrastructure\MysqlDummyRepository;
use App\Tests\unit\Domain\Model\Dummy\DummyBuilder;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\DriverManager;
use PHPUnit\Framework\TestCase;

class MysqlDummyRepositoryTest extends TestCase
{
    private const DUMMY_ID = 1;
    private const DUMMY_NAME = 'a dummy name';

    private Connection $connection;
    private MysqlDummyRepository $mySqlDummyRepository;

    protected function setUp(): void
    {
        $this->connection = DriverManager::getConnection(
            [
                'dbname' => $_ENV['MYSQL_DATABASE'],
                'user' => $_ENV['MYSQL_USER'],
                'password' => $_ENV['MYSQL_PASSWORD'],
                'host' => $_ENV['MYSQL_HOST'],
                'driver' => 'pdo_mysql',
            ]
        );

        $this->mySqlDummyRepository = new MysqlDummyRepository($this->connection);

        $this->clearDataBase();
    }

    protected function tearDown(): void
    {
        $this->clearDataBase();
    }

    /** @test */
    public function should_save_a_dummy_to_database(): void
    {
        $dummy = DummyBuilder::aDummy()
            ->withId(new Id(self::DUMMY_ID))
            ->withName(new Name(self::DUMMY_NAME))
            ->build();

        $this->mySqlDummyRepository->save($dummy);

        self::assertTrue($this->dummyExists(self::DUMMY_ID));
    }

    private function dummyExists(string $dummyId): bool
    {
        $queryBuilder = $this->connection->createQueryBuilder()
            ->select('name')
            ->from($_ENV['MYSQL_TABLE'])
            ->where('id = ?')
            ->setParameter(0, $dummyId);

        $dummyResult = $queryBuilder->execute()->fetchOne();

        if (empty($dummyResult)) {
            return false;
        }

        return true;
    }

    private function clearDataBase(): void
    {
        $queryBuilder = $this->connection->createQueryBuilder()
            ->delete($_ENV['MYSQL_TABLE'])
            ->where('id = ?')
            ->setParameter(0, self::DUMMY_ID);

        $queryBuilder->execute();
    }
}
