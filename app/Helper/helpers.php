<?php

if (! function_exists('nav_active')) {
    function nav_active($route)
    {
        return request()->routeIs($route)
            ? 'active'
            : '';
    }
}
