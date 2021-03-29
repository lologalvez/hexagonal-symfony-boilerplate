<?php


namespace App\Domain\Model\Dummy\Details\Id;

class Id
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function value(): int
    {
        return $this->id;
    }
}
