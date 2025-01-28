<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1e7b70905b0d305f23ad4adf3bce5d8a
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'C4WP\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'C4WP\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
            1 => __DIR__ . '/../..' . '/admin',
        ),
    );

    public static $classMap = array (
        'C4WP\\C4WP_Captcha_Class' => __DIR__ . '/../..' . '/includes/class-c4wp-captcha-class.php',
        'C4WP\\C4WP_Functions' => __DIR__ . '/../..' . '/includes/class-c4wp-functions.php',
        'C4WP\\Methods\\C4WP_Method_Loader' => __DIR__ . '/../..' . '/includes/methods/class-c4wp-method-loader.php',
        'C4WP\\Methods\\Captcha' => __DIR__ . '/../..' . '/includes/methods/class-captcha.php',
        'C4WP\\Methods\\Cloudflare' => __DIR__ . '/../..' . '/includes/methods/class-cloudflare.php',
        'C4WP\\Methods\\HCaptcha' => __DIR__ . '/../..' . '/includes/methods/class-hcaptcha.php',
        'C4WP_Settings' => __DIR__ . '/../..' . '/admin/class-c4wp-settings.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1e7b70905b0d305f23ad4adf3bce5d8a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1e7b70905b0d305f23ad4adf3bce5d8a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1e7b70905b0d305f23ad4adf3bce5d8a::$classMap;

        }, null, ClassLoader::class);
    }
}
