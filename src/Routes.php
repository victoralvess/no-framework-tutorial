<?php

declare(strict_types = 1);

namespace Example;

return array(
      ['GET', '/', ['Example\Controllers\Homepage', 'show']],
      ['GET', '/{slug}', ['Example\Controllers\Page', 'show']],           
);

