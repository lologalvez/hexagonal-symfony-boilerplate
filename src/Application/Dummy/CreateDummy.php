<?php


namespace App\Application\Dummy;

use App\Domain\Model\Dummy\Details\Id\Id;
use App\Domain\Model\Dummy\Details\Id\IdGenerator;
use App\Domain\Model\Dummy\Details\Name\Name;
use App\Domain\Model\Dummy\Dummy;
use App\Domain\Model\Dummy\DummyRepository;

class CreateDummy
{
    private DummyRepository $dummyRepository;
    private IdGenerator $idGenerator;

    public function __construct(DummyRepository $dummyRepository, IdGenerator $idGenerator)
    {
        $this->dummyRepository = $dummyRepository;
        $this->idGenerator = $idGenerator;
    }

    public function execute(array $dummyData): void
    {
        $dummy = new Dummy(
            $this->idGenerator->generate(),
            new Name($dummyData['name'])
        );
        $this->dummyRepository->save($dummy);
    }
}
