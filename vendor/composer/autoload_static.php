<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5a6b4edabf9c3251ee0abc54b0242142
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5a6b4edabf9c3251ee0abc54b0242142::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5a6b4edabf9c3251ee0abc54b0242142::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
