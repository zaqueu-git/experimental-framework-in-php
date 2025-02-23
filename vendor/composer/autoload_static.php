<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9e9f33b4f9a77af2784ec69ad8669ee9
{
    public static $prefixLengthsPsr4 = array (
        'z' => 
        array (
            'zkFramework\\' => 12,
        ),
        'A' => 
        array (
            'App\\' => 4,
            'Api\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'zkFramework\\' => 
        array (
            0 => __DIR__ . '/../..' . '/zkFramework',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'Api\\' => 
        array (
            0 => __DIR__ . '/../..' . '/api',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9e9f33b4f9a77af2784ec69ad8669ee9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9e9f33b4f9a77af2784ec69ad8669ee9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9e9f33b4f9a77af2784ec69ad8669ee9::$classMap;

        }, null, ClassLoader::class);
    }
}
