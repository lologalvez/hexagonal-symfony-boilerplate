<?php


namespace App\Domain\Model\Dummy;

interface DummyRepository
{
    public function save(Dummy $dummy): void;
}