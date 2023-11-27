<?php

namespace Scandiweb;

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            // Convert namespace to file path
            $filePath = str_replace("\\", DIRECTORY_SEPARATOR, $class) . '.php';

            // Assuming the base directory is the project root
            $fullPath = __DIR__ . DIRECTORY_SEPARATOR . $filePath;

            // Include the file if it exists
            if (file_exists($fullPath)) {
                require_once $fullPath;
            }
        });
    }
}

Autoloader::register();

?>