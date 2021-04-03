<?php


namespace App\Infrastructure;

use App\Domain\Model\Dummy\Dummy;
use App\Domain\Model\Dummy\DummyRepository;
use Doctrine\DBAL\Driver\Connection;

class MysqlDummyRepository implements DummyRepository
{
    /** @var Connection */
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function save(Dummy $dummy): void
    {
        $queryBuilder = $this->connection->createQueryBuilder()
            ->insert($_ENV['MYSQL_TABLE'])
            ->values(['id' => '?', 'name' => '?'])
            ->setParameter(0, $dummy->id())
            ->setParameter(1, $dummy->name());

        $queryBuilder->execute();
    }
}
