<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit5bf41a3c42a38bd49bbf3b24329e694b
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit5bf41a3c42a38bd49bbf3b24329e694b', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit5bf41a3c42a38bd49bbf3b24329e694b', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit5bf41a3c42a38bd49bbf3b24329e694b::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
