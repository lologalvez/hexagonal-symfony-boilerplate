<?php


namespace App\Domain\Model\Dummy;

use App\Domain\Model\Dummy\Details\Id\Id;
use App\Domain\Model\Dummy\Details\Name\Name;

class Dummy
{
    private Id $id;
    private Name $name;

    public function __construct(Id $id, Name $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): int
    {
        return $this->id->value();
    }

    public function name(): string
    {
        return $this->name->value();
    }
}
