<?php

// namespace Scandiweb;

// class Autoloader
// {
//     public static function register()
//     {
//         spl_autoload_register(function ($class) {
//             // Convert namespace to file path
//             $filePath = str_replace("\\", DIRECTORY_SEPARATOR, $class) . '.php';

//             // Assuming the base directory is the project root
//             $fullPath = __DIR__ . DIRECTORY_SEPARATOR . $filePath;

//             // Include the file if it exists
//             if (file_exists($fullPath)) {
//                 require_once $fullPath;
//             }
//         });
//     }
// }

// Autoloader::register();


namespace Scandiweb;

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            // Convert namespace to file path
            $namespace = 'Scandiweb\\';
            $baseDirectory = __DIR__ . DIRECTORY_SEPARATOR;

            $class = str_replace($namespace, '', $class);
            $classPath = str_replace("\\", DIRECTORY_SEPARATOR, $class);

            // Assuming the base directory is the project root
            $fullPath = $baseDirectory . $classPath . '.php';

            // Include the file if it exists
            if (file_exists($fullPath)) {
                require_once $fullPath;
            }
        });
    }
}

Autoloader::register();


?>