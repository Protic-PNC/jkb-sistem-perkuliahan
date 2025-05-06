<?php

if (!function_exists('setActive')) {
    function setActive($route)
    {
        return request()->routeIs($route) ? 'text-white bg-gray-500 bg-opacity-25 ' : 'text-white hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100';
    }
}