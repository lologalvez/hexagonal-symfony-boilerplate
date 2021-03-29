<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class Health
{
    public function index(): Response
    {
        return new Response('ok');
    }
}
