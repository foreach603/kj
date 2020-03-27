<?php

if (!function_exists("dd")) {
    function dd(...$args)
    {
        foreach ($args as $x) {
            var_dump($x);
        }
        die(1);
    }
}
