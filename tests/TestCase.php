<?php

namespace Ghorbani\FilamentArCaptchaField\Tests;

use Ghorbani\FilamentArCaptchaField\FilamentArCaptchaFieldServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            FilamentArCaptchaFieldServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('filament-arcaptcha-field.site_key', 'test-site-key');
        $app['config']->set('filament-arcaptcha-field.secret_key', 'test-secret-key');
        $app['config']->set('filament-arcaptcha-field.options', [
            'lang' => 'fa',
            'theme' => 'light',
        ]);
    }
}

