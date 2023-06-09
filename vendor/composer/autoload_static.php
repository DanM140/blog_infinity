<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticIniteef8a75c5987b2547f37943371e783e4
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\SimpleCache\\' => 16,
            'Psr\\Cache\\' => 10,
            'Phpfastcache\\Tests\\' => 19,
            'Phpfastcache\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\SimpleCache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/simple-cache/src',
        ),
        'Psr\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/cache/src',
        ),
        'Phpfastcache\\Tests\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpfastcache/phpfastcache/tests/lib',
        ),
        'Phpfastcache\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpfastcache/phpfastcache/lib/Phpfastcache',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticIniteef8a75c5987b2547f37943371e783e4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticIniteef8a75c5987b2547f37943371e783e4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticIniteef8a75c5987b2547f37943371e783e4::$classMap;

        }, null, ClassLoader::class);
    }
}
