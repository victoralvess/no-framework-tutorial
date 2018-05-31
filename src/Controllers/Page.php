<?php

declare(strict_types = 1);

namespace Example\Controllers;

class Page
{
    public function show($params): void
    {
        var_dump($params);
    }
}

