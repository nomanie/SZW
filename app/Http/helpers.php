<?php
declare(strict_types=1);

if (! function_exists('user')) {
    function user(
    ) {
        return auth()->user();
    }
}

if (! function_exists('workshop')) {
    function workshop(
    ) {
        return auth()->user()->workshop;
    }
}
