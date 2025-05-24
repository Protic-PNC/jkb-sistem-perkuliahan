<?php

if (!function_exists('setActive')) {
    function setActive($route)
    {
        return request()->routeIs($route) ? 'text-white bg-gray-500 bg-opacity-25 rounded-lg transition duration-75 group ' : 'text-white hover:bg-gray-700 hover:bg-opacity-75 hover:text-gray-100 hover:bg-gray-200 dark:text-white dark:hover:bg-gray-300 rounded-lg transition duration-75 group';
    }
}