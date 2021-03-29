<?php

declare(strict_types=1);

namespace App\Tests\unit\Domain\Model\Dummy;

use App\Domain\Model\Dummy\Details\Id\Id;
use App\Domain\Model\Dummy\Details\Name\Name;
use App\Domain\Model\Dummy\Dummy;

class DummyBuilder
{
    private Id $id;
    private Name $name;

    private function __construct()
    {
        $this->id = new Id(1);
        $this->name = new Name('a default dummy name');
    }

    public static function aDummy(): self
    {
        return new self();
    }

    public function withId(Id $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function withName(Name $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function build(): Dummy
    {
        return new Dummy(
            $this->id,
            $this->name
        );
    }
}
