<?php


namespace App\Domain\Model\Dummy\Details\Id;

interface IdGenerator
{
    public function generate(): Id;
}
