<?php

declare(strict_types = 1);

namespace Example;

return array(
      array(
          "method" => "GET",
          "path" => "/",
          "handler" => 
              array(
                  "controller" => "Example\Controllers\Homepage",
                  "method" => "show"
              )
        )                   
);

