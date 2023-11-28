<?php

// Autoloader.php

class Autoloader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'loadClass']);
    }

    public static function loadClass($className)
    {
        $baseNamespace = 'EventsCalendar';

        $className = str_replace($baseNamespace . '\\', '', $className);

        $filePath = __DIR__ . '/src/' . str_replace('\\', '/', $className) . '.php';

        if (is_file($filePath)) {
            require_once $filePath;
        } else {
            echo 'Autoloader: Attempted to load ' . $className . ' from ' . $filePath . ', but the file does not exist.<br>';
        }
    }
}

Autoloader::register();
