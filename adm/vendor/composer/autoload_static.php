<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8d070178755c320c69f93ee4800660ef
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'C' => 
        array (
            'Core\\' => 5,
        ),
        'A' => 
        array (
            'App\\' => 4,
            'Adms\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'Adms\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/adms',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8d070178755c320c69f93ee4800660ef::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8d070178755c320c69f93ee4800660ef::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8d070178755c320c69f93ee4800660ef::$classMap;

        }, null, ClassLoader::class);
    }
}
