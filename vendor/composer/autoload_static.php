<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit96763751b1bbe2804782055681dfa225
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit96763751b1bbe2804782055681dfa225::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit96763751b1bbe2804782055681dfa225::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit96763751b1bbe2804782055681dfa225::$classMap;

        }, null, ClassLoader::class);
    }
}
