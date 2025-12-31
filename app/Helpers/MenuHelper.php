<?php

if (! function_exists('menuActive')) {
    function menuActive($routes, $class = 'active')
    {
        foreach ((array) $routes as $route) {
            if (request()->routeIs($route)) {
                return $class;
            }
        }
        return '';
    }
}

if (! function_exists('menuOpen')) {
    function menuOpen($routes)
    {
        foreach ((array) $routes as $route) {
            if (request()->routeIs($route)) {
                return 'nav-item-open';
            }
        }
        return '';
    }
}
