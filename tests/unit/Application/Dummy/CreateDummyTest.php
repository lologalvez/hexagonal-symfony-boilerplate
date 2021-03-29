<?php

declare(strict_types=1);

namespace App\Tests\unit\Application\Dummy;

use App\Application\Dummy\CreateDummy;
use App\Domain\Model\Dummy\Details\Id\Id;
use App\Domain\Model\Dummy\Details\Id\IdGenerator;
use App\Domain\Model\Dummy\Details\Name\Name;
use App\Domain\Model\Dummy\DummyRepository;
use App\Tests\unit\Domain\Model\Dummy\DummyBuilder;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class CreateDummyTest extends TestCase
{
    use ProphecyTrait;

    private const DUMMY_ID = 1;

    private $dummyRepository;
    private $idGenerator;
    private CreateDummy $createDummy;

    public function setUp(): void
    {
        $this->dummyRepository = $this->prophesize(DummyRepository::class);
        $this->idGenerator = $this->prophesize(IdGenerator::class);
        $this->createDummy = new CreateDummy(
            $this->dummyRepository->reveal(),
            $this->idGenerator->reveal()
        );
    }

    /** @test */
    public function should_save_an_author_to_repository(): void
    {
        $dummyData = ['name' => 'a dummy name'];
        $this->idGenerator->generate()->willReturn(new Id(self::DUMMY_ID));

        $this->createDummy->execute($dummyData);

        $expectedDummy = DummyBuilder::aDummy()
            ->withId(new Id(self::DUMMY_ID))
            ->withName(new Name('a dummy name'))
            ->build();
        $this->dummyRepository->save($expectedDummy)->shouldHaveBeenCalled();
    }
}
