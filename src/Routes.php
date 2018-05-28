<?php

declare(strict_types = 1);

namespace Example;

return array(
    array(
        "method" => "GET",
        "path" => "/hello-world",
        "handler" => function () {
            echo "Hello World";
        }
    ),
    array(
        "method" => "GET",
        "path" => "/another-route",
        "handler" => function () {
            echo "This works too";
        }
    )
);

